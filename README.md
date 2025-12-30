# Evan Robertson Portfolio

A simple Laravel-based portfolio website.

## Why Laravel?

It's amazing! I'm not a PHP developer by trade, but I've opted for Laravel in case there are features I want that come with Laravel out of the box, such as mailing.

## Whose Evan?

I'm a full-stack developer, and this is a simple example website I use as my portfolio to discuss some of my skills and experience.

## Links

[Github](https://github.com/evanrobertson)
[LinkedIn](https://www.linkedin.com/in/evan-robertson-dev/)
[Portfolio](https://evanrobertson.dev)

## Getting Started (Development)

If you're interested in running this site locally, or your ME and forgot what to do, run these commands to install dependencies and test the build step:

```bash
npm i && composer install && npm run build
```

And this command to run the dev server:

```bash
composer dev
```

## Linting & Formatting

This project uses ESLint and Prettier for JavaScript/TypeScript/Vue code formatting, and Laravel Pint for PHP code formatting.

```bash
# Lint and fix JavaScript/TypeScript/Vue files
npm run lint

# Format code with Prettier
npm run format

# Check if code is formatted correctly (CI)
npm run format:check
```

### Backend (PHP)

```bash
# Format PHP code with Laravel Pint
vendor/bin/pint

# Format only changed files
vendor/bin/pint --dirty
```

### Testing

```bash
# Run all tests (Pest)
php artisan test

# Or using composer
composer test

# Run specific test file
php artisan test tests/Feature/CalculatorTest.php

# Run tests matching a filter
php artisan test --filter=calculator
```
