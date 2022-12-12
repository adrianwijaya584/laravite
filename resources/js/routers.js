import { createRouter, createWebHistory } from "vue-router"

const routes= [
  {
    path: "/",
    component: ()=> import("./pages/index.vue")
  },
  {
    path: "/login",
    component: ()=> import("./pages/login.vue")
  },
  {
    path: "/about",
    component: ()=> import("./pages/about.vue")
  },
  {
    path: "/dashboard",
    component: ()=> import("./layouts/authenticated.vue"),
    children: [
      {
        path: "cats",
        component: ()=> import("./pages/dashboard/cats/index.vue"),
      }
    ]
  }
]

const routers= createRouter({
  history: createWebHistory(),  
  routes
})

export default routers