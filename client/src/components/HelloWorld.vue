<template>
  <div>
    <h1>Welcome to My Vue App</h1>
    <div v-if="loading">Loading...</div>
    <div v-if="error">{{ error }}</div>
    <pre v-if="data && data.message">{{ data.message }}</pre>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
  name: 'Home',
  setup() {
    const data = ref(null);
    const loading = ref(true);
    const error = ref(null);

    onMounted(async () => {
      try {
        const response = await fetch('http://127.0.0.1:8000/api');
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        data.value = await response.json();
      } catch (err) {
        error.value = err.message;
      } finally {
        loading.value = false;
      }
    });

    return { data, loading, error };
  },
};
</script>

<style scoped>
/* Add any desired styles here */
</style>
