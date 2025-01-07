<template>
  <GuestLayout></GuestLayout>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Todo List</h1>
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
    </ul>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const newTodo = ref('');
const todos = ref([]);

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
