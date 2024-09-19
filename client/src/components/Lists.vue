<template>
  <div>
    <h1>Lists</h1>
    <ul>
      <li v-for="list in lists" :key="list.id">
        {{ list.name }}
        <ul>
          <li v-for="item in list.items" :key="item.id">
            <span :class="{ 'crossed-out': item.crossedOut }">{{ item.text }}</span>
          </li>
        </ul>
      </li>
    </ul>
    <form @submit.prevent="createList">
      <input type="text" v-model="newListName" placeholder="Enter new list name">
      <button type="submit">Create List</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      lists: [],
      newListName: ''
    }
  },
  mounted() {
    this.loadLists()
  },
  methods: {
    loadLists() {
      axios.get('lists')
        .then(response => {
          this.lists = response.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    createList() {
      if (this.newListName.trim() === '') {
        alert('Please enter a list name')
        return
      }
      if (this.lists.find(list => list.name === this.newListName)) {
        alert('List name already in use')
        return
      }
      axios.post('lists', { name: this.newListName })
        .then(response => {
          this.lists.push(response.data)
          this.newListName = ''
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
}
</script>

<style>
.crossed-out {
  text-decoration: line-through;
}
</style>
