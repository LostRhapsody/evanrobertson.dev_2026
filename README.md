# Evan Robertson - Portfolio Website

A TUI-style (Text User Interface) portfolio website built with Laravel and Vue.js, featuring a warm orange/red color scheme and clean monospace design.

## 🚀 Features

- **TUI-Style Design**: Clean text-based interface inspired by terminal applications
- **Orange/Red Theme**: Warm amber and orange colors with dark background
- **Monospace Typography**: JetBrains Mono and Fira Code fonts for authentic feel
- **Responsive Layout**: Grid-based design that works on all device sizes
- **Static Content**: No animations or interactions - accessible to everyone
- **Professional Focus**: Clean, readable portfolio sections
- **Modern Stack**: Laravel 12 + Vue 3 + Inertia.js + Tailwind CSS

## 🛠️ Tech Stack

### Backend
- **PHP 8.5** - Latest PHP version with modern features
- **Laravel 12** - Robust PHP framework
- **Inertia.js** - Modern monolithic approach

### Frontend
- **Vue.js 3** - Progressive JavaScript framework
- **TypeScript** - Type-safe JavaScript
- **Tailwind CSS 4** - Utility-first CSS framework
- **Vite** - Fast build tool and dev server

### Development Tools
- **Laravel Boost** - Enhanced development experience
- **Laravel Pint** - Code style fixer
- **Pest** - Elegant testing framework
- **ESLint & Prettier** - Code quality and formatting

## 📋 Portfolio Sections

The portfolio features a clean, static layout with organized sections:

- **About** - Introduction and current focus
- **What I Focus On** - Core competencies and expertise areas
- **Projects I've Worked On** - Descriptions of enterprise work
- **Contact** - Direct email communication
- **Find Me On** - Professional and social links

## 🚀 Getting Started

### Prerequisites

- PHP 8.2 or higher
- Node.js 18 or higher
- Composer

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/evanrobertson.dev_2026.git
   cd evanrobertson.dev_2026
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Build assets**
   ```bash
   npm run build
   ```

5. **Start development server**
   ```bash
   composer run dev
   ```

   This will start:
   - Laravel development server (http://localhost:8000)
   - Vite dev server with HMR
   - Queue worker
   - Log monitoring

## 🏗️ Architecture

### Simplified Structure
This portfolio uses a minimal Laravel setup with authentication and database features removed:

- **Single Route**: Everything runs through the main portfolio SPA
- **No Database**: Static content only, no user accounts or dynamic data
- **Clean Dependencies**: Removed Fortify and related auth packages

### Key Files
- `resources/js/pages/Portfolio.vue` - Main portfolio component
- `routes/web.php` - Single route configuration
- `resources/css/app.css` - Terminal-themed styling
- `resources/views/app.blade.php` - Base HTML layout

## 🎨 Customization

### Terminal Theme
The terminal theme is defined in `resources/css/app.css` with CSS custom properties:

```css
:root {
    --background: hsl(0 0% 5%);
    --foreground: hsl(120 100% 85%);
    --primary: hsl(120 100% 75%);
    --accent: hsl(60 100% 70%);
    /* ... more variables */
}
```

### Content Updates
Portfolio content is defined in `Portfolio.vue` using structured data objects (`focusAreas`, `workDescriptions`, `platforms`). Update these to reflect your own experience and projects.

### Fonts
The portfolio uses JetBrains Mono and Fira Code monospace fonts for a clean, technical appearance. Fonts are loaded from Google Fonts in the layout file.

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run with coverage
php artisan test --coverage
```

## 📦 Building for Production

```bash
# Build optimized assets
npm run build

# Clear caches
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🚀 Deployment

This portfolio is designed to be deployed anywhere Laravel applications run:

- **Traditional Hosting**: Upload files and configure web server
- **Cloud Platforms**: Vercel, Netlify, Railway, etc.
- **VPS**: Deploy with Nginx/Apache
- **Container**: Docker-ready for containerized deployment

## 🎯 Performance

- **Static Content**: No animations or heavy JavaScript
- **Minimal Dependencies**: Only essential packages included
- **Optimized Assets**: Vite-powered build process
- **Tree Shaking**: Unused code automatically removed
- **CSS Purging**: Only used Tailwind classes included
- **Font Loading**: Optimized web fonts with preload hints

## 📄 License

MIT License - feel free to use this as a template for your own portfolio!

## 🤝 Contributing

While this is a personal portfolio, feedback and suggestions are welcome:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## 📞 Contact

- **Email**: evan.robertson77@gmail.com
- **GitHub**: [@evanrobertson](https://github.com/evanrobertson)
- **LinkedIn**: [evanrobertson](https://linkedin.com/in/evanrobertson)

---

Built with ❤️ and lots of ☕ using Laravel & Vue.js
