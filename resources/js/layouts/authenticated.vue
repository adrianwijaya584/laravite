<template>
  <div>
    <p>hello</p>
    <router-view></router-view>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import useAuthStore from '../store/auth';

  const authStore= useAuthStore()
  const router= useRouter()
  
  onMounted(()=> {
    if (!authStore.accessToken) {
      return router.replace("/login")
    }
  })
</script>