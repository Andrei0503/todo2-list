<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Inertia\Inertia;

class TodoListController extends Controller
{
    public function index()
    {
        $incompleteItems = ListItem::where('is_complete', 0)->get();
        $completeItems = ListItem::where('is_complete', 1)->get();

        return Inertia::render('Welcome', [
            'listItems' => $incompleteItems,
            'completeItems' => $completeItems,
            'canLogin' => true,
            'canRegister' => true
        ]);
    }

    public function markAsDone($id)
    {

        $listItem = ListItem::find($id);
        $listItem->is_complete = 1;
        $listItem->save();

        // info($id);
        // info($listItem);
        return redirect('/');
    }

    public function saveItem(Request $request)
    {
        info(json_encode($request->all()));

        $newListItem = new ListItem();
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->save();

        return redirect('/');
    }
}
