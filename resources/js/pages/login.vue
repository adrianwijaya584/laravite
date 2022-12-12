<template>
  <div class="">
    <input type="text" name="" id="" v-model="email">
    <input type="password" name="" id="" v-model="password">

    <button @click="login">Login</button>
  </div>
</template>

<script setup lang="ts">
import axios from './../utils/axiosClient';
import { ref } from 'vue';
import useAuthStore from "./../store/auth"
import { useRouter } from 'vue-router';

  const email= ref("adrian@gmail.com")
  const password= ref("adrian")
  const authStore= useAuthStore()
  const router= useRouter()

  async function login() {
    try {
      const {data}= await axios.post("auth/login", {
        email: email.value,
        password: password.value
      })

      alert(`hi ${data.user.name}`)

      authStore.setAccessToken(data.token)

      router.replace("/dashboard/cats")
    } catch (error) {
      console.log(error)
      
      alert(error.errors[0] || "unexpected error")
    }
  }
</script>