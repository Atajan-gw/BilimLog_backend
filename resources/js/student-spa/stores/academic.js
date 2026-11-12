import { defineStore } from 'pinia'
import api from '../api/client'

export const useAcademicStore = defineStore('academic', {
  state: () => ({ profile: null, grades: [], subjects: [], loading: false }),
  actions: {
    async loadDashboard() {
      this.loading = true
      try {
        const [profile, grades, subjects] = await Promise.all([
          api.get('/student/profile'), api.get('/student/grades'), api.get('/subjects'),
        ])
        this.profile = profile.data.data
        this.grades = grades.data.data.data ?? grades.data.data
        this.subjects = subjects.data.data.data ?? subjects.data.data
      } finally { this.loading = false }
    },
  },
})
