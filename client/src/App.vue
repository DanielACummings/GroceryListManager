<script setup>
import axios from 'axios';
import HelloWorld from './components/HelloWorld.vue'
import LoginRegister from './components/LoginRegister.vue';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

// Define a method to retrieve CSRF token
async function fetchCsrfToken() {
    try {
        const response = await axios.get('csrf-token');
        const csrfToken = response.data.csrf_token;

        // Set the CSRF token as a default header in Axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        console.log('CSRF token fetched:', csrfToken);
    } catch (error) {
        console.error('Error fetching CSRF token:', error);
    }
}

// Call fetchCsrfToken during app initialization
fetchCsrfToken();
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
  <LoginRegister />
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
