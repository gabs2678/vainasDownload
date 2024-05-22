# Use the official PHP image with Apache
FROM php:8.1-apache

# Install system dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev \
    libxml2-dev \
    libexif-dev \
    libonig-dev \
    zlib1g-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions needed by Moodle
RUN docker-php-ext-install mysqli zip gd intl soap exif opcache

# Enable PHP extensions
RUN docker-php-ext-enable mysqli gd intl zip soap exif

# Copy Moodle code into the container
COPY . /var/www/html/

# Create and set permissions for Moodle data directory
RUN mkdir -p /var/www/html/moodledata \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/moodledata

# Set necessary environment variables for Moodle database connection
ENV MOODLE_DB_HOST=db \
    MOODLE_DB_NAME=moodle_db \
    MOODLE_DB_USER=root \
    MOODLE_DB_PASS=example

# Ensure the Apache document root is set to the Moodle directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html

# Expose port 80
EXPOSE 80

# Configure the GD library and PHP limits
RUN echo 'memory_limit = 256M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo 'upload_max_filesize = 64M' >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo 'post_max_size = 64M' >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo 'max_input_vars = 5000' >> /usr/local/etc/php/conf.d/custom.ini

# Set recommended PHP.ini settings for production
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
