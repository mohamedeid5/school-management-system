# =============================================================================
# Stage 1: Build frontend assets (Node.js)
# =============================================================================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install

COPY resources/ resources/
COPY vite.config.js ./
COPY public/ public/

RUN npm run build

# =============================================================================
# Stage 2: Base PHP image (shared between dev and production)
# =============================================================================
FROM php:8.4-fpm-alpine AS base

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# =============================================================================
# Stage 3: Development image (no COPY - code is mounted as volume)
# =============================================================================
FROM base AS development

# Install dev PHP config
COPY docker/php/php.dev.ini $PHP_INI_DIR/conf.d/custom.ini

EXPOSE 9000

CMD ["php-fpm"]

# =============================================================================
# Stage 4: Production PHP image
# =============================================================================
FROM base AS production

# Install supervisor (production only)
RUN apk add --no-cache supervisor

# Copy composer files first (layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

# Copy application code
COPY . .

# Copy built frontend assets from stage 1
COPY --from=frontend /app/public/build public/build

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy PHP config
COPY docker/php/php.ini $PHP_INI_DIR/conf.d/custom.ini
COPY docker/php/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini

# Copy supervisor config (manages php-fpm + queue worker)
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 9000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
