FROM ubuntu:16.04
FROM php:8.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    zip \
    unzip \
    wget \

    && docker-php-ext-install zip


# Install PHP extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp;
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
    RUN wget http://pecl.php.net/get/redis-5.3.4.tgz -O /tmp/redis.tar.tgz \
        && pecl install /tmp/redis.tar.tgz \
        && rm -rf /tmp/redis.tar.tgz \
        && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
