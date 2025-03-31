
FROM php:8.4-fpm


WORKDIR /var/www/task


RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    xml


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY . /var/www/task
COPY .env.example /var/www/task/.env


RUN chown -R www-data:www-data /var/www/task \
    && chmod -R 755 /var/www/task/storage \
    && chmod -R 755 /var/www/task/bootstrap/cache


RUN composer install --no-dev --optimize-autoloader


RUN php artisan key:generate

RUN php artisan migrate 

RUN php artisan db:seed

COPY docker/nginx.conf /etc/nginx/sites-available/default


COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf


EXPOSE 80


CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]