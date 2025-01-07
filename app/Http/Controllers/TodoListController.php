<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class TodoListController extends Controller
{
    public function index()
    {
        $incompleteItems = ListItem::where('is_complete', 0)->get();
        $completeItems = ListItem::where('is_complete', 1)->get();

        return view('welcome', [
            'listItems' => $incompleteItems,
            'completeItems' => $completeItems
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
