<template>
    <div class="container mx-auto p-4">
      <!-- <h1 class="text-2xl font-bold mb-4">Todo List</h1>
      <div class="flex mb-4">
        <input v-model="newTodo" @keyup.enter="addTodo" placeholder="Add a new todo" class="flex-grow p-2 border rounded mr-2" />
        <button @click="addTodo" class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
      </div>
      <ul class="list-none p-0">
        <li v-for="(todo, index) in sortedTodos" :key="index" class="flex items-center mb-2 p-2 border rounded">
          <input type="checkbox" v-model="todo.completed" class="mr-2" />
          <span :class="{ 'line-through text-gray-500': todo.completed }" class="flex-grow">{{ todo.text }}</span>
          <button @click="removeTodo(index)" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
        </li>
      </ul> -->
      <div style="text-align: center;">
        <h1 style="font-size: 48px;">Todo List Laravel</h1>
        <div v-for="(listItem, index) in listItems" :key="index" style="display: flex; align-items: center; justify-content: center;">
          <p style="margin: 0;">List no. {{ listItem.id }}: {{ listItem.name }}</p>
          <form :action="`/markAsDoneRoute/${listItem.id}`" method="post" style="margin-left: 20px;">
            <input type="hidden" name="_token" :value="csrfToken">
            <button type="submit" style="background-color: white; border: 2px solid black; color: black; padding: 1px 5px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 12px;">
              Mark as done
            </button>
          </form>
        </div>
        <form action="/saveItemRoute" method="post">
          <input type="hidden" name="_token" :value="csrfToken">
          <br><br>
          <label for="listItem">Make your todo list here</label>
          <br><br>
          <input type="text" name="listItem" style="color: black;">
          <br><br>
          <button style="background-color: white; border: 2px solid black; color: black; padding: 10px 24px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 12px;" type="submit">
            Add List
          </button>
          <br><br>
          <h1 style="font-size: 48px;">Completed Tasks</h1>
          <br>
          <div v-for="listItem in completeItems" :key="listItem.id" style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
            <p style="margin: 0;">List no. {{ listItem.id }}: {{ listItem.name }}</p>
          </div>
        </form>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';

  const newTodo = ref('');
  const todos = ref([]);
  const { props } = usePage();
  const listItems = ref(props.listItems || []);
  const completeItems = ref(props.completeItems || []);
  const csrfToken = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

  const addTodo = () => {
    if (newTodo.value.trim() !== '') {
      todos.value.push({ text: newTodo.value.trim(), completed: false });
      newTodo.value = '';
    }
  };

  const removeTodo = (index) => {
    todos.value.splice(index, 1);
  };

  const sortedTodos = computed(() => {
    return todos.value.slice().sort((a, b) => a.completed - b.completed);
  });
  </script>
