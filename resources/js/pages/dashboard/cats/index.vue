<template>
  <div class="">
    <p>cats</p>

    <h3>Cat Data from api</h3>
    <div class="" v-for="cat, k in cats" :key="k">
      <p>{{cat.name}}</p>
    </div>
  </div>
</template>

<script lang="ts" setup>
import axios from './../../../utils/axiosClient';
import { onMounted, ref } from 'vue';

  const cats= ref([{name: ""}])

  async function getCats() {
    try {
      const {data}= await axios("cats")

      console.log(data);
      
      cats.value= data.data.cats
    } catch (error) {
      console.log(error);
    }
  }

  onMounted(()=> {
   getCats()
  })
</script>