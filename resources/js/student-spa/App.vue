<template>
  <main class="shell">
    <header><h1>Student Portal</h1><button v-if="auth.isAuthenticated" @click="logout">Log out</button></header>
    <RouterView />
  </main>
</template>
<script setup>
import { useAuthStore } from './stores/auth'
const auth = useAuthStore()
const logout = async () => { await auth.logout() }
</script>
<style>
body{font-family:system-ui;background:#f4f6fa;margin:0;color:#172033}.shell{max-width:960px;margin:40px auto;padding:20px}
header{display:flex;align-items:center;justify-content:space-between}.panel{background:white;padding:24px;border-radius:12px;margin:16px 0}
input,button{padding:10px;margin:5px}button{cursor:pointer}
</style>
