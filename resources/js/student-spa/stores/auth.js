import { defineStore } from 'pinia'
import api from '../api/client'

export const useAuthStore = defineStore('auth', {
  state: () => ({ user: null, token: localStorage.getItem('student_api_token') }),
  getters: { isAuthenticated: (state) => Boolean(state.token) },
  actions: {
    async login(credentials) {
      const { data } = await api.post('/login', credentials)
      this.token = data.token
      this.user = data.user
      localStorage.setItem('student_api_token', data.token)
    },
    async register(payload) {
      const { data } = await api.post('/register', payload)
      this.token = data.token
      this.user = data.user
      localStorage.setItem('student_api_token', data.token)
    },
    async fetchMe() {
      const { data } = await api.get('/me')
      this.user = data.user
    },
    async logout() {
      try { await api.post('/logout') } finally {
        this.token = null; this.user = null
        localStorage.removeItem('student_api_token')
      }
    },
  },
})
