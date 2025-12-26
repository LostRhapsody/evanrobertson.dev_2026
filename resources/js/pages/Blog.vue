<script setup lang="ts">
   import { Head, Link } from '@inertiajs/vue3';
   import blogPosts from './blog/post-list';
</script>

<template>

   <Head title="Blog - Evan Robertson" />

   <div class="min-h-screen bg-linear-to-br from-slate-950 via-amber-950/20 to-slate-950">
      <!-- Header -->
      <header class="border-b border-orange-500/40 bg-slate-900/90 backdrop-blur-sm">
         <div class="mx-auto max-w-6xl px-4 py-6">
            <div class="text-center">
               <h1 class="mb-2 font-mono text-3xl font-bold text-orange-400">
                  Evan Robertson
               </h1>
               <p class="font-mono text-orange-200/80">
                  <Link href="/" class="transition-colors duration-200 hover:text-orange-300">Portfolio</Link>
               </p>
            </div>
         </div>
      </header>

      <!-- Main Content -->
      <main class="mx-auto max-w-6xl p-4">
         <div class="space-y-8">
            <!-- Blog Posts Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
               <div v-for="post in blogPosts" :key="post.slug"
                  class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 shadow-lg backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:scale-102">
                  <div class="mb-4">
                     <h3 class="mb-2 font-mono text-lg font-bold text-orange-400">
                        {{ post.title }}
                     </h3>
                     <p class="font-mono text-sm text-amber-400">
                        {{ post.date }}
                     </p>
                  </div>
                  <p class="mb-4 font-mono text-sm leading-relaxed text-orange-100/80">
                     {{ post.excerpt }}
                  </p>
                  <Link :href="`/blog/${post.slug}`"
                     class="inline-flex items-center font-mono text-sm text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline">
                     Read More →
                  </Link>
               </div>
            </div>

            <!-- Contact Section -->
            <div class="rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 shadow-lg backdrop-blur-sm">
               <h2 id="contact"
                  class="mb-4 border-b border-orange-500/30 pb-2 font-mono text-lg font-bold text-orange-400">
                  Portfolio
               </h2>
               <div class="space-y-3 font-mono text-orange-100">
                  <p class="mb-4 text-orange-200/60">
                     See my portfolio for more info about my work:
                  </p>
                  <div class="space-y-2">
                     <div class="flex items-center">
                        <Link href="/"
                           class="text-orange-400 underline-offset-2 transition-colors duration-200 hover:text-amber-400 hover:underline">
                           Portfolio
                        </Link>
                     </div>
                  </div>
               </div>
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
