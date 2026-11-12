<template>
  <section>
    <h2>My academic dashboard</h2>
    <p v-if="store.loading">Loading…</p>
    <template v-else-if="store.profile">
      <div class="panel">
        <h3>{{ store.profile.user?.name }} {{ store.profile.user?.surname }}</h3>
        <p>Faculty: {{ store.profile.faculty?.name }}</p>
        <p>Group: {{ store.profile.group?.name }}</p>
        <p>Specialty: {{ store.profile.specialty }} · Course {{ store.profile.course_year }}</p>
        <p>Student card: {{ store.profile.student_id_card_number }}</p>
      </div>
      <div class="panel">
        <h3>Grades</h3>
        <table><thead><tr><th>Subject</th><th>Semester</th><th>Score</th></tr></thead>
          <tbody><tr v-for="grade in store.grades" :key="grade.id">
            <td>{{ grade.subject?.name }}</td><td>{{ grade.semester }}</td><td>{{ grade.score }}</td>
          </tr></tbody>
        </table>
      </div>
    </template>
  </section>
</template>
<script setup>
import { onMounted } from 'vue'
import { useAcademicStore } from '../stores/academic'
const store = useAcademicStore()
onMounted(() => store.loadDashboard())
</script>
