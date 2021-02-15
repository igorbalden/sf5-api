FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
      g++ git libicu-dev zip \
      libzip-dev \
      zip \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu xdebug-3.0.2 \
    && docker-php-ext-enable apcu xdebug \
    && docker-php-ext-install zip

WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /app