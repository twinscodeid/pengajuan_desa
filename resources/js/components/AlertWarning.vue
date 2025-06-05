<template>
    <transition name="fade">
      <div
        v-if="visible"
        class="bg-yellow-100 mt-5 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md mb-4"
        role="alert"
      >
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
            <path
              fill-rule="evenodd"
              d="M8.257 3.099c.763-1.36 2.683-1.36 3.446 0l6.518 11.618c.75 1.34-.213 3.033-1.723 3.033H3.462c-1.51 0-2.473-1.692-1.723-3.033L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-2a1 1 0 01-1-1V8a1 1 0 112 0v2a1 1 0 01-1 1z"
              clip-rule="evenodd"
            />
          </svg>
          <p class="text-sm">
            <slot>Pastikan login dulu.</slot>
          </p>
        </div>
      </div>
    </transition>
  </template>

  <script setup lang="ts">
  import { ref, onMounted } from 'vue';

  const visible = ref(true);

  onMounted(() => {
    setTimeout(() => {
      visible.value = false;
    }, 5000);
  });
  </script>

  <style scoped>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease;
  }
  .fade-enter-from, .fade-leave-to {
    opacity: 0;
  }
  </style>
