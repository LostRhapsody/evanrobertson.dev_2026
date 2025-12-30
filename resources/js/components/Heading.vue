<!--
    Accepts title and optional description.
    Auto-assigns an ID using the title, so it should be 1 unique heading per-page.
    Uses URL-safe slug for the ID.
-->
<script setup lang="ts">
import { toSlug } from '@/lib/utils';

interface Props {
    title: string;
    description?: string;
}

const props = defineProps<Props>();

const id = toSlug(props.title);
</script>

<template>
    <div>
        <h2
            :id="id"
            class="mb-4 border-b border-orange-500/30 pb-2 font-mono text-lg font-bold text-orange-400"
        >
            {{ title }}
        </h2>
        <p v-if="description" class="text-sm text-muted-foreground">
            {{ description }}
        </p>
    </div>
</template>
