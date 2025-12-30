<script setup lang="ts">
import Callout from '@/components/Callout.vue';
import Heading from '@/components/Heading.vue';
import Image from '@/components/Image.vue';
import { ref } from 'vue';
import Post from './Post.vue';
import blogPosts from './post-list';

const tableOfContents = [
    "What is a Simple Man's Summary?",
    'So What is Client-Server Architecture?',
    'Architecture',
    'Clients',
    'Servers',
    'Interactivity: Talk to the server!',
    'YouTube Example',
    'More Practical Programming Examples',
    'Calculator Example: Putting It All Together',
    'What are some benefits to this approach?',
    'Wrapping Things Up',
];

interface ServerTimeResponse {
    time: string;
    formatted: string;
    timezone: string;
}

const serverResponse = ref<ServerTimeResponse | null>(null);
const isLoading = ref(false);
const error = ref<string | null>(null);

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

interface CalculatorResponse {
    number1: number;
    number2: number;
    operation: string;
    result: number;
}

const calcDisplay = ref('0');
const calcNumber1 = ref<number | null>(null);
const calcNumber2 = ref<number | null>(null);
const calcOperation = ref<'add' | 'subtract' | null>(null);
const calcResult = ref<CalculatorResponse | null>(null);
const calcIsLoading = ref(false);
const calcError = ref<string | null>(null);
const calcIsNewNumber = ref(true);

function calcInputDigit(digit: string) {
    if (calcIsNewNumber.value) {
        calcDisplay.value = digit;
        calcIsNewNumber.value = false;
    } else {
        calcDisplay.value =
            calcDisplay.value === '0' ? digit : calcDisplay.value + digit;
    }
}

function calcSetOperation(op: 'add' | 'subtract') {
    calcNumber1.value = parseFloat(calcDisplay.value);
    calcOperation.value = op;
    calcIsNewNumber.value = true;
    calcResult.value = null;
    calcError.value = null;
}

function calcClear() {
    calcDisplay.value = '0';
    calcNumber1.value = null;
    calcNumber2.value = null;
    calcOperation.value = null;
    calcResult.value = null;
    calcError.value = null;
    calcIsNewNumber.value = true;
}

async function calcEquals() {
    if (calcNumber1.value === null || calcOperation.value === null) {
        return;
    }

    calcNumber2.value = parseFloat(calcDisplay.value);
    calcIsLoading.value = true;
    calcError.value = null;
    calcResult.value = null;

    try {
        const response = await fetch('/api/calculator', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
            },
            body: JSON.stringify({
                number1: calcNumber1.value,
                number2: calcNumber2.value,
                operation: calcOperation.value,
            }),
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(
                errorData.message || `HTTP error! status: ${response.status}`,
            );
        }

        const data = await response.json();
        calcResult.value = data;
        calcDisplay.value = String(data.result);
        calcNumber1.value = data.result;
        calcIsNewNumber.value = true;
    } catch (err) {
        calcError.value =
            err instanceof Error ? err.message : 'An unknown error occurred';
    } finally {
        calcIsLoading.value = false;
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
                alt="The grug brained developer meme/logo/image. I recommend giving them a visit later!"
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
        <Callout type="info" title="Key Terms">
            <ul class="list-disc space-y-2 pl-4">
                <li>
                    <strong>GUI</strong> (Graphical User Interface): A visual
                    interface with windows, icons, and buttons that allows users
                    to interact with software. e.g. the calculator app on your
                    PC.
                    <a
                        href="https://en.wikipedia.org/wiki/Graphical_user_interface"
                        target="_blank"
                        class="text-blue-400 underline hover:text-blue-300"
                        >Learn more</a
                    >
                </li>
                <li>
                    <strong>HTTP</strong> (Hypertext Transfer Protocol): The
                    protocol used to transfer data on the web. It defines how
                    messages are formatted and transmitted between clients and
                    servers.
                    <a
                        href="https://developer.mozilla.org/en-US/docs/Web/HTTP"
                        target="_blank"
                        class="text-blue-400 underline hover:text-blue-300"
                        >MDN Docs</a
                    >
                </li>
                <li>
                    <strong>REST</strong> (Representational State Transfer): An
                    architectural style for designing networked applications,
                    using standard HTTP methods like GET and POST.
                    <a
                        href="https://developer.mozilla.org/en-US/docs/Glossary/REST"
                        target="_blank"
                        class="text-blue-400 underline hover:text-blue-300"
                        >MDN Docs</a
                    >
                </li>
                <li>
                    <strong>API</strong> (Application Programming Interface): A
                    set of rules that allows different software applications to
                    communicate with each other.
                    <a
                        href="https://developer.mozilla.org/en-US/docs/Glossary/API"
                        target="_blank"
                        class="text-blue-400 underline hover:text-blue-300"
                        >MDN Docs</a
                    >
                </li>
            </ul>
        </Callout>
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
        <Callout type="info" title="What is a server?">
            <p>
                A server is a piece of software, not the computer hardware
                itself. A practical example is an 'HTTP Server'. This is very
                common software built into a lot of applications. It's main job
                is to wait for HTTP requests to come in so it can digest it and
                pass the data onto the next software piece.
                <a
                    href="https://developer.mozilla.org/en-US/docs/Learn_web_development/Howto/Web_mechanics/What_is_a_web_server"
                    target="_blank"
                    class="text-blue-400 underline hover:text-blue-300"
                    >Learn more</a
                >
            </p>
        </Callout>
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
        <Heading title="YouTube Example" />
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
        <p>
            In the code itself though, it may be structured like a client and
            server instead though, where the client is the GUI that accepts user
            input, and the server is the actual calculator logic that performs
            the math and returns results.
        </p>
        <Heading title="Calculator Example: Putting It All Together" />
        <p>
            The best way to learn is to see a practical, hands-on example. Below
            is a simple calculator that demonstrates the client-server
            architecture in action.
        </p>
        <p>
            <strong>How it works:</strong>
        </p>
        <ul class="list-disc space-y-2 pl-6">
            <li>
                <strong>The Client (this website):</strong> The calculator UI
                below is the client. It displays the number pad, captures your
                input, and shows results.
            </li>
            <li>
                <strong>The Server (where the math happens):</strong> When you
                press "=", the client sends your numbers and operation to the
                server. The server performs the actual calculation and sends
                back the result.
            </li>
            <li>
                <strong>No math is performed</strong> on this website. It's all
                done on the server that is sending this website to your
                computer.
            </li>
        </ul>
        <Callout type="tip" title="Why do it this way?">
            <p>
                For a simple calculator, doing the math on the server might seem
                like overkill. But this demonstrates the pattern very well. In a
                real application, the "server" might be performing complex
                calculations, accessing a database, or processing data that
                can't be done on the client.
            </p>
        </Callout>
        <p>
            Our example calculator supports addition and subtraction operations
            with 2 operands. Try it out:
        </p>
        <!-- Calculator UI -->
        <div
            class="mx-auto mt-6 max-w-sm rounded-lg border border-orange-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
        >
            <h3 class="mb-4 text-center text-lg font-semibold text-orange-400">
                Client-Server Calculator
            </h3>

            <!-- Display -->
            <div
                class="mb-4 truncate rounded bg-slate-900/70 p-4 text-right font-mono text-2xl text-green-400"
            >
                {{ calcDisplay }}
            </div>

            <!-- Operation indicator -->
            <div
                v-if="calcOperation"
                class="mb-2 text-center text-sm text-orange-300"
            >
                {{ calcNumber1 }} {{ calcOperation === 'add' ? '+' : '-' }} ...
            </div>

            <!-- Number pad -->
            <div class="grid grid-cols-4 gap-2">
                <!-- Row 1: 7, 8, 9, + -->
                <button
                    v-for="digit in ['7', '8', '9']"
                    :key="digit"
                    @click="calcInputDigit(digit)"
                    class="cursor-pointer rounded bg-slate-700 p-3 font-mono text-lg text-orange-100 transition-colors hover:bg-slate-600 active:bg-slate-500"
                >
                    {{ digit }}
                </button>
                <button
                    @click="calcSetOperation('add')"
                    :class="[
                        'cursor-pointer rounded p-3 font-mono text-lg transition-colors',
                        calcOperation === 'add'
                            ? 'bg-orange-600 text-white'
                            : 'bg-orange-500/30 text-orange-300 hover:bg-orange-500/50',
                    ]"
                >
                    +
                </button>

                <!-- Row 2: 4, 5, 6, - -->
                <button
                    v-for="digit in ['4', '5', '6']"
                    :key="digit"
                    @click="calcInputDigit(digit)"
                    class="cursor-pointer rounded bg-slate-700 p-3 font-mono text-lg text-orange-100 transition-colors hover:bg-slate-600 active:bg-slate-500"
                >
                    {{ digit }}
                </button>
                <button
                    @click="calcSetOperation('subtract')"
                    :class="[
                        'cursor-pointer rounded p-3 font-mono text-lg transition-colors',
                        calcOperation === 'subtract'
                            ? 'bg-orange-600 text-white'
                            : 'bg-orange-500/30 text-orange-300 hover:bg-orange-500/50',
                    ]"
                >
                    -
                </button>

                <!-- Row 3: 1, 2, 3, = -->
                <button
                    v-for="digit in ['1', '2', '3']"
                    :key="digit"
                    @click="calcInputDigit(digit)"
                    class="cursor-pointer rounded bg-slate-700 p-3 font-mono text-lg text-orange-100 transition-colors hover:bg-slate-600 active:bg-slate-500"
                >
                    {{ digit }}
                </button>
                <button
                    @click="calcEquals"
                    :disabled="calcIsLoading"
                    class="cursor-pointer rounded bg-green-600 p-3 font-mono text-lg text-white transition-colors hover:bg-green-500 active:bg-green-400 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ calcIsLoading ? '...' : '=' }}
                </button>

                <!-- Row 4: C, 0, (empty), (empty) -->
                <button
                    @click="calcClear"
                    class="cursor-pointer rounded bg-red-500/30 p-3 font-mono text-lg text-red-300 transition-colors hover:bg-red-500/50 active:bg-red-500/70"
                >
                    C
                </button>
                <button
                    @click="calcInputDigit('0')"
                    class="col-span-2 cursor-pointer rounded bg-slate-700 p-3 font-mono text-lg text-orange-100 transition-colors hover:bg-slate-600 active:bg-slate-500"
                >
                    0
                </button>
            </div>

            <!-- Error display -->
            <div v-if="calcError" class="mt-4 text-center text-sm text-red-400">
                <strong>Error:</strong> {{ calcError }}
            </div>

            <!-- Result from server -->
            <div v-if="calcResult" class="mt-4 rounded bg-slate-900/50 p-3">
                <div class="text-xs text-slate-400">Server Response:</div>
                <div class="font-mono text-sm text-green-400">
                    {{ calcResult.number1 }}
                    {{ calcResult.operation === 'add' ? '+' : '-' }}
                    {{ calcResult.number2 }} = {{ calcResult.result }}
                </div>
            </div>
        </div>
        <p class="mt-6">
            <strong>What just happened?</strong> When you clicked "=", the
            following occurred:
        </p>
        <ul class="list-decimal space-y-2 pl-6">
            <li>
                The client (this page) collected your input: the two numbers and
                the operation you selected.
            </li>
            <li>
                The client sent an HTTP POST request to the server at
                <code class="rounded bg-slate-700 px-1 text-orange-300"
                    >/api/calculator</code
                >
                with your data.
            </li>
            <li>
                The server received the request, performed the calculation
                (addition or subtraction), and sent back the result.
            </li>
            <li>The client received the response and displayed the result.</li>
        </ul>
        <Callout type="note" title="Real-world applications">
            <p>
                This exact pattern powers everything from search engines to
                banking apps. The complexity of the "calculation" on the server
                can range from simple math to machine learning models, database
                queries, or complex business logic. The client never needs to
                know the details. It just needs to build and send the request
                and receive and parse the response.
            </p>
            <br />
            <p>
                This makes maintaining code much easier, as your complex server
                code never has to care about the client, and vice-versa.
            </p>
        </Callout>
        <Heading title="What are some benefits to this approach?" />
        <p>
            1. It allows us to easily upgrade the client, meaning if we want to
            change how the UI looks, we don't need to re-write ANY of the
            'server' code, we only need to change the UI code.
        </p>
        <p>
            2. It allows us to easily support a different client entirely. We
            could create a new client that's a CLI tool, a website, a REST API,
            whatever we want! As long as the client can send a "request", or
            talk to, the server, we can use <em>any</em> client without having
            to change our server.
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
        <Heading title="Wrapping Things Up" />
        <p>Let's recap what we've learned about client-server architecture:</p>
        <ul class="list-disc space-y-2 pl-6">
            <li>
                <strong>Architecture</strong> refers to how we design and
                structure a system.
            </li>
            <li>
                <strong>Clients</strong> are the interfaces we interact with
                that request data or processing from somewhere else.
            </li>
            <li>
                <strong>Servers</strong> are computers that receive requests,
                process them, and send back responses.
            </li>
            <li>
                This pattern is everywhere: websites, apps, CLI tools, and even
                desktop applications.
            </li>
        </ul>
        <p>
            The beauty of client-server architecture is its simplicity and
            flexibility. By separating what the user sees (the client) from
            where the work happens (the server), we can build more maintainable,
            reusable, and scalable applications.
        </p>
        <Callout type="tip" title="Remember">
            <p>
                The client-server model isn't just for web development. Any time
                you have a separation between an interface and the logic that
                powers it, you're using this pattern!
            </p>
        </Callout>
    </Post>
</template>
