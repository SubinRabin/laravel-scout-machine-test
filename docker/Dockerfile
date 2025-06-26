FROM php:8.3-fpm

RUN apt-get clean
RUN apt-get update && apt-get install -y \
        zlib1g-dev libicu-dev g++ \
        libjpeg62-turbo-dev \
        libzip-dev \
        libpng-dev \
        libwebp-dev \
        libfreetype6-dev \
    	libxml2-dev \
    	git \
    	zip \
    	unzip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure gd --with-webp=/usr/include/webp --with-jpeg=/usr/include --with-freetype=/usr/include/freetype2/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && pecl install redis \
    && docker-php-ext-enable redis

  RUN   apt clean && rm -rf /var/lib/apt/lists/*
  # RUN apt-get update && apt-get install -y \
#         libicu-dev \
#         libmemcached11 \
#         libmemcachedutil2 \
#         libmemcached-dev \
#         libz-dev \
#         libgd3 \
#         libfontconfig1 \
#         libpng-dev \
#         git \
#     && cd /root \
#     && git clone -b php8 https://github.com/php-memcached-dev/php-memcached \
#     && cd php-memcached \
#     && phpize \
#     && ./configure \
#     && make \
#     && make install \
#     && cd .. \
#     && rm -rf  php-memcached \
#     && echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini \
#     && apt-get remove -y build-essential libmemcached-dev libz-dev \
#     && apt-get remove -y libmemcached-dev libz-dev \
#     && apt-get autoremove -y \
#     && rm -rf /var/lib/apt/lists/* \
#     && apt-get clean \
#     && docker-php-ext-install \
#         intl \
#     && docker-php-ext-enable \
#         intl \
#     && docker-php-ext-install \
#         mysqli \
#     && docker-php-ext-enable \
#         mysqli \
#     && docker-php-ext-install \
#         pdo_mysql \
#     && docker-php-ext-enable \
#         pdo_mysql \
#     && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN cd /var/www/html/external-consumer-api

# RUN composer install
