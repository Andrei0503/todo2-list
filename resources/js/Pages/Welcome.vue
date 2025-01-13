<template>
  <GuestLayout></GuestLayout>
  <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16">
    <div class="px-4 py-2">
      <h1 class="text-gray-800 font-bold text-2xl uppercase">To-Do List</h1>
    </div>
    <form class="w-full max-w-sm mx-auto px-4 py-2" @submit.prevent="addTodo">
      <div class="flex items-center border-b-2 border-teal-500 py-2">
        <input
          v-model="newTodo"
          @keyup.enter="addTodo"
          class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
          type="text"
          placeholder="Add a task"
        />
        <button
          @click="addTodo"
          class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
          type="button"
        >
          Add
        </button>
      </div>
    </form>
    <ul class="divide-y divide-gray-200 px-4">
      <li v-for="(todo, index) in activeTodos" :key="todo.id" class="py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              type="checkbox"
              v-model="todo.completed"
              :id="'todo' + todo.id"
              class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
            />
            <label :for="'todo' + todo.id" class="ml-3 block text-gray-900">
              <span :class="{ 'line-through text-gray-500': todo.completed }" class="text-lg font-medium">{{ todo.text }}</span>
              <span class="text-sm text-gray-500 ml-2">({{ todo.date }})</span>
            </label>
          </div>
          <button
            v-if="todo.completed"
            @click="removeTodo(index)"
            class="ml-auto bg-red-500 hover:bg-red-700 text-white text-sm py-1 px-2 rounded"
          >
            Remove
          </button>
        </div>
      </li>
    </ul>
    <div class="px-4 py-2">
      <h2 class="text-gray-800 font-bold text-xl uppercase">Completed Tasks</h2>
    </div>
    <ul class="divide-y divide-gray-200 px-4">
      <li v-for="(todo, index) in completedTodos" :key="todo.id" class="py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              type="checkbox"
              v-model="todo.completed"
              :id="'todo' + todo.id"
              class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
            />
            <label :for="'todo' + todo.id" class="ml-3 block text-gray-900">
              <span :class="{ 'line-through text-gray-500': todo.completed }" class="text-lg font-medium">{{ todo.text }}</span>
              <span class="text-sm text-gray-500 ml-2">({{ todo.completionDate }})</span>
            </label>
          </div>
          <button
            @click="removeTodo(index)"
            class="ml-auto bg-red-500 hover:bg-red-700 text-white text-sm py-1 px-2 rounded"
          >
            Remove
          </button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newTodo: '',
      todos: []
    };
  },
  computed: {
    activeTodos() {
      return this.todos.filter(todo => !todo.completed);
    },
    completedTodos() {
      return this.todos.filter(todo => todo.completed);
    }
  },
  methods: {
    addTodo() {
      if (this.newTodo.trim() === '') return;
      this.todos.push({
        id: Date.now(),
        text: this.newTodo,
        completed: false,
        date: new Date().toLocaleString(),
        completionDate: null
      });
      this.newTodo = '';
    },
    removeTodo(index) {
      this.todos.splice(index, 1);
    }
  },
  watch: {
    todos: {
      handler(newTodos) {
        newTodos.forEach(todo => {
          if (todo.completed && !todo.completionDate) {
            todo.completionDate = new Date().toLocaleString();
          } else if (!todo.completed) {
            todo.completionDate = null;
          }
        });
      },
      deep: true
    }
  }
};
</script>

<style scoped>

</style>
