FROM php:8.2-fpm

RUN apt-get update \
    && apt-get install -y \
        libpq-dev  \
        build-essential \
        locales \
        zip \
        unzip \
        git \
        curl\
    && docker-php-ext-install pdo pdo_pgsql pgsql

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www/products_erp

EXPOSE 9000
CMD ["php-fpm"]
