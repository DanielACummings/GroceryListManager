<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-800 text-white">
      <div class="w-full max-w-md p-6 bg-gray-900 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">
          {{ isLogin ? 'Login' : 'Register' }}
        </h2>
  
        <form @submit.prevent="handleSubmit">
          <div class="mb-4">
            <label class="block text-sm font-medium" for="email">Email</label>
            <input
              id="email"
              type="email"
              v-model="email"
              class="mt-1 block w-full p-2 bg-gray-700 rounded-lg border border-gray-600 focus:outline-none focus:ring focus:ring-blue-500"
              required
            />
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium" for="passphrase">Passphrase</label>
            <input
              id="passphrase"
              type="password"
              v-model="passphrase"
              @input="validatePassphrase"
              class="mt-1 block w-full p-2 bg-gray-700 rounded-lg border border-gray-600 focus:outline-none focus:ring focus:ring-blue-500"
              required
            />
          </div>
  
          <div v-if="!isLogin" class="mb-4">
            <label class="block text-sm font-medium" for="passphraseConfirm">Confirm Passphrase</label>
            <input
              id="passphraseConfirm"
              type="password"
              v-model="passphraseConfirm"
              class="mt-1 block w-full p-2 bg-gray-700 rounded-lg border border-gray-600 focus:outline-none focus:ring focus:ring-blue-500"
              required
            />
            <p v-if="passphraseError" class="text-red-500 text-sm mt-1">{{ passphraseError }}</p>
          </div>
  
          <div class="mb-6">
            <button
              type="submit"
              class="w-full p-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-300"
            >
              {{ isLogin ? 'Login' : 'Register' }}
            </button>
          </div>
  
          <p class="text-center">
            <span @click="toggleForm" class="cursor-pointer text-blue-400 underline">
              {{ isLogin ? 'Create an account' : 'Already have an account? Login' }}
            </span>
          </p>
        </form>
  
        <div v-if="passphraseRequirements" class="mt-4 p-2 bg-gray-800 rounded">
          <h3 class="font-semibold">Passphrase Requirements:</h3>
          <ul class="list-disc list-inside">
            <li :class="{ 'line-through': passphraseLength }">At least 8 characters</li>
            <li :class="{ 'line-through': passphraseCapital }">At least 1 capital letter</li>
            <li :class="{ 'line-through': passphraseLowercase }">At least 1 lowercase letter</li>
            <li :class="{ 'line-through': passphraseNumber }">At least 1 number</li>
            <li :class="{ 'line-through': passphraseSpecial }">At least 1 special character</li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';


  export default {
    data() {
      return {
        isLogin: true,
        email: '',
        passphrase: '',
        passphraseConfirm: '',
        passphraseError: '',
        passphraseRequirements: false,
      };
    },
    computed: {
      passphraseLength() {
        return this.passphrase.length >= 8 || this.passphrase.length >= 16;
      },
      passphraseCapital() {
        return /[A-Z]/.test(this.passphrase);
      },
      passphraseLowercase() {
        return /[a-z]/.test(this.passphrase);
      },
      passphraseNumber() {
        return /\d/.test(this.passphrase);
      },
      passphraseSpecial() {
        return /[!@#$%^&*(),.?":{}|<>]/.test(this.passphrase);
      },
    },
    methods: {
      getCsrfCookie() {
        return axios.get('/sanctum/csrf-cookie').then(response => { });
      },
      toggleForm() {
        this.isLogin = !this.isLogin;
        // Retain the email and passphrase on switching forms
        if (this.isLogin) {
          this.passphrase = '';
          this.passphraseConfirm = '';
        } else if (!this.isLogin) {
          this.passphraseConfirm = ''; // Clear confirmation field on switch
        }
      },
      validatePassphrase() {
        this.passphraseRequirements = true;
        if (this.passphrase.length >= 16) {
          this.passphraseError = '';
        } else if (this.passphrase !== this.passphraseConfirm) {
          this.passphraseError = "Passphrases do not match";
        } else if (!this.passphraseLength || !this.passphraseCapital || !this.passphraseLowercase || !this.passphraseNumber || !this.passphraseSpecial) {
          this.passphraseError = "Ensure all requirements are met.";
        } else {
          this.passphraseError = '';
        }
      },
      handleSubmit() {
          const apiEndpoint = `${axios.defaults.baseURL}/${this.isLogin
            ? 'login' : 'register'}`;
          const payload = {
            email: this.email,
            password: this.passphrase,
          };

          // Add passphrase confirmation for registration
          if (!this.isLogin) {
            payload.passphraseConfirm = this.passphraseConfirm;
          }

        axios.post(apiEndpoint, payload)
          .then(response => {
            // Handle success or error as needed
            console.log(response.data);
          })
          .catch(error => {
            console.error('Error:', error);
        });
      },
    },
  };
  </script>
  
  <style scoped>
  .line-through {
    text-decoration: line-through;
  }
  </style>
