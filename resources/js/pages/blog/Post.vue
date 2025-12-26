<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    title: string;
    date: string;
    outline?: Array<string>;
}>();
</script>

<template>
    <Head :title="`${props.title} - Evan Robertson`" />

    <div
        class="min-h-screen bg-linear-to-br from-slate-950 via-amber-950/20 to-slate-950"
    >
        <!-- Header -->
        <header
            class="border-b border-orange-500/40 bg-slate-900/90 backdrop-blur-sm"
        >
            <div class="mx-auto max-w-6xl px-4 py-6">
                <div class="text-center">
                    <h1
                        class="mb-2 font-mono text-3xl font-bold text-orange-400"
                    >
                        Evan Robertson
                    </h1>
                    <p class="font-mono text-orange-200/80">
                        <Link
                            href="/"
                            class="transition-colors duration-200 hover:text-orange-300"
                            >Portfolio</Link
                        >
                        •
                        <Link
                            href="/blog"
                            class="transition-colors duration-200 hover:text-orange-300"
                            >Blog</Link
                        >
                    </p>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="mx-auto max-w-6xl p-4">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                <!-- Article Content -->
                <article class="lg:col-span-3">
                    <div
                        class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-8 backdrop-blur-sm"
                    >
                        <!-- Article Header -->
                        <header class="mb-8 border-b border-orange-500/30 pb-6">
                            <h1
                                class="mb-3 font-mono text-3xl font-bold text-orange-400"
                            >
                                {{ props.title }}
                            </h1>
                            <time class="font-mono text-sm text-amber-400">
                                {{ props.date }}
                            </time>
                        </header>

                        <!-- Article Content -->
                        <div
                            class="space-y-6 font-mono leading-relaxed text-orange-100"
                        >
                            <slot />
                        </div>

                        <!-- Article Footer -->
                        <footer class="mt-8 border-t border-orange-500/30 pt-6">
                            <Link
                                href="/blog"
                                class="inline-flex items-center font-mono text-sm text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                            >
                                ← Back to Blog
                            </Link>
                        </footer>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <!-- Table of Contents -->
                    <div
                        class="sticky top-4 rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
                    >
                        <Heading title="Table of Contents" />
                        <nav class="space-y-2">
                            <a
                                v-for="title in props.outline"
                                :key="title"
                                :href="`#${title}`"
                                class="block font-mono text-sm transition-colors duration-200 hover:text-orange-300"
                            >
                                {{ title }}
                            </a>
                            <a
                                href="#About-Me"
                                class="block font-mono text-sm transition-colors duration-200 hover:text-orange-300"
                                >About Me</a
                            >
                        </nav>
                    </div>
                </aside>
            </div>
            <!-- About Me Section -->
            <div
                class="mt-6 rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
            >
                <Heading title="About Me" />
                <div class="space-y-4 font-mono text-orange-100">
                    <p class="text-sm text-orange-200/60">
                        My name is Evan, I like to write simple and approachable
                        technical blogs, teach people (when I'm qualified to do
                        so), and build developer tooling with Rust. I spend most
                        of my time in closed-sourced projects so a blog is the
                        best way I can share things I've learned and discuss.
                    </p>
                    <p class="text-sm text-orange-200/60">
                        Please visit my
                        <Link
                            href="/"
                            class="font-bold text-orange-400 underline"
                            >Portfolio</Link
                        >
                        page if you'd like to learn more of get in touch with
                        me.
                    </p>
                </div>
            </div>
        </main>
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
</style>
