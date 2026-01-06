<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import SiteFooter from '@/components/SiteFooter.vue';
import SiteHeader from '@/components/SiteHeader.vue';
import { Head } from '@inertiajs/vue3';

const focusAreas = [
    {
        title: 'Frontend / Clients',
        description:
            'Proficient in using web technologies, GUIs, and command-line interfaces to build unopinionated clients for any backend or API.',
    },
    {
        title: 'Backend / Servers',
        description:
            'Expertise in systems programming with an emphasis on legacy enterprise systems and bleeding edge technologies.',
    },
    {
        title: 'Expertise',
        description:
            'Rust for systems programming, JavaScript/TypeScript for client or server development, Progress OpenEdge ABL for advanced business logic with tight database coupling, and PHP for well-rounded web development.',
    },
];

const workDescriptions = [
    {
        title: 'Enterprise Legacy Systems',
        description:
            'Long-term support, maintenance, and integrating new features for legacy enterprise systems for a wide variety of users and use-cases. Modernization of critical infrastructure into modern, reliable systems.',
    },
    {
        title: 'High-Performance APIs',
        description:
            'Designed and implemented high-performance, business critical APIs.',
    },
    {
        title: 'Developer Tooling',
        description:
            'Crafted practical and user-friendly developer tooling to enhance support and productivity to legacy systems. Brought modern developer experience to legacy langauges and platforms using Rust. Integrated linting, formatting, code generation, documentation tools, testing and code running framework, logging, project management, and more tooling.',
    },
    {
        title: 'Full-Stack Web Applications',
        description:
            'Utilized both classic and modern web technologies in a variety of full-stack web applications with a focus on B2B E-commerce, Enterprise Resource Planning (ERP), Warehouse Management Systems (WMS), and Customer Relationship Management (CRM) systems.',
    },
    {
        title: 'System Integration Projects',
        description:
            'Connected legacy enterprise systems through custom APIs and data pipelines to new cloud infrastructure and third-party systems, ensuring seamless data flow and efficient communication into new platforms for existing clients.',
    },
];

const platforms = [
    {
        name: 'GitHub',
        url: 'https://github.com/LostRhapsody',
        description: 'Open source projects',
    },
    {
        name: 'LinkedIn',
        url: 'https://linkedin.com/in/evan-robertson-dev',
        description: 'Professional networking',
    },
    {
        name: 'Email',
        url: 'mailto:evan.robertson77@gmail.com',
        description: 'evan.robertson77@gmail.com',
    },
];
</script>

<template>
    <Head title="Evan Robertson - Full Stack Developer" />

    <div
        class="min-h-screen bg-linear-to-br from-slate-950 via-amber-950/20 to-slate-950"
    >
        <!-- Header -->
        <SiteHeader />

        <!-- Main Content -->
        <main class="mx-auto max-w-6xl p-4">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- About Section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm"
                >
                    <Heading title="About" />
                    <div class="space-y-4 font-mono text-orange-100">
                        <p>
                            Full-stack developer. I enjoy building efficient and
                            performant software, and find joy in creating
                            foundational technology that assists and empowers
                            user's day-to-day activities.
                        </p>
                        <p>
                            Currently, my emphasis is on backend technologies
                            built on Rust, while adventuring into Laravel. My
                            background consists of Enterprise grade, full-stack
                            development, in a variety of technologies.
                        </p>
                        <div
                            class="space-y-2 rounded border border-orange-500/20 bg-slate-700/30 p-4 transition-all duration-300 hover:-translate-y-1 hover:scale-102"
                        >
                            <div class="flex items-center space-x-2">
                                <span class="text-amber-400">Location:</span>
                                <span>Remote / Eastern Time Zone</span>
                            </div>
                            <div class="mt-1 flex items-center space-x-2">
                                <span class="text-amber-400">Status:</span>
                                <span class="text-orange-400"
                                    >Available for freelance</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Focus Areas Section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm"
                >
                    <Heading title="What I Focus On" />
                    <div class="space-y-4">
                        <div
                            v-for="area in focusAreas"
                            :key="area.title"
                            class="space-y-2 rounded border border-orange-500/20 bg-slate-700/30 p-4 transition-all duration-300 hover:-translate-y-1 hover:scale-102"
                        >
                            <h3
                                class="font-mono text-sm font-semibold text-amber-400"
                            >
                                {{ area.title }}
                            </h3>
                            <p class="font-mono text-sm text-orange-100/80">
                                {{ area.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tools I've built section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm lg:col-span-2"
                >
                    <Heading title="Tools I've Built" />
                    <div class="space-y-3 font-mono text-orange-100">
                        <p class="mb-4 text-orange-200/60">
                            Sometimes, there is a gap in my workflow where there
                            isn't a tool perfect for me. In those cases, I try
                            and build my own. When these tools become polished
                            enough to share, I share them here.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <a
                                    href="/tools"
                                    class="text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                                >
                                    View my tools
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Experience Section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm lg:col-span-2"
                >
                    <Heading title="Projects I've Worked On" />
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div
                            v-for="work in workDescriptions"
                            :key="work.title"
                            class="rounded border border-orange-500/20 bg-slate-700/30 p-4 transition-all duration-300 hover:-translate-y-1 hover:scale-102"
                        >
                            <h3
                                class="mb-3 font-mono text-base font-bold text-orange-400"
                            >
                                {{ work.title }}
                            </h3>
                            <p
                                class="font-mono text-sm leading-relaxed text-orange-100/80"
                            >
                                {{ work.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Link to blog -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm lg:col-span-2"
                >
                    <Heading title="Blog" />
                    <div class="space-y-3 font-mono text-orange-100">
                        <p class="mb-4 text-orange-200/60">
                            I do some writing with interactive blogs if you're
                            interested:
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <a
                                    href="/blog"
                                    class="text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                                >
                                    My Blog
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm"
                >
                    <Heading title="Contact" />
                    <div class="space-y-3 font-mono text-orange-100">
                        <p class="mb-4 text-orange-200/60">
                            Feel free to reach out for collaboration
                            opportunities, technical discussions, or just to say
                            hello!
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <span class="w-16 text-sm text-amber-400"
                                    >Email:</span
                                >
                                <a
                                    href="mailto:evan.robertson77@gmail.com"
                                    class="text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                                >
                                    evan.robertson77@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Platforms Section -->
                <div
                    class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-4 backdrop-blur-sm"
                >
                    <Heading title="Find Me On" />
                    <div class="space-y-3">
                        <div
                            v-for="platform in platforms"
                            :key="platform.name"
                            class="flex items-center justify-between space-y-2 rounded border border-orange-500/20 bg-slate-700/30 p-4 transition-all duration-300 hover:-translate-y-1 hover:scale-102"
                        >
                            <div class="flex-1">
                                <h3
                                    class="font-mono text-sm font-bold text-orange-400"
                                >
                                    {{ platform.name }}
                                </h3>
                                <p class="font-mono text-xs text-orange-200/60">
                                    {{ platform.description }}
                                </p>
                            </div>
                            <a
                                :href="platform.url"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-sm text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline"
                            >
                                Visit →
                            </a>
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
</style>
