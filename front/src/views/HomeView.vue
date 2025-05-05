<script setup lang="ts">
import { ref } from 'vue';
import DajareTheme from '@/components/japanese-joke/DajareTheme.vue';
import DajareSubmissionForm from '@/components/japanese-joke/DajareSubmissionForm.vue';
import DajareSubmissionList from '@/components/japanese-joke/DajareSubmissionList.vue';
import type { DajareTheme as DajareThemeType } from '@/api/dajareService';

const currentTheme = ref<DajareThemeType | null>(null);
const refreshCounter = ref(0);

const handleThemeLoaded = (theme: DajareThemeType) => {
  currentTheme.value = theme;
};

const handleSubmitSuccess = () => {
  refreshCounter.value += 1;
};
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
      <section class="mb-12">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-4 font-display text-primary-800">
          だじゃれの森へようこそ
        </h1>
        <p class="text-gray-600 text-center text-lg mb-8">
          お題に合わせて面白いだじゃれを投稿しよう！
        </p>
        
        <DajareTheme 
          :onThemeLoaded="handleThemeLoaded" 
        />
      </section>
      
      <section>
        <DajareSubmissionForm 
          :currentTheme="currentTheme" 
          :onSubmitSuccess="handleSubmitSuccess"
        />
        
        <DajareSubmissionList 
          :currentTheme="currentTheme"
          :refreshTrigger="refreshCounter"
        />
      </section>
    </div>
  </div>
</template>