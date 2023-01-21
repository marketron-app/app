FROM php:8.1-fpm
ARG NODE_VERSION=16

# Set working directory
WORKDIR /var/www

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    lua-zlib-dev \
    libmemcached-dev \
    nginx \
    libpng-dev zlib1g-dev


RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached xml iconv simplexml xmlreader zlib imagick

RUN apt-get update && apt-get install -y imagemagick
RUN install-php-extensions imagick

# Install supervisor
RUN apt-get update && apt-get install -y supervisor

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy code to /var/www
COPY --chown=www:www-data . /var/www

# add root to www group
RUN chmod -R 775 /var/www/storage

# Copy nginx/php/supervisor configs
RUN cp docker-config/supervisor.conf /etc/supervisord.conf
RUN cp docker-config/php.ini /usr/local/etc/php/conf.d/app.ini
RUN cp docker-config/nginx.conf /etc/nginx/sites-enabled/default

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Setup crontab
COPY ./docker-config/crontab /etc/cron.d/crontab

# Deployment steps
RUN composer install --optimize-autoloader --no-dev
RUN chmod +x /var/www/docker-config/run.sh
RUN npm run build

EXPOSE 80
ENTRYPOINT ["/var/www/docker-config/run.sh"]
