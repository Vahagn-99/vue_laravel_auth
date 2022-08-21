import { createRouter, createWebHistory } from "vue-router";
import store from "@/store";

const routes = [
  {
    path: '/',
    redirect: "/home",
    component: () => import('@/layouts/AuthLayout.vue'),
    meta: { requiresAuth: true },
    children: [
      {
        path: '/home',
        name: 'Home',
        component: () => import('@/pages/Home.vue')
      },
      {
        path: '/products',
        name: 'Products',
        component: () => import('@/pages/Products.vue')
      },
      {
        path: '/logout',
        name: 'Logout',
        redirect: '/guest'
      },
    ]
  },

  {
    path: '/guest',
    redirect: { name: 'Login' },
    name: 'guest',
    component: () => import('@/layouts/GuestLayout.vue'),
    meta: { isGuest: true },
    children: [
      {
        path: '/login',
        name: 'Login',
        component: () => import('@/pages/Login.vue')
      },
      {
        path: '/registration',
        name: 'Registration',
        component: () => import('@/pages/Registration.vue')
      },
    ]
  },
  {
    path: "/:catchAll(.*)",
    name: "Not foud page",
    component: () => import('@/pages/NotFoundPage.vue')
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// console.log();
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  }
  else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "Home" })
  }
  else {
    next();
  }

})

export default router