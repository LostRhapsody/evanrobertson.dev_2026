<script setup lang="ts">
import Callout from '@/components/Callout.vue';
import Heading from '@/components/Heading.vue';
import { ref } from 'vue';
import Post from './Post.vue';
import blogPosts from './post-list';

const tableOfContents = [
    'What is OAuth?',
    'Why Use OAuth?',
    'OAuth Flow Overview',
    'Setting Up OAuth',
    'Client Registration',
    'Authorization Code Flow',
    'Token Exchange',
    'Handling User Data',
    'Security Considerations',
    'Common Pitfalls',
    'Implementation Example',
    'Testing OAuth Integration',
    'Troubleshooting',
    'Best Practices',
    'Wrapping Up',
];

interface OAuthUser {
    id: string;
    name: string;
    email: string;
    avatar?: string;
}

interface OAuthTokens {
    access_token: string;
    refresh_token: string;
    token_type: string;
    expires_in: number;
    scope: string;
}

const isLoggedIn = ref(false);
const user = ref<OAuthUser | null>(null);
const tokens = ref<OAuthTokens | null>(null);
const isLoading = ref(false);
const error = ref<string | null>(null);

// OAuth state refs for demo
const authCode = ref('');
const clientId = ref('your-client-id');
const clientSecret = ref('your-client-secret');
const redirectUri = ref('http://localhost:8000/callback');
const oauthUrl = ref('');

async function initiateOAuth() {
    isLoading.value = true;
    error.value = null;

    try {
        // Build OAuth authorization URL
        const params = new URLSearchParams({
            response_type: 'code',
            client_id: clientId.value,
            redirect_uri: redirectUri.value,
            scope: 'openid profile email',
            state: 'random-state-value',
        });

        oauthUrl.value = `https://oauth-provider.com/authorize?${params}`;

        // In a real app, this would redirect or open popup
        // For demo, we'll simulate the flow
        window.open(oauthUrl.value, '_blank');
    } catch (err) {
        error.value =
            err instanceof Error ? err.message : 'OAuth initiation failed';
    } finally {
        isLoading.value = false;
    }
}

async function exchangeCodeForTokens(code: string) {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await fetch('/api/oauth/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                code: code,
                client_id: clientId.value,
                client_secret: clientSecret.value,
                redirect_uri: redirectUri.value,
                grant_type: 'authorization_code',
            }),
        });

        if (!response.ok) {
            throw new Error(`Token exchange failed: ${response.status}`);
        }

        const data = await response.json();
        tokens.value = data;
        await fetchUserProfile();
    } catch (err) {
        error.value =
            err instanceof Error ? err.message : 'Token exchange failed';
    } finally {
        isLoading.value = false;
    }
}

async function fetchUserProfile() {
    if (!tokens.value) return;

    try {
        const response = await fetch('/api/oauth/user', {
            headers: {
                Authorization: `Bearer ${tokens.value.access_token}`,
            },
        });

        if (!response.ok) {
            throw new Error('Failed to fetch user profile');
        }

        const userData = await response.json();
        user.value = userData;
        isLoggedIn.value = true;
    } catch (err) {
        error.value =
            err instanceof Error ? err.message : 'Profile fetch failed';
    }
}

async function refreshAccessToken() {
    if (!tokens.value?.refresh_token) return;

    try {
        const response = await fetch('/api/oauth/refresh', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                refresh_token: tokens.value.refresh_token,
                client_id: clientId.value,
                client_secret: clientSecret.value,
                grant_type: 'refresh_token',
            }),
        });

        if (!response.ok) {
            throw new Error('Token refresh failed');
        }

        const data = await response.json();
        tokens.value = { ...tokens.value, ...data };
    } catch (err) {
        error.value =
            err instanceof Error ? err.message : 'Token refresh failed';
    }
}

function logout() {
    isLoggedIn.value = false;
    user.value = null;
    tokens.value = null;
    error.value = null;
}

// Simulate receiving auth code from redirect
function simulateAuthCode(code: string) {
    authCode.value = code;
    exchangeCodeForTokens(code);
}
</script>

<template>
    <Post
        :title="
            blogPosts.find((p) => p.slug === 'oauth-integration')?.title ||
            'OAuth Integration Guide'
        "
        :date="
            blogPosts.find((p) => p.slug === 'oauth-integration')?.date ||
            new Date().toISOString().split('T')[0]
        "
        :outline="tableOfContents"
    >
        <!-- Introduction Section -->
        <p>
            <!-- Introduction paragraph about OAuth -->
        </p>

        <p>
            <!-- More introductory content -->
        </p>

        <Heading title="What is OAuth?" />
        <p>
            <!-- Explanation of OAuth -->
        </p>

        <Heading title="Why Use OAuth?" />
        <p>
            <!-- Benefits and use cases -->
        </p>

        <Callout type="info" title="Key OAuth Terms">
            <ul class="list-disc space-y-2 pl-4">
                <li>
                    <strong>Authorization Server:</strong>
                    <!-- Definition -->
                </li>
                <li>
                    <strong>Resource Server:</strong>
                    <!-- Definition -->
                </li>
                <li>
                    <strong>Client Application:</strong>
                    <!-- Definition -->
                </li>
                <li>
                    <strong>Access Token:</strong>
                    <!-- Definition -->
                </li>
                <li>
                    <strong>Refresh Token:</strong>
                    <!-- Definition -->
                </li>
                <li>
                    <strong>Scopes:</strong>
                    <!-- Definition -->
                </li>
            </ul>
        </Callout>

        <Heading title="OAuth Flow Overview" />
        <p>
            <!-- High-level overview of OAuth flows -->
        </p>

        <!-- Interactive OAuth Demo Section -->
        <Heading title="OAuth Integration Demo" />

        <div class="mb-6 flex w-full justify-center">
            <button
                v-if="!isLoggedIn"
                @click="initiateOAuth"
                :disabled="isLoading"
                class="cursor-pointer rounded-lg border border-blue-500/40 bg-slate-700/80 px-6 py-3 backdrop-blur-sm transition-all duration-100 hover:bg-slate-600 active:-translate-y-0.5 active:scale-105 disabled:opacity-50"
            >
                {{ isLoading ? 'Connecting...' : 'Connect with OAuth' }}
            </button>

            <button
                v-else
                @click="logout"
                class="cursor-pointer rounded-lg border border-red-500/40 bg-slate-700/80 px-6 py-3 backdrop-blur-sm transition-all duration-100 hover:bg-slate-600 active:-translate-y-0.5 active:scale-105"
            >
                Logout
            </button>
        </div>

        <!-- OAuth Configuration Section -->
        <div
            class="mb-6 rounded-lg border border-blue-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
        >
            <h3 class="mb-4 text-lg font-semibold text-blue-400">
                OAuth Configuration
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-300"
                        >Client ID</label
                    >
                    <input
                        v-model="clientId"
                        type="text"
                        class="w-full rounded border border-slate-600 bg-slate-900/50 px-3 py-2 text-slate-100 focus:border-blue-400 focus:outline-none"
                        placeholder="your-oauth-client-id"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-300"
                        >Client Secret</label
                    >
                    <input
                        v-model="clientSecret"
                        type="password"
                        class="w-full rounded border border-slate-600 bg-slate-900/50 px-3 py-2 text-slate-100 focus:border-blue-400 focus:outline-none"
                        placeholder="your-oauth-client-secret"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-300"
                        >Redirect URI</label
                    >
                    <input
                        v-model="redirectUri"
                        type="url"
                        class="w-full rounded border border-slate-600 bg-slate-900/50 px-3 py-2 text-slate-100 focus:border-blue-400 focus:outline-none"
                        placeholder="http://localhost:8000/callback"
                    />
                </div>
            </div>
        </div>

        <!-- Status Display -->
        <div
            class="mb-6 rounded-lg border border-blue-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
        >
            <h3 class="mb-4 text-lg font-semibold text-blue-400">
                Authentication Status
            </h3>

            <div v-if="isLoading" class="text-center text-slate-300">
                <div class="animate-pulse">Processing OAuth request...</div>
            </div>

            <div v-else-if="error" class="text-red-400">
                <strong>Error:</strong> {{ error }}
            </div>

            <div v-else-if="isLoggedIn && user" class="space-y-3">
                <div class="text-green-400">
                    <strong>✓ Successfully authenticated!</strong>
                </div>

                <div class="rounded bg-slate-900/50 p-4">
                    <div class="text-slate-300">
                        <span class="text-blue-300">User:</span>
                        <span class="text-yellow-300">{{ user.name }}</span>
                    </div>
                    <div class="mt-2 text-slate-300">
                        <span class="text-blue-300">Email:</span>
                        <span class="text-yellow-300">{{ user.email }}</span>
                    </div>
                    <div v-if="user.avatar" class="mt-2">
                        <span class="text-blue-300">Avatar:</span>
                        <img
                            :src="user.avatar"
                            :alt="user.name"
                            class="ml-2 inline-block h-8 w-8 rounded-full"
                        />
                    </div>
                </div>
            </div>

            <div v-else class="text-slate-400 italic">
                Not authenticated. Click "Connect with OAuth" to begin.
            </div>
        </div>

        <!-- Token Information (for educational purposes) -->
        <div
            v-if="tokens"
            class="mb-6 rounded-lg border border-green-500/40 bg-slate-800/80 p-6 backdrop-blur-sm"
        >
            <h3 class="mb-4 text-lg font-semibold text-green-400">
                Token Information
            </h3>

            <div
                class="space-y-2 rounded bg-slate-900/50 p-4 font-mono text-sm"
            >
                <div class="text-slate-300">
                    <span class="text-blue-300">Token Type:</span>
                    <span class="text-yellow-300">{{ tokens.token_type }}</span>
                </div>
                <div class="text-slate-300">
                    <span class="text-blue-300">Expires In:</span>
                    <span class="text-yellow-300"
                        >{{ tokens.expires_in }} seconds</span
                    >
                </div>
                <div class="text-slate-300">
                    <span class="text-blue-300">Scope:</span>
                    <span class="text-yellow-300">{{ tokens.scope }}</span>
                </div>
                <div class="text-slate-300">
                    <span class="text-blue-300">Access Token:</span>
                    <span class="text-yellow-300"
                        >{{ tokens.access_token.substring(0, 20) }}...</span
                    >
                </div>
            </div>
        </div>

        <Heading title="Setting Up OAuth" />
        <p>
            <!-- Setup instructions -->
        </p>

        <Heading title="Client Registration" />
        <p>
            <!-- How to register with OAuth provider -->
        </p>

        <Heading title="Authorization Code Flow" />
        <p>
            <!-- Detailed explanation of auth code flow -->
        </p>

        <Heading title="Token Exchange" />
        <p>
            <!-- How to exchange code for tokens -->
        </p>

        <Heading title="Handling User Data" />
        <p>
            <!-- Working with user profile data -->
        </p>

        <Heading title="Security Considerations" />
        <p>
            <!-- Security best practices -->
        </p>

        <Callout type="warning" title="Security Best Practices">
            <ul class="list-disc space-y-2 pl-4">
                <li><!-- Security tip --></li>
                <li><!-- Security tip --></li>
                <li><!-- Security tip --></li>
            </ul>
        </Callout>

        <Heading title="Common Pitfalls" />
        <p>
            <!-- Common mistakes and how to avoid them -->
        </p>

        <Heading title="Implementation Example" />
        <p>
            <!-- Code examples and implementation details -->
        </p>

        <Heading title="Testing OAuth Integration" />
        <p>
            <!-- How to test OAuth flows -->
        </p>

        <Heading title="Troubleshooting" />
        <p>
            <!-- Common issues and solutions -->
        </p>

        <Heading title="Best Practices" />
        <p>
            <!-- Best practices for OAuth implementation -->
        </p>

        <Heading title="Wrapping Up" />
        <p>
            <!-- Summary and conclusion -->
        </p>

        <Callout type="tip" title="Remember">
            <p>
                <!-- Key takeaway -->
            </p>
        </Callout>
    </Post>
</template>
