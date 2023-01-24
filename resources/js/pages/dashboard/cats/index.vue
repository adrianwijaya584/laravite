<template>
  <div class="">
    <p>cats</p>

    <form @submit.prevent="addCat">
      <input type="text" placeholder="Cat name" v-model="catName" id="">
      <input type="text" placeholder="Cat race" v-model="catRace" id="">

      <button>Add </button>
    </form>

    <h3>Cat Data from api</h3>
    <div class="" v-for="cat, k in cats" :key="k">
      <p>{{cat.name}} {{cat.race}} <button @click="deleteCat(cat.id)">Delete</button></p>
    </div>
  </div>
</template>

<script lang="ts" setup>
import axios from './../../../utils/axiosClient';
import { onMounted, ref } from 'vue';

  const cats= ref([{name: "", id: 0, race: ""}])
  const catName= ref("")
  const catRace= ref("")

  async function deleteCat(id) {
    try {
      const data= await axios.delete(`/cats/${id}`)

      console.log(data)
    
      getCats()
    } catch (error) {
      console.log(error)
    }
  }

  async function addCat() {
    try {
      const data= await axios.post("/cats", {
        name: catName.value,
        race: catRace.value
      })

      catName.value= ""
      catRace.value= ""

      alert("cat successfully added.")

      getCats()
    } catch (error) {
      console.log(error);
    }
  }

  async function getCats() {
    try {
      const {data}= await axios("cats")

      cats.value= data.data.cats
    } catch (error) {
      console.log(error);
    }
  }

  onMounted(()=> {
   getCats()
  })
</script>