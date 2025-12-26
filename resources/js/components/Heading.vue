<!-- 
    Accepts title and optional description.
    Auto-assigns an ID using the title, so it should be 1 unique heading per-page.
    Spaces in the title are replaced with "-" so use a "-" when referencing with an anchor `<a>` tag.
-->
<script setup lang="ts">
    interface Props {
        title: string;
        description?: string;
    }

    const props = defineProps<Props>();

    const id = props.title.replace(" ", "-");
</script>

<template>
    <div>
        <h2 :id=id class="mb-4 border-b border-orange-500/30 pb-2 font-mono text-lg font-bold text-orange-400">{{
            title }}</h2>
        <p v-if="description" class="text-sm text-muted-foreground">
            {{ description }}
        </p>
    </div>
</template>
