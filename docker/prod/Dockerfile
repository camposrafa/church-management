FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
    --enable-gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN usermod -u 1000 www-data

# Get 2 Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV HOME=/var/www

RUN chown -R www-data:www-data $HOME

WORKDIR $HOME

USER www-data

COPY database/ database/

COPY --chown=www-data:www-data composer.* ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --no-interaction \
    # --no-plugins \
    --prefer-dist

COPY --chown=www-data:www-data . .

RUN composer dump-autoload --optimize
