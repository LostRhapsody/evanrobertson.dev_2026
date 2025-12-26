<!--
    Simple image component for blog posts.
    Accepts src, alt, optional alignment (left, center, right), and natural dimensions.
    Matches orange/slate theme of the portfolio site.
    Supports lazy loading and prevents content shifting with explicit dimensions.
-->
<script setup lang="ts">
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
</script>

<template>
    <div
        :class="[
            'm-4 rounded-lg border border-orange-500/40 bg-slate-800/80 p-1 shadow-lg backdrop-blur-sm',
            alignmentClasses[align],
        ]"
        :style="{ width, height }"
    >
        <img
            :src="src"
            :alt="alt"
            :width="naturalWidth"
            :height="naturalHeight"
            loading="lazy"
            class="h-auto max-w-full rounded-md"
        />
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
