import { createRouter, createWebHistory } from "vue-router";
import login from "./views/login.vue";
import Dashboard from "./views/Dashboard.vue";
const routes = [
  {
    name: "Login",
    component: login,
    path: "/",
  },
  {
    name: "Dashboard",
    component: Dashboard,
    path: "/Dashboard",
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes, // Use 'routes' here
});

export default router;