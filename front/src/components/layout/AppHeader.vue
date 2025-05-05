<script setup lang="ts">
import { ref } from 'vue';

const isMobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>

<template>
  <header class="bg-gradient-to-r from-primary-700 to-primary-800 text-white shadow-md">
    <div class="container mx-auto px-4 py-4 sm:py-6">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <router-link to="/" class="flex items-center">
            <span class="font-display text-2xl sm:text-3xl font-bold tracking-tight">だじゃれの森</span>
          </router-link>
        </div>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-6 items-center">
          <router-link 
            to="/" 
            class="font-medium hover:text-primary-200 transition-colors duration-200"
            active-class="text-accent-300 font-semibold"
          >
            ホーム
          </router-link>
          <a 
            href="#" 
            class="btn-secondary bg-white/10 hover:bg-white/20 border-white/20 text-white"
          >
            使い方
          </a>
        </nav>
        
        <!-- Mobile menu button -->
        <button 
          @click="toggleMobileMenu"
          class="md:hidden p-2 rounded-lg hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-white/30"
          aria-label="メニュー"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      
      <!-- Mobile Navigation -->
      <div 
        v-show="isMobileMenuOpen" 
        class="md:hidden mt-3 py-3 border-t border-primary-600"
      >
        <router-link 
          to="/" 
          class="block py-2 px-4 font-medium hover:bg-primary-600 rounded-lg transition-colors duration-200"
          active-class="bg-primary-600 font-semibold"
        >
          ホーム
        </router-link>
        <a 
          href="#" 
          class="block py-2 px-4 font-medium hover:bg-primary-600 rounded-lg transition-colors duration-200"
        >
          使い方
        </a>
      </div>
    </div>
  </header>
</template>