FROM php:8.2-fpm-alpine

LABEL maintainer="Laravel App"

ARG WWWGROUP=1000
ARG NODE_VERSION=18
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND=noninteractive \
    TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    zip \
    unzip \
    supervisor \
    nginx \
    postgresql${POSTGRES_VERSION}-client \
    postgresql${POSTGRES_VERSION}-dev \
    nodejs \
    npm \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        bcmath \
        pcntl

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        libzip-dev \
        oniguruma-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libxml2-dev \
        autoconf \
        g++ \
        make \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        zip \
        mbstring \
        xml \
        gd \
        opcache \
        intl \
        exif \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk add --no-cache \
        libzip \
        freetype \
        libjpeg-turbo \
        libpng \
        oniguruma \
    && apk del .build-deps

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN adduser -g ${WWWGROUP} -s /bin/sh -D sail

COPY docker/nginx/default.conf /etc/nginx/nginx.conf
COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /var/log/supervisor \
    && chown -R sail:sail /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]