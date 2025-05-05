<template>
  <footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <h2 class="font-display text-xl font-bold">だじゃれの森</h2>
          <p class="text-gray-400 text-sm mt-1">みんなで楽しむだじゃれの世界</p>
        </div>
        
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
          <div>
            <h3 class="text-lg font-medium mb-2">リンク</h3>
            <ul class="space-y-1">
              <li><router-link to="/" class="text-gray-400 hover:text-white transition-colors duration-200">ホーム</router-link></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">使い方</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="text-lg font-medium mb-2">お問い合わせ</h3>
            <ul class="space-y-1">
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">お問い合わせフォーム</a></li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="mt-8 pt-6 border-t border-gray-700 text-center text-gray-400 text-sm">
        <p>&copy; {{ new Date().getFullYear() }} だじゃれの森. All rights reserved.</p>
      </div>
    </div>
  </footer>
</template>