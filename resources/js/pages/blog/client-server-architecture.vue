<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Image from '@/components/Image.vue';
import Post from './Post.vue';
import blogPosts from './post-list';
const tableOfContents = [
    'What is a Simple Man\s Summary?',
    'So What is Client-Server Architecture?',
    'Architecture',
    'Clients',
    'Servers',
    'Interactivity: Talk to the server!',
    'YouTube Example: Tying it together',
    'More Practical Programming Examples',
    'What are some benefits to this approach?',
];

import { ref } from 'vue';

interface ServerTimeResponse {
    time: string;
    formatted: string;
    timezone: string;
}

const serverResponse = ref<ServerTimeResponse | null>(null);
const isLoading = ref(false);
const error = ref<string | null>(null);

// Send an HTTP request to the server
async function callServer() {
    isLoading.value = true;
    error.value = null;
    serverResponse.value = null;

    try {
        const response = await fetch('/api/server-time');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        serverResponse.value = data;
    } catch (err) {
        error.value =
            err instanceof Error ? err.message : 'An unknown error occurred';
    } finally {
        isLoading.value = false;
    }
}
</script>
<template>
    <Post
        :title="blogPosts[0].title"
        :date="blogPosts[0].date"
        :outline="tableOfContents"
    >
        <p>
            The amount of technical jargon we are bombarded with daily is
            overwhelming, especially when you're first starting out. When I was
            a student in College learning about programming and networking, lots
            of simple concepts went over my head, just due to how convuluted it
            sounded, while in practice being not that complex at all!
        </p>
        <p>
            One of those concepts was client-server architecutre. What does it
            mean? What does it apply to?
        </p>
        <p>
            If you're coming from a technical background, you probably have the
            correct assumption a browser is the client and whatever computer
            that hosts the website is a server. That would be correct! But it
            applies to more than just websites.
        </p>
        <p>
            If you're just starting your journey, and you didn't know a browser
            acts as a client, or what 'hosting' a website even means, that's
            okay! We'll talk about all that and more.
        </p>
        <Heading title="What is a Simple Man's Summary?" />
        <p>
            "A Simple Man's Summary" is my version of "A dummy's guide to", and
            they are often summaries I write for myself. When someone approaches
            me with a complex topic I don't understand, I sit down with them and
            draft A Simple Man's Summary.
            <strong>Because I am, quite honestly, a simple man,</strong> and
            complex things don't sit well with me.
        </p>
        <a target="_" href="https://grugbrain.dev/">
            <Image
                src="https://grugbrain.dev/grug.png"
                alt="The grug brained developer meme/logo/image"
                align="center"
                width="300px"
            />
        </a>
        <Heading title="So What is Client-Server Architecture?" />
        <p>Let's start with some definitions!</p>
        <Heading title="Architecture" />
        <p>
            When we talk about architecture, we aren't talking about buildings!
            In this context, architecture simply refers to how we are designing
            a system. Imagine your favorite website, like YouTube.
        </p>
        <p>
            When you visit YouTube in your browser, you see lots of content that
            lives in your browser, buttons, thumbnails, and the video player,
            for example. But we know the videos themselves don't live in our
            browser; they come from YouTube, somehow!
        </p>
        <p>
            In this example, YouTube is our system. When Google is discussing
            how to design YouTube, they would refer to it's architecture pattern
            as a 'client-server' architecture pattern, where Google acts as the
            server and your browser acts as the client.
        </p>
        <Heading title="Clients" />
        <p>
            A client is not <em>just a web browser</em> though! A client can be
            many things.
        </p>
        <p>
            I like to define a client like so: If it is something that I
            interact with that requests information, data, or processes things
            somewhere else, it's a client.
        </p>
        <p>
            A good example is a web browser, because none of the content we see
            inside of a browser is from the browser itself. The browser's job is
            to ask for content from a server, like YouTube. YouTube then
            responds with data, and the browser displays it for you.
        </p>
        <p>For programmers, here's another example:</p>
        <p>
            A CLI (Command-Line Interface) tool that you use inside of a
            terminal can act as a client as well. Often, these programs are
            split into two distinct portions. One half will handle the display
            of information for you, and the other half "does the work", whatever
            that tool is supposed to do. A video converter might have a 'client'
            package that displays information and a 'server' package that
            performs the conversion.
        </p>
        <p>
            Many CLI tools and other applications use this model, so the code in
            the 'server' package can be re-used with other clients, such as a
            web site, a GUI, or a REST API.
        </p>
        <p>TODO: Add callout with definitions</p>
        <Heading title="Servers" />
        <p>
            A server is (more or less) another word for a computer. Any
            computer, including the phone or desktop you're reading this on, can
            be a server.
        </p>
        <p>
            I like to think of a server like this: If it's a computer running
            sofware that
            <em>serves</em> me data or information, such as feedback, images, or
            videos, it's a server.
        </p>
        <p>
            TODO: Add callout, a server is a piece of software, not the computer
            itself.
        </p>
        <p>
            A silly example is to think of a server in a restaurant. A server
            literally serves you food. In a similar sense, a computer server
            literally serves you data.
        </p>
        <p>
            In the client-server architecture pattern, it's the server's job to
            receive input from a client, perform an action of some sort, such as
            converting data from one format into another, and then respond with
            data that the client can use.
        </p>
        <Heading title="Interactivity: Talk to the server!" />
        <p>Click the button below. It will:</p>
        <ul>
            <li>1. Send an HTTP request to the server hosting this blog</li>
            <li>2. Process the request</li>
            <li>3. Respond with data</li>
        </ul>
        <div class="flex w-full justify-center">
            <button
                @click="callServer"
                class="cursor-pointer rounded-lg border border-orange-500/40 bg-slate-700/80 p-2 backdrop-blur-sm transition-all duration-100 active:-translate-y-0.5 active:scale-105"
            >
                Click me!
            </button>
        </div>
        <div
            class="mt-6 rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
        >
            <h3 class="mb-4 text-lg font-semibold text-orange-400">
                Server Response
            </h3>

            <div v-if="isLoading" class="text-center text-slate-300">
                <div class="animate-pulse">Loading server response...</div>
            </div>

            <div v-else-if="error" class="text-red-400">
                <strong>Error:</strong> {{ error }}
            </div>

            <div v-else-if="serverResponse" class="space-y-3">
                <div class="text-green-400">
                    <strong>✓ Success!</strong> The server responded with:
                </div>

                <div class="rounded bg-slate-900/50 p-4 font-mono text-sm">
                    <div class="text-slate-300">
                        <span class="text-blue-300">Server Time:</span>
                        <span class="text-yellow-300">{{
                            serverResponse.formatted
                        }}</span>
                    </div>
                    <div class="mt-2 text-slate-300">
                        <span class="text-blue-300">Timezone:</span>
                        <span class="text-yellow-300">{{
                            serverResponse.timezone
                        }}</span>
                    </div>
                    <div class="mt-2 text-slate-300">
                        <span class="text-blue-300">ISO Format:</span>
                        <span class="text-yellow-300">{{
                            serverResponse.time
                        }}</span>
                    </div>
                </div>
            </div>

            <div v-else class="text-slate-400 italic">
                Click the button above to see the server's response!
            </div>
        </div>
        <Heading title="YouTube Example: Tying it together" />
        <p>
            Going back to our YouTube example, we can see how it all works
            together.
        </p>
        <p>
            Our browser is a client. When we click a video, our browser sends a
            request to YouTube asking for the video to play. YouTube is the
            server, and it processes your request, finds the right video, and
            sends it back to your browser, the client, to be played.
        </p>
        <Heading title="More Practical Programming Examples" />
        <p>
            This pattern is very convenient because it matches our "HTTP Request
            Lifecycle" model very well, where a client will send an HTTP request
            to a server and receive an HTTP response.
        </p>
        <p>
            It's not just applicable to web sites and apps though! As mentioned
            earlier, we can use this in a variety of apps if we apply the
            correct mental model.
        </p>
        <p>
            Imagine a calculator app. At face value, it seems like a single
            application. A single screen, or GUI, with buttons that we input an
            expression into and the result is shown to us.
        </p>
        <p>TODO: Example, calculator app</p>
        <p>
            In the code itself though, it may be structured like a client and
            server instead though, where the client is the GUI that accepts user
            input, and the server is the actual calculator logic that performs
            the math and returns results.
        </p>
        <Heading title="What are some benefits to this approach?" />
        <p>
            1. It allows us to easily upgrade the client, meaning if we want to
            change how the UI looks, we don't need to re-write ANY of the 'math'
            code, we only need to change the UI code.
        </p>
        <p>
            2. It allows us to easily support a different client entirely. We
            could create a new client that's a CLI tool, a website, a REST API,
            whatever we want! As long as the client can send a "request", or
            talk to, the server, our math code, we can use ANY client without
            having to change our server.
        </p>
        <p>
            3. Separation of concerns. This is a 'programming rule' that you
            might have heard thrown around. While it's not gospel and we don't
            always need to adhere to it, it is good advice. Essentially, keep
            related code grouped together, and unrelated code separate. In our
            case, the UI code and the math code should be kept apart. This
            allows us to organize our project better so it's easier to find and
            debug things.
        </p>
        <p>
            todo: 1. **"When NOT to Use Client-Server Architecture"** - Brief
            section about when simpler approaches work better (like basic
            scripts, standalone tools) 2. **"What's Next?"** - Mention related
            concepts they might explore next (microservices, APIs, distributed
            systems) 3. **"Wrapping Up"** - A conclusion that reinforces the
            main takeaway with a call to action
        </p>
    </Post>
</template>
