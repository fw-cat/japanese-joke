<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { dajareService, type DajareTheme } from '../../api/dajareService';
import LoadingSpinner from '../ui/LoadingSpinner.vue';

const props = defineProps<{
  onThemeLoaded?: (theme: DajareTheme) => void
}>();

const currentTheme = ref<DajareTheme | null>(null);
const isLoading = ref(true);
const isError = ref(false);
const isAnimating = ref(false);

const loadRandomTheme = async () => {
  try {
    isLoading.value = true;
    isError.value = false;
    
    // If we already have a theme, trigger the animation
    if (currentTheme.value) {
      isAnimating.value = true;
      await new Promise(resolve => setTimeout(resolve, 500)); // Wait for animation
      currentTheme.value = null;
      await new Promise(resolve => setTimeout(resolve, 100)); // Small delay
    }
    
    const theme = await dajareService.getRandomTheme();
    currentTheme.value = theme;
    
    if (props.onThemeLoaded) {
      props.onThemeLoaded(theme);
    }
    
    isAnimating.value = false;
  } catch (error) {
    console.error('Failed to load random theme:', error);
    isError.value = true;
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  loadRandomTheme();
});
</script>

<template>
  <div class="theme-container">
    <div class="card paper-texture overflow-hidden">
      <div class="relative py-8 px-6">
        <div 
          class="absolute top-2 right-3 text-4xl rotate-12 text-accent-400 opacity-40 font-display"
        >
          お題
        </div>
        
        <h2 class="text-xl font-medium text-gray-600 mb-6">だじゃれのお題</h2>
        
        <div v-if="isLoading && !currentTheme" class="py-8 flex justify-center">
          <LoadingSpinner size="lg" />
        </div>
        
        <div v-else-if="isError" class="py-8 text-center">
          <p class="text-red-500 mb-4">テーマの読み込みに失敗しました</p>
          <button @click="loadRandomTheme" class="btn-primary">
            再試行
          </button>
        </div>
        
        <template v-else>
          <div 
            class="theme-content relative z-10"
            :class="{ 
              'animate-fade-in': !isAnimating, 
              'animate-slide-out': isAnimating 
            }"
          >
            <p class="text-3xl sm:text-4xl font-display font-bold text-primary-800 text-center my-6 leading-tight">
              {{ currentTheme?.theme }}
            </p>
          </div>
          
          <div class="flex justify-center mt-8">
            <button 
              @click="loadRandomTheme" 
              class="btn-secondary flex items-center space-x-2 group"
              :disabled="isLoading"
            >
              <span>別のお題</span>
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-5 w-5 transform transition-transform group-hover:rotate-180" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
            </button>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<style scoped>
.theme-container {
  @apply mx-auto max-w-2xl;
}

.animate-slide-out {
  animation: slideOut 0.5s ease-out forwards;
}

@keyframes slideOut {
  0% {
    transform: translateY(0);
    opacity: 1;
  }
  100% {
    transform: translateY(-20px);
    opacity: 0;
  }
}
</style>