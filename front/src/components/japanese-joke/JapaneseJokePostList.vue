<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { japaneseJokeService, type JapaneseJokePost, type JapaneseJokeTheme } from '../../api/japaneseJokeService';
import LoadingSpinner from '../ui/LoadingSpinner.vue';
import JapaneseJokePostCard from './JapaneseJokePostCard.vue';

const props = defineProps<{
  currentTheme: JapaneseJokeTheme | null
  refreshTrigger?: number
}>();

const posts = ref<JapaneseJokePost[]>([]);
const isLoading = ref(true);
const isError = ref(false);

const loadPosts = async () => {
  if (!props.currentTheme) {
    posts.value = [];
    isLoading.value = false;
    return;
  }
  
  try {
    isLoading.value = true;
    isError.value = false;
    
    const data = await japaneseJokeService.getPosts(props.currentTheme.id);
    posts.value = data;
  } catch (error) {
    console.error('Failed to load posts:', error);
    isError.value = true;
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  if (props.currentTheme) {
    loadPosts();
  }
});

watch(() => props.currentTheme, () => {
  if (props.currentTheme) {
    loadPosts();
  } else {
    posts.value = [];
  }
});

watch(() => props.refreshTrigger, () => {
  if (props.currentTheme) {
    loadPosts();
  }
});
</script>

<template>
  <div class="max-w-2xl mx-auto mt-8">
    <div class="card paper-texture">
      <h2 class="text-xl font-medium text-gray-700 mb-4 flex items-center justify-between">
        <span>投稿されただじゃれ</span>
        <button 
          v-if="currentTheme" 
          @click="loadPosts" 
          class="ml-2 p-2 text-primary-600 hover:text-primary-800 transition-colors"
          title="更新"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
        </button>
      </h2>
      
      <div v-if="isLoading" class="py-8 flex justify-center">
        <LoadingSpinner />
      </div>
      
      <div v-else-if="isError" class="py-8 text-center">
        <p class="text-red-500 mb-4">投稿の読み込みに失敗しました</p>
        <button @click="loadPosts" class="btn-primary">
          再試行
        </button>
      </div>
      
      <div v-else-if="!currentTheme" class="py-8 text-center text-gray-500">
        <p>お題を選択すると、投稿されただじゃれが表示されます</p>
      </div>
      
      <div v-else-if="posts.length === 0" class="py-8 text-center text-gray-500">
        <p>まだ投稿がありません。最初の投稿者になりましょう！</p>
      </div>
      
      <div v-else class="space-y-4">
        <JapaneseJokePostCard
          v-for="post in posts"
          :key="post.id"
          :post="post"
        />
      </div>
    </div>
  </div>
</template>