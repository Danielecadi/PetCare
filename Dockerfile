FROM php:8.3-cli

# Installa le estensioni PHP necessarie
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installa Node.js (per la build del frontend Vue)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port $PORT