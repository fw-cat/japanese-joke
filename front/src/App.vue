<script setup lang="ts">
import { RouterView } from 'vue-router';
import AppHeader from './components/layout/AppHeader.vue';
import AppFooter from './components/layout/AppFooter.vue';
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <AppHeader />
    <main class="flex-grow pb-16">
      <RouterView />
    </main>
    <AppFooter />
  </div>
</template>