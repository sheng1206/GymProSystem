FROM php:8.2-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    unzip curl git zip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy ONLY composer files first (better caching)
COPY composer.json composer.lock ./

RUN composer install --no-dev --no-interaction --prefer-dist

# Copy full project
COPY . .

# Fix permissions (IMPORTANT)
RUN chmod -R 775 storage bootstrap/cache

# DO NOT generate key here in production builds
# Instead set APP_KEY in Render environment variables

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000