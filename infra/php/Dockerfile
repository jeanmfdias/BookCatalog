FROM php:8.5.12-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        unzip \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libpq-dev

RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    zip \
    gd

RUN rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

EXPOSE 9000
