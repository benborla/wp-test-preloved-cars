# Build stage
FROM php:8.2-apache as builder

# Install build dependencies
RUN apt-get update && apt-get install -y \
   libfreetype6-dev \
   libjpeg62-turbo-dev \
   libpng-dev \
   libzip-dev \
   git \
   unzip \
   && rm -rf /var/lib/apt/lists/* \
   && docker-php-ext-configure gd --with-freetype --with-jpeg \
   && docker-php-ext-install -j$(nproc) \
   gd \
   mysqli \
   zip \
   opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Final stage
FROM php:8.2-apache

COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=builder /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
   libfreetype6 \
   libjpeg62-turbo \
   libpng16-16 \
   libzip4 \
   git \
   unzip \
   && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN { \
   echo 'upload_max_filesize = 64M'; \
   echo 'post_max_size = 64M'; \
   echo 'memory_limit = 256M'; \
   echo 'max_execution_time = 300'; \
   echo 'max_input_vars = 3000'; \
} > /usr/local/etc/php/conf.d/wordpress.ini

RUN ln -sf /dev/stdout /var/log/apache2/access.log \
   && ln -sf /dev/stderr /var/log/apache2/error.log

WORKDIR /var/www/html

RUN useradd -r -u 1500 wordpress \
   && chown -R wordpress:wordpress /var/www/html \
   && chown -R wordpress:wordpress /var/log/apache2

COPY --chown=wordpress:wordpress composer.json composer.lock ./

RUN if [ ! -d "vendor" ]; then \
       composer install --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader; \
   fi

USER wordpress

HEALTHCHECK --interval=30s --timeout=3s --start-period=60s \
   CMD curl -f http://localhost/ || exit 1

LABEL maintainer="benborla@icloud.com" \
     version="1.0" \
     description="WordPress with PHP 8.2 and Apache"
