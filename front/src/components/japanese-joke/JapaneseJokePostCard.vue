<script setup lang="ts">
import { type JapaneseJokePost } from '../../api/japaneseJokeService';

defineProps<{
  post: JapaneseJokePost
}>();
</script>

<template>
  <div class="bg-white rounded-lg shadow p-4">
    <p class="text-lg text-gray-800 mb-2">{{ post.content }}</p>
    <div class="flex justify-between items-center text-sm text-gray-500">
      <span v-if="post.author_name">投稿者: {{ post.author_name }}</span>
      <span v-else>匿名</span>
      <span>{{ new Date(post.created_at).toLocaleString() }}</span>
    </div>
  </div>
</template>