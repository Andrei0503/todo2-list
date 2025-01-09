<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const listItems = ref(props.listItems || []);
const completeItems = ref(props.completeItems || []);
const csrfToken = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

</script>

<template>
    <div class="container mx-auto p-4">

        <h1 class="text-2xl font-bold mb-4">Todo List</h1>
        <div v-for="(listItem, index) in listItems" :key="index" style="display: flex;">
          <p style="margin: 0;">List no. {{ listItem.id }}: {{ listItem.name }}</p>
          <form :action="`/markAsDoneRoute/${listItem.id}`" method="post" style="margin-left: 20px;">
            <input type="hidden" name="_token" :value="csrfToken">
            <button type="submit" style="background-color: white; border: 2px solid black; color: black; padding: 1px 5px; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 12px;">
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
          <button style="background-color: white; border: 2px solid black; color: black; padding: 10px 24px; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 12px;" type="submit">
            Add List
          </button>
          <br><br>
          <h1 style="font-size: 48px;">Completed Tasks</h1>
          <br>
          <div v-for="listItem in completeItems" :key="listItem.id" style="display: flex; margin-bottom: 10px;">
            <p style="margin: 0;">List no. {{ listItem.id }}: {{ listItem.name }}</p>
          </div>
        </form>
    </div>
  </template>
