<script setup lang="ts">
   import Image from "@/components/Image.vue";
   import Post from "./Post.vue"
   import blogPosts from "./post-list";
   import Heading from "@/components/Heading.vue";
   const tableOfContents = [
      "Skeleton",
      "Definitions",
      "Clients",
      "Servers",
   ]
</script>
<template>
   <Post :title=blogPosts[0].title :date=blogPosts[0].date :outline=tableOfContents>
      <Heading title="WIP Notice" />
      <p>This is a work in process, but I haven't disabled the auto-deploy system for this website yet, so as soon as I
         save my changes to github, this will be LIVE. Which is fine and not a big deal. Just letting you know, this
         blog post is about 10% done.</p>
      <Heading title="End of WIP Notice" />
      <p>The amount of technical jargon we are bombarded with daily is overwhelming, especially when you're first
         learning. Being a studen in College learning about programming and networking, lots of simple concepts went
         over my head, just due to how convuluted it sounded, while in practice being not that complex at all!</p>
      <p>One of those concepts was client-server architecutre. What does it mean, what does it apply to?</p>
      <p>If you're coming from a technical background, you probably have the correct assumption a browser is the client
         and whatever computer that hosts the website is a server. That would be correct! But it applies to more than
         just that.</p>
      <p>If you're just starting your journey, and you didn't know a browser acts as a client, or what 'hosting' a
         website even means, that's okay! We'll talk about all that and more.</p>
      <Heading title="What is a Simple Man's Summary?" />
      <p>
         "A Simple Man's Summary" is my version of "A dummy's guide to:", and they are often summaries I write for
         myself. When someone approaches me with a complex topic I don't understand, I sit down with them and draft A
         Simple Man's Summary. <strong>Because I am, quite honestly, a simple man,</strong> and complex things
         don't sit well with me.
      </p>
      <a target="_" href="https://grugbrain.dev/">
         <Image src="https://grugbrain.dev/grug.png" alt="The grug brained developer meme/logo/image" align="center"
            width="300px" />
      </a>
      <Heading title="Skeleton" />
      <p>
         This is a skeleton section to plan out how I want to write this blog post.
      </p>
      <ol>
         <li>1. I'd like it to start with the fact that the communication between <em>things</em> can be quite
            confusing.
         </li>
         <li>2. Then, move onto what a client is, and give examples.</li>
         <li>3. Same for server.</li>
         <li>4. Provide some examples of some client server communication scenarios</li>
         <li>5. How does it apply?</li>
      </ol>
      <Heading title="Definitions" />
      <p>
         So what are we talking about?
      </p>
      <Heading title="Clients" />
      <p>
         So what are we talking about?
      </p>
      <Heading title="Servers" />
      <p>
         So what are we talking about?
      </p>
   </Post>
</template>