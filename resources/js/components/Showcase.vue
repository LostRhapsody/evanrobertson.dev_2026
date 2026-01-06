<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import SiteFooter from '@/components/SiteFooter.vue';
import SiteHeader from '@/components/SiteHeader.vue';
import { toSlug } from '@/lib/utils';
import { Head, Link } from '@inertiajs/vue3';

interface TechPill {
    name: string;
    color?: string;
}

interface GalleryItem {
    src: string;
    alt: string;
    caption?: string;
}

export type { GalleryItem };

const props = defineProps<{
    title: string;
    tagline: string;
    githubUrl: string;
    status?: string;
    version?: string;
    technologies?: TechPill[];
    gallery?: GalleryItem[];
    outline?: Array<{ title: string; level: number }>;
}>();

const getTechColor = (color?: string) => {
    const colors: Record<string, string> = {
        rust: 'bg-orange-500/30 text-orange-300',
        javascript: 'bg-yellow-500/30 text-yellow-300',
        typescript: 'bg-blue-500/30 text-blue-300',
        vue: 'bg-green-500/30 text-green-300',
        react: 'bg-cyan-500/30 text-cyan-300',
        laravel: 'bg-red-500/30 text-red-300',
        php: 'bg-purple-500/30 text-purple-300',
        default: 'bg-slate-500/30 text-slate-300',
    };
    return colors[color?.toLowerCase() || 'default'] || colors.default;
};

const getStatusColor = (status?: string) => {
    const colors: Record<string, string> = {
        stable: 'bg-green-500/30 text-green-300 border-green-500/40',
        beta: 'bg-yellow-500/30 text-yellow-300 border-yellow-500/40',
        alpha: 'bg-orange-500/30 text-orange-300 border-orange-500/40',
        experimental: 'bg-red-500/30 text-red-300 border-red-500/40',
        default: 'bg-slate-500/30 text-slate-300 border-slate-500/40',
    };
    return colors[status?.toLowerCase() || 'default'] || colors.default;
};
</script>

<template>
    <Head :title="`${props.title} - Evan Robertson`" />

    <div
        class="min-h-screen bg-linear-to-br from-slate-950 via-amber-950/20 to-slate-950"
    >
        <!-- Header -->
        <SiteHeader />

        <!-- Main Content -->
        <main class="mx-auto max-w-7xl p-4">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                <!-- Sidebar (Mobile) -->
                <aside
                    v-if="props.outline && props.outline.length > 0"
                    class="md:col-span-1 lg:hidden"
                >
                    <!-- Table of Contents -->
                    <div
                        class="sticky top-4 rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
                    >
                        <Heading title="Table of Contents" />
                        <nav class="space-y-2">
                            <a
                                v-for="item in props.outline"
                                :key="item.title"
                                :href="`#${toSlug(item.title)}`"
                                :class="[
                                    'block font-mono text-sm transition-colors duration-200 hover:text-orange-300',
                                    item.level === 2
                                        ? 'ml-4'
                                        : item.level === 3
                                          ? 'ml-8'
                                          : '',
                                ]"
                            >
                                {{ item.title }}
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Article Content -->
                <article class="lg:col-span-3">
                    <div
                        class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-8 backdrop-blur-sm"
                    >
                        <!-- Article Header -->
                        <header class="mb-8">
                            <h1
                                class="mb-3 font-mono text-3xl font-bold text-orange-400"
                            >
                                {{ props.title }}
                            </h1>
                            <p class="mb-4 font-mono text-orange-100/80">
                                {{ props.tagline }}
                            </p>

                            <!-- Metadata badges -->
                            <div class="flex flex-wrap gap-2">
                                <span
                                    v-if="props.status"
                                    :class="[
                                        'rounded border px-2 py-1 font-mono text-xs',
                                        getStatusColor(props.status),
                                    ]"
                                >
                                    {{ props.status }}
                                </span>
                                <span
                                    v-if="props.version"
                                    class="rounded border border-slate-500/40 bg-slate-500/30 px-2 py-1 font-mono text-xs text-slate-300"
                                >
                                    v{{ props.version }}
                                </span>
                            </div>

                            <!-- Technology pills -->
                            <div
                                v-if="
                                    props.technologies &&
                                    props.technologies.length > 0
                                "
                                class="mt-4 flex flex-wrap gap-2"
                            >
                                <span
                                    v-for="tech in props.technologies"
                                    :key="tech.name"
                                    :class="[
                                        'rounded px-3 py-1 font-mono text-sm',
                                        getTechColor(tech.color),
                                    ]"
                                >
                                    {{ tech.name }}
                                </span>
                            </div>

                            <!-- GitHub link -->
                            <div class="mt-4">
                                <a
                                    :href="props.githubUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center font-mono text-sm text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                                >
                                    View on GitHub →
                                </a>
                            </div>
                        </header>

                        <!-- Gallery -->
                        <div
                            v-if="props.gallery && props.gallery.length > 0"
                            class="mb-8 space-y-4"
                        >
                            <div
                                v-for="(item, index) in props.gallery"
                                :key="index"
                                class="overflow-hidden rounded-lg border border-orange-500/40"
                            >
                                <a
                                    :href="item.src"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <img
                                        :src="item.src"
                                        :alt="item.alt"
                                        class="w-full"
                                    />
                                    <p
                                        v-if="item.caption"
                                        class="bg-slate-900/50 p-3 font-mono text-sm text-orange-100/60"
                                    >
                                        {{ item.caption }}
                                    </p>
                                </a>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div
                            class="space-y-6 font-mono leading-relaxed text-orange-100"
                        >
                            <slot />
                        </div>

                        <!-- Article Footer -->
                        <footer class="mt-8 border-t border-orange-500/30 pt-6">
                            <Link
                                href="/tools"
                                class="inline-flex items-center font-mono text-sm text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                            >
                                ← Back to Tools
                            </Link>
                        </footer>
                    </div>
                </article>

                <!-- Sidebar (Desktop) -->
                <aside
                    v-if="props.outline && props.outline.length > 0"
                    class="md:hidden lg:col-span-1 lg:block"
                >
                    <!-- Table of Contents -->
                    <div
                        class="sticky top-4 rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
                    >
                        <Heading title="Table of Contents" />
                        <nav class="space-y-2">
                            <a
                                v-for="item in props.outline"
                                :key="item.title"
                                :href="`#${toSlug(item.title)}`"
                                :class="[
                                    'block font-mono text-sm transition-colors duration-200 hover:text-orange-300',
                                    item.level === 2
                                        ? 'ml-4'
                                        : item.level === 3
                                          ? 'ml-8'
                                          : '',
                                ]"
                            >
                                {{ item.title }}
                            </a>
                        </nav>
                    </div>
                </aside>
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
</style>
