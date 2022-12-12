import { useLocalStorage } from "@vueuse/core";
import { defineStore } from "pinia";

const useAuthStore= defineStore("auth", {
  state: ()=> ({
    accessToken: useLocalStorage("accessToken", "")
  }),
  actions: {
    setAccessToken(token) {
      this.accessToken= token
    }
  }
})

export default useAuthStore