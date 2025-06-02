<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div class="bg-transparant">
        <img src="../asset/img/logo.png" alt="logo" width="50" />
    </div>
</template>
