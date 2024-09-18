<script setup>
import axios from 'axios';
import Lists from './components/Lists.vue';
import HelloWorld from './components/HelloWorld.vue'
import LoginRegister from './components/LoginRegister.vue';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
// TODO: Might use instead of adding CSRF token to all requests 
// axios.defaults.headers.common['X-CSRF-TOKEN'] = document.cookie.match(/XSRF-TOKEN=([^;]*)/);

</script>

<template>
  <div>
    <a href="https://vitejs.dev" target="_blank">
      <img src="/vite.svg" class="logo" alt="Vite logo" />
    </a>
    <a href="https://vuejs.org/" target="_blank">
      <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
    </a>
  </div>
  <HelloWorld />
  <!-- <LoginRegister /> -->
  <Lists />
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
