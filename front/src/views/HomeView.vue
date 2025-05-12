<script setup lang="ts">
import { ref } from 'vue';
import JapaneseJokeTheme from '../components/japanese-joke/JapaneseJokeTheme.vue';
import JapaneseJokePostForm from '../components/japanese-joke/JapaneseJokePostForm.vue';
import JapaneseJokePostList from '../components/japanese-joke/JapaneseJokePostList.vue';
import type { JapaneseJokeTheme as JapaneseJokeThemeType } from '../api/japaneseJokeService';

const currentTheme = ref<JapaneseJokeThemeType | null>(null);
const refreshCounter = ref(0);

const handleThemeLoaded = (theme: JapaneseJokeThemeType) => {
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
        
        <JapaneseJokeTheme 
          :onThemeLoaded="handleThemeLoaded" 
        />
      </section>
      
      <section>
        <JapaneseJokePostForm 
          :currentTheme="currentTheme" 
          :onSubmitSuccess="handleSubmitSuccess"
        />
        
        <JapaneseJokePostList 
          :currentTheme="currentTheme"
          :refreshTrigger="refreshCounter"
        />
      </section>
    </div>
  </div>
</template>