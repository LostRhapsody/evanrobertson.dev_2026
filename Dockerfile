# syntax=docker/dockerfile:1.7

ARG PHP_VERSION=8.4.1

FROM php:${PHP_VERSION}-cli-bookworm AS build
WORKDIR /app

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        libicu-dev \
        libsqlite3-dev \
        libzip-dev \
        pkg-config \
        unzip \
    ; \
    docker-php-ext-install -j"$(nproc)" \
        bcmath \
        intl \
        pdo \
        pdo_mysql \
        pdo_sqlite \
        zip \
    ; \
    rm -rf /var/lib/apt/lists/*

# Node.js 22 (Vite build)
RUN set -eux; \
    curl -fsSL https://deb.nodesource.com/setup_22.x | bash -; \
    apt-get update; \
    apt-get install -y --no-install-recommends nodejs; \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-progress --optimize-autoloader --no-scripts

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build; \
    rm -rf node_modules; \
    composer dump-autoload --no-dev --optimize


FROM php:${PHP_VERSION}-apache-bookworm AS app
WORKDIR /var/www/html

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        libicu-dev \
        libsqlite3-dev \
        libzip-dev \
        pkg-config \
    ; \
    docker-php-ext-install -j"$(nproc)" \
        bcmath \
        intl \
        opcache \
        pdo \
        pdo_mysql \
        pdo_sqlite \
        zip \
    ; \
    a2enmod rewrite headers; \
    a2dismod mpm_event mpm_worker || true; \
    a2enmod mpm_prefork; \
    rm -rf /var/lib/apt/lists/*

# Ensure Apache serves the Laravel public/ directory.
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN set -eux; \
    sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf; \
    sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf; \
    { \
      echo '<Directory /var/www/html/public>'; \
      echo '    AllowOverride All'; \
      echo '    Require all granted'; \
      echo '</Directory>'; \
    } > /etc/apache2/conf-available/laravel-public.conf; \
    a2enconf laravel-public

COPY --from=build /app /var/www/html

RUN set -eux; \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
