<template>
  <div class="">
    <p>test 123</p>
    <p>{{counter}}</p>

    <button @click="counter++">+</button>
    <button @click="counter-=1">-</button>
    <router-link to="/about">About</router-link>

    <div v-for="cat, k in cats" :key="k">
      <p>{{cat}}</p>
    </div>
  </div>
</template>

<script lang="ts" setup>
  import { onMounted, ref } from 'vue';
  import axiosClient from './../utils/axiosClient'
  import {useLocalStorage} from '@vueuse/core'

  const counter= useLocalStorage("counter", 0)
  const cats= ref([])

  onMounted(async ()=> {
    try {
      const {data}= await axiosClient("/api/cats")

      console.log(data) 

      cats.value= data
      
    } catch (error) {
      console.log(error);
      
    }
  })
</script>