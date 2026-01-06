<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header
        class="border-b border-orange-500/40 bg-slate-900/90 backdrop-blur-sm"
    >
        <div class="mx-auto max-w-6xl px-4 py-6">
            <div class="text-center">
                <h1 class="mb-2 font-mono text-3xl font-bold text-orange-400">
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
                    •
                    <Link
                        href="/tools"
                        class="transition-colors duration-200 hover:text-orange-300"
                        >Tools</Link
                    >
                </p>
            </div>
        </div>
    </header>
</template>
