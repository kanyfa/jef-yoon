FROM composer:2 AS composer
FROM node:22-alpine AS node

FROM php:8.2-cli-alpine AS runtime

ENV LARAVEL_PATH=/var/www/html
WORKDIR $LARAVEL_PATH

RUN apk add --no-cache \
    git \
    unzip \
    pkgconf \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zlib-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_sqlite mbstring pdo intl zip gd bcmath opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/bin/npm /usr/local/bin/npm
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules

COPY . .

RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader
RUN npm ci && npm run build
RUN php artisan package:discover --ansi && php artisan config:cache

RUN mkdir -p public/build public/storage storage/app/framework/sessions storage/app/framework/views storage/app/framework/cache/files bootstrap/cache

EXPOSE 3000

CMD ["sh", "-c", "php artisan migrate --force 2>/dev/null; exec php artisan serve --host=0.0.0.0 --port=$PORT"]
