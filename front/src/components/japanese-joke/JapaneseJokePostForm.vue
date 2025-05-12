<script setup lang="ts">
import { ref, computed } from 'vue';
import { useToast } from 'vue-toastification';
import { japaneseJokeService, type JapaneseJokeTheme } from '../../api/japaneseJokeService';

const props = defineProps<{
  currentTheme: JapaneseJokeTheme | null
  onSubmitSuccess?: () => void
}>();

const toast = useToast();

const content = ref('');
const authorName = ref('');
const isSubmitting = ref(false);
const characterLimit = 200;

const remainingChars = computed(() => {
  return characterLimit - content.value.length;
});

const isContentValid = computed(() => {
  return content.value.length > 0 && content.value.length <= characterLimit;
});

const submitDajare = async () => {
  if (!props.currentTheme || !isContentValid.value) {
    return;
  }

  try {
    isSubmitting.value = true;
    
    await japaneseJokeService.submitJapaneseJoke({
      theme_id: props.currentTheme.id,
      content: content.value,
      author_name: authorName.value || undefined,
    });
    
    toast.success('だじゃれを投稿しました！');
    content.value = '';
    
    if (props.onSubmitSuccess) {
      props.onSubmitSuccess();
    }
  } catch (error) {
    console.error('Failed to submit dajare:', error);
    toast.error('投稿に失敗しました。もう一度お試しください。');
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<template>
  <div class="max-w-2xl mx-auto mt-8">
    <div class="card paper-texture">
      <h2 class="text-xl font-medium text-gray-700 mb-4">だじゃれを投稿する</h2>
      
      <form @submit.prevent="submitDajare" class="space-y-4">
        <div>
          <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
            だじゃれ <span class="text-red-500">*</span>
          </label>
          <textarea 
            id="content"
            v-model="content"
            :maxlength="characterLimit"
            rows="4"
            class="input-field"
            placeholder="お題に合わせた面白いだじゃれを投稿してください"
            :disabled="!currentTheme || isSubmitting"
            required
          ></textarea>
          <div class="flex justify-between mt-1 text-sm">
            <span 
              class="text-gray-500"
              :class="{ 'text-red-500': remainingChars < 0 }"
            >
              残り {{ remainingChars }} 文字
            </span>
          </div>
        </div>
        
        <div>
          <label for="authorName" class="block text-sm font-medium text-gray-700 mb-1">
            ニックネーム（任意）
          </label>
          <input 
            id="authorName"
            type="text"
            v-model="authorName"
            class="input-field"
            placeholder="匿名で投稿する場合は空白のままにしてください"
            :disabled="!currentTheme || isSubmitting"
          />
        </div>
        
        <div class="pt-2">
          <button 
            type="submit" 
            class="btn-primary w-full flex justify-center items-center"
            :disabled="!currentTheme || !isContentValid || isSubmitting"
          >
            <span v-if="isSubmitting" class="mr-2">
              <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </span>
            <span>投稿する</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>