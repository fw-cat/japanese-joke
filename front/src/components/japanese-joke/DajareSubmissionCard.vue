<script setup lang="ts">
import { computed } from 'vue';
import type { DajareSubmission } from '../../api/dajareService';

const props = defineProps<{
  submission: DajareSubmission
}>();

const formattedDate = computed(() => {
  if (!props.submission.created_at) return '';
  
  const date = new Date(props.submission.created_at);
  return date.toLocaleDateString('ja-JP', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
});

const authorDisplay = computed(() => {
  return props.submission.author_name || '匿名';
});
</script>

<template>
  <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow duration-200 bg-white animate-fade-in">
    <div class="text-lg font-medium mb-2 text-gray-800">{{ submission.content }}</div>
    <div class="flex justify-between items-center text-sm text-gray-500">
      <div class="flex items-center space-x-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span>{{ authorDisplay }}</span>
      </div>
      <div>{{ formattedDate }}</div>
    </div>
  </div>
</template>