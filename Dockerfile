FROM php:8.2-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    unzip curl git zip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy ALL project files first
COPY . .

# Install dependencies
RUN composer install --no-dev --no-interaction --prefer-dist

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache

# Cache config
RUN php artisan config:clear
RUN php artisan cache:clear

ENV APP_DEBUG=true
ENV LOG_CHANNEL=stderr

EXPOSE 10000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000