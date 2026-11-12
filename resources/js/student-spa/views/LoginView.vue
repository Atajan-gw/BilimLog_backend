<template>
  <section class="panel">
    <h2>Student sign in</h2>
    <form @submit.prevent="submit">
      <input v-model="form.name" placeholder="First name" required />
      <input v-model="form.surname" placeholder="Surname" required />
      <input v-model="form.phone_number" placeholder="Phone number" required />
      <input v-model="form.username" placeholder="Username" required />
      <input v-model="form.password" type="password" placeholder="Password" required />
      <button :disabled="busy">Sign in</button>
    </form>
    <p v-if="error" role="alert">{{ error }}</p>
  </section>
</template>
<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
const auth = useAuthStore(), router = useRouter()
const busy = ref(false), error = ref('')
const form = reactive({ name:'', surname:'', phone_number:'', username:'', password:'' })
const submit = async () => {
  busy.value = true; error.value = ''
  try { await auth.login(form); await router.push('/student') }
  catch (e) { error.value = e.response?.data?.message || 'Unable to sign in.' }
  finally { busy.value = false }
}
</script>
