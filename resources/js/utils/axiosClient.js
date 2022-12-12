import axios from 'axios'
import router from './../routers'
import useAuthStore from './../store/auth'

const authStore= useAuthStore()

axios.interceptors.request.use(request=> {
  request.baseURL= "/api"

  request.headers.Authorization= `Bearer ${authStore.accessToken || ""}`

  return request
})

axios.interceptors.response.use((response)=> {
  return Promise.resolve(response)
}, ({response: error})=> {
  if (error.status==401) {
    authStore.setAccessToken("")
    return router.replace("/login")
  }

  return Promise.reject(error.data)
})

export default axios