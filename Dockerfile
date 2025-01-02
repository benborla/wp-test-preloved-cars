# Build stage
FROM php:8.2-apache as builder

# Install build dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    mysqli \
    zip \
    opcache

# Final stage
FROM php:8.2-apache

# Copy pre-built extensions from builder
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Install only runtime dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6 \
    libjpeg62-turbo \
    libpng16-16 \
    libzip4 \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure PHP settings
RUN { \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'memory_limit = 256M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_vars = 3000'; \
} > /usr/local/etc/php/conf.d/wordpress.ini

# Configure Apache logs before switching user
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

# Set working directory
WORKDIR /var/www/html

# Add non-root user for better security and set permissions
RUN useradd -r -u 1500 wordpress \
    && chown -R wordpress:wordpress /var/www/html \
    && chown -R wordpress:wordpress /var/log/apache2

# Switch to non-root user
USER wordpress

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=60s \
    CMD curl -f http://localhost/ || exit 1

# Add labels for better maintainability
LABEL maintainer="your-email@example.com" \
      version="1.0" \
      description="WordPress with PHP 8.2 and Apache"
# Add labels for better maintainability
LABEL maintainer="your-email@example.com" \
      version="1.0" \
      description="WordPress with PHP 8.2 and Apache"
