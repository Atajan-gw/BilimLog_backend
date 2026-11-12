import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import DashboardView from '../views/DashboardView.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/student/login', component: LoginView },
    { path: '/student', component: DashboardView, meta: { requiresAuth: true } },
    { path: '/:pathMatch(.*)*', redirect: '/student' },
  ],
})

router.beforeEach((to) => {
  const token = localStorage.getItem('student_api_token')
  if (to.meta.requiresAuth && !token) return '/student/login'
  if (to.path === '/student/login' && token) return '/student'
})

export default router
