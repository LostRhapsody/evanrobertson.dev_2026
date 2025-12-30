# AGENTS.md - Development Guidelines

This file contains essential commands and code style guidelines for agentic coding assistants working in this Laravel + Vue + Inertia.js application.

## Build Commands

```bash
# Install PHP dependencies
composer install

- php - 8.4.1
- inertiajs/inertia-laravel (INERTIA) - v2
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- laravel/wayfinder (WAYFINDER) - v0
- laravel/mcp (MCP) - v0
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- @inertiajs/vue3 (INERTIA) - v2
- tailwindcss (TAILWINDCSS) - v4
- vue (VUE) - v3
- @laravel/vite-plugin-wayfinder (WAYFINDER) - v0
- eslint (ESLINT) - v9
- prettier (PRETTIER) - v3

# Build for production
npm run build

# Build for SSR
npm run build:ssr

# Start development servers (Laravel + Vite + Logs)
composer run dev

# Start SSR development servers
composer run dev:ssr

# Full project setup
composer run setup
```

## Testing Commands

```bash
# Run all tests
composer run test
# or
php artisan test

# Run tests in a specific file
php artisan test tests/Feature/ExampleTest.php

# Run a single test by name (recommended for focused testing)
php artisan test --filter="test_returns_a_successful_response"

# Run tests with coverage
php artisan test --coverage

# Run only unit tests
php artisan test tests/Unit

# Run only feature tests
php artisan test tests/Feature

# Run tests in parallel
php artisan test --parallel

# Run browser tests (if using Pest browser testing)
php artisan test --browser
```

## Linting & Formatting

```bash
# Lint and fix JavaScript/TypeScript/Vue files
npm run lint

# Format code with Prettier
npm run format

# Check formatting without fixing
npm run format:check

# PHP code formatting and linting
vendor/bin/pint

# Check PHP formatting without fixing
vendor/bin/pint --test

# Run only on changed files
vendor/bin/pint --dirty
```

## Code Style Guidelines

### PHP Code Style

- **Constructor Property Promotion**: Use PHP 8 constructor property promotion

    ```php
    public function __construct(public GitHub $github) {}
    ```

- **Return Types**: Always use explicit return type declarations

    ```php
    public function rules(): array
    {
        return ['name' => 'required|string|max:255'];
    }
    ```

=== tests rules ===

## Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test` with a specific filename or filter.


=== inertia-laravel/core rules ===
- **Validation**: Use Form Request classes for validation, include custom error messages
- **Eloquent**: Prefer relationship methods over raw queries, use eager loading
- **Comments**: Use PHPDoc blocks, avoid inline comments unless complex logic
- **Arrays**: Add shape type definitions in PHPDoc when appropriate

### TypeScript/Vue Code Style

- **Imports**: Use named imports for tree-shaking, prefer absolute imports with `@/`

    ```typescript
    import { cn } from '@/lib/utils';
    import { Link } from '@inertiajs/vue3';
    ```

- **Component Structure**: Single root element, use `<script setup lang="ts">`
- **TypeScript**: Strict mode enabled, explicit types required
- **Props**: Use interface extends with defaults

    ```typescript
    interface Props extends PrimitiveProps {
        variant?: ButtonVariants['variant'];
        size?: ButtonVariants['size'];
    }

    const props = withDefaults(defineProps<Props>(), {
        as: 'button',
    });
    ```

- **Navigation**: Use `<Link>` from Inertia instead of traditional links
- **Styling**: Use Tailwind CSS classes, leverage `cn()` utility for conditional classes
- **Dark Mode**: Support dark mode using `dark:` prefixes when applicable

### Naming Conventions

- **Components**: PascalCase for Vue components (`Button.vue`, `UserProfile.vue`)
- **Files**: kebab-case for file names (`user-profile.vue`)
- **Variables**: camelCase (`userProfile`, `isLoading`)
- **Functions**: camelCase (`handleSubmit`, `formatDate`)
- **Constants**: UPPER_SNAKE_CASE (`API_BASE_URL`)
- **PHP Classes**: PascalCase (`UserController`, `ProfileUpdateRequest`)
- **Methods**: camelCase (`getUsers()`, `validateInput()`)

### File Structure

```
resources/js/
├── components/
│   ├── ui/          # Reusable UI components
│   └── ...          # Feature-specific components
├── composables/     # Vue composables
├── layouts/         # Layout components
├── lib/             # Utilities and helpers
├── pages/           # Inertia pages
└── types/           # TypeScript type definitions

app/
├── Http/
│   ├── Controllers/ # HTTP controllers
│   └── Requests/    # Form request validation
├── Models/          # Eloquent models
└── ...              # Other Laravel directories
```

### Error Handling

- **Frontend**: Use Inertia's error handling in forms, display validation errors
- **Backend**: Use Laravel's validation with custom messages
- **API Responses**: Use appropriate HTTP status codes (`assertForbidden()`, `assertNotFound()`)
- **Logging**: Use Laravel's logging facilities for debugging

### Testing Guidelines

- **Test Structure**: Use Pest testing framework
- **Test Types**: Feature tests for HTTP endpoints, Unit tests for logic
- **Assertions**: Use specific assertion methods (`assertSuccessful()`, `assertForbidden()`)
- **Mocking**: Use Pest's mocking functions when needed
- **Datasets**: Use datasets for parameterized tests
- **Coverage**: Focus on happy paths, failure paths, and edge cases

### Performance

- **Lazy Loading**: Use Inertia's deferred props for performance
- **Eager Loading**: Use `with()` for N+1 query prevention
- **SSR**: Consider server-side rendering for SEO-critical pages
- **Bundle Splitting**: Leverage Vite's code splitting capabilities

### Security

- **Validation**: Always validate user input on both frontend and backend
- **Authentication**: Use Laravel's built-in auth features
- **Authorization**: Implement policies and gates for access control
- **Secrets**: Never commit environment variables or secrets

### Git Workflow

- **Commits**: Use descriptive commit messages focusing on "why" not "what"
- **Branches**: Feature branches for new work
- **Testing**: Run tests before committing
- **Linting**: Run linters before pushing

### Development Tools

- **Laravel Boost**: Use available MCP tools for database queries, tinker, etc.
- **Wayfinder**: Use for type-safe route generation
- **Pint**: Automatic PHP code formatting
- **ESLint + Prettier**: JavaScript/TypeScript/Vue formatting and linting

Remember to run `vendor/bin/pint --dirty` and `npm run lint` before finalizing changes to ensure code quality.</content>
<parameter name="filePath">AGENTS.md
