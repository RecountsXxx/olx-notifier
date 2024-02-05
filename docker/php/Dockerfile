FROM php:8.1.2-fpm

# Встановлення необхідних залежностей та розширень PHP
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip

# Встановлення Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Робочий каталог
WORKDIR /var/www/html/src

# Копіюємо файли проекту в контейнер
COPY ../src .

# Викликаємо Composer для встановлення залежностей
RUN composer install --no-dev --optimize-autoloader

# CMD та інші необхідні інструкції
CMD ["php-fpm"]
