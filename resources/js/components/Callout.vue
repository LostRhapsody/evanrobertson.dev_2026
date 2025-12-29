<!--
    Callout component for blog posts.
    Highlights important information with distinct visual styles for different types.
    Supports warning, error, info, tip, and note variants.
    Matches the orange/slate theme of the portfolio site.
-->
<script setup lang="ts">
interface Props {
    type: 'warning' | 'error' | 'info' | 'tip' | 'note';
    title?: string;
}

const props = withDefaults(defineProps<Props>(), {
    title: undefined,
});

const typeConfig = {
    warning: {
        borderColor: 'border-amber-500/60',
        bgColor: 'bg-amber-900/20',
        titleColor: 'text-amber-400',
        icon: '⚠️',
        defaultTitle: 'Warning',
    },
    error: {
        borderColor: 'border-red-500/60',
        bgColor: 'bg-red-900/20',
        titleColor: 'text-red-400',
        icon: '❌',
        defaultTitle: 'Error',
    },
    info: {
        borderColor: 'border-blue-500/60',
        bgColor: 'bg-blue-900/20',
        titleColor: 'text-blue-400',
        icon: 'ℹ️',
        defaultTitle: 'Info',
    },
    tip: {
        borderColor: 'border-green-500/60',
        bgColor: 'bg-green-900/20',
        titleColor: 'text-green-400',
        icon: '💡',
        defaultTitle: 'Tip',
    },
    note: {
        borderColor: 'border-slate-400/60',
        bgColor: 'bg-slate-700/40',
        titleColor: 'text-slate-300',
        icon: '📝',
        defaultTitle: 'Note',
    },
};

const config = typeConfig[props.type];
const displayTitle = props.title ?? config.defaultTitle;
</script>

<template>
    <div
        :class="[
            'my-6 rounded-lg border-l-4 p-4 backdrop-blur-sm',
            config.borderColor,
            config.bgColor,
        ]"
    >
        <div class="flex items-start gap-3">
            <span class="text-xl" aria-hidden="true">{{ config.icon }}</span>
            <div class="flex-1">
                <h4
                    :class="['mb-2 font-mono font-semibold', config.titleColor]"
                >
                    {{ displayTitle }}
                </h4>
                <div class="font-mono text-sm text-orange-100/90">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
div {
    transition: box-shadow 0.3s ease;
}

div:hover {
    box-shadow:
        inset 0 0 0 1px rgb(251 146 60 / 0.2),
        0 0 15px rgb(251 146 60 / 0.1);
}
</style>

