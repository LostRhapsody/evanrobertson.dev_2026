<!--
    Simple image component for blog posts.
    Accepts src, alt, optional alignment (left, center, right), and natural dimensions.
    Matches orange/slate theme of the portfolio site.
    Supports lazy loading and prevents content shifting with explicit dimensions.
-->
<script setup lang="ts">
import { ref } from 'vue';

interface Props {
    src: string;
    alt: string;
    align?: 'left' | 'center' | 'right';
    width?: string;
    height?: string;
    naturalWidth?: number;
    naturalHeight?: number;
}

withDefaults(defineProps<Props>(), {
    align: 'center',
    width: '500px',
    height: 'auto',
    naturalWidth: 500,
    naturalHeight: 500,
});

const alignmentClasses = {
    left: 'mr-auto',
    center: 'mx-auto',
    right: 'ml-auto',
};

const showTooltip = ref(false);
</script>

<template>
    <div
        :class="[
            'relative m-4 rounded-lg border border-orange-500/40 bg-slate-800/80 p-1 shadow-lg backdrop-blur-sm',
            alignmentClasses[align],
        ]"
        :style="{ width, height }"
        @mouseover="showTooltip = true"
        @mouseleave="showTooltip = false"
    >
        <img
            :src="src"
            :alt="alt"
            :width="naturalWidth"
            :height="naturalHeight"
            loading="lazy"
            class="h-auto max-w-full rounded-md"
        />
        <div
            v-if="showTooltip"
            class="absolute bottom-full left-1/2 z-10 -translate-x-1/2 transform rounded bg-slate-900 px-2 py-1 text-sm whitespace-nowrap text-white"
        >
            {{ alt }}
        </div>
    </div>
</template>

<style scoped>
img {
    transition: box-shadow 0.3s ease;
}

img:hover {
    box-shadow:
        inset 0 0 0 1px rgb(251 146 60 / 0.3),
        0 0 25px rgb(251 146 60 / 0.15);
}
</style>
