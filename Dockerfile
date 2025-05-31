FROM php:8.2-fpm

# Install system deps
RUN apt-get update && apt-get install -y \
    wget \
    unzip \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install intl zip

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Working directory
WORKDIR /var/www/dsp

EXPOSE 9000

CMD ["php-fpm"]
