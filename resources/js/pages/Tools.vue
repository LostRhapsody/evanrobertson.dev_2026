<script setup lang="ts">
import SiteFooter from '@/components/SiteFooter.vue';
import SiteHeader from '@/components/SiteHeader.vue';
import { Head, Link } from '@inertiajs/vue3';

const tools = [
    {
        title: 'Megatile',
        excerpt:
            'An opinionated tiling window manager for Windows, written in Rust.',
        slug: 'megatile',
    },
];
</script>

<template>
    <Head title="Tools - Evan Robertson" />

    <div
        class="flex min-h-screen flex-col bg-linear-to-br from-slate-950 via-amber-950/20 to-slate-950"
    >
        <!-- Header -->
        <SiteHeader />

        <!-- Main Content -->
        <main class="mx-auto max-w-6xl flex-1 p-4">
            <div class="space-y-8">
                <!-- Blog Posts Grid -->
                <div
                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2"
                >
                    <div
                        v-for="tool in tools"
                        :key="tool.slug"
                        class="hover-panel rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
                    >
                        <div class="mb-4">
                            <h3
                                class="mb-2 font-mono text-lg font-bold text-orange-400"
                            >
                                {{ tool.title }}
                            </h3>
                        </div>
                        <p
                            class="mb-4 font-mono text-sm leading-relaxed text-orange-100/80"
                        >
                            {{ tool.excerpt }}
                        </p>
                        <Link
                            :href="`/tools/${tool.slug}`"
                            class="inline-flex items-center font-mono text-sm text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                        >
                            Read More →
                        </Link>
                    </div>
                </div>

                <!-- Contact Section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
                >
                    <h2
                        id="contact"
                        class="mb-4 border-b border-orange-500/30 pb-2 font-mono text-lg font-bold text-orange-400"
                    >
                        Portfolio
                    </h2>
                    <div class="space-y-3 font-mono text-orange-100">
                        <p class="mb-4 text-orange-200/60">
                            See my portfolio for more info about my work:
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <Link
                                    href="/"
                                    class="text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                                >
                                    Portfolio
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <SiteFooter />
    </div>
</template>

<style scoped>
/* Selection styling */
::selection {
    background-color: rgb(251 146 60 / 0.3);
}

/* Hover effects for panels */
.rounded-lg {
    transition: box-shadow 0.3s ease;
}

.rounded-lg:hover {
    box-shadow:
        inset 0 0 0 1px rgb(251 146 60 / 0.3),
        0 0 25px rgb(251 146 60 / 0.15);
}

.hover-panel {
    transition: translate 0.3s ease;
    transition: scale 0.3s ease;
}

.hover-panel:hover {
    translate: 0 -1px;
    scale: 1.01;
}
</style>
