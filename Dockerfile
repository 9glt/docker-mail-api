
FROM composer:latest as composer

FROM spiksius/php8.1-apache:latest

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev

COPY --from=library/docker:latest /usr/local/bin/docker /usr/bin/docker
COPY --from=docker/compose:latest /usr/local/bin/docker-compose /usr/bin/docker-compose
# RUN chown -R nobody:nobody /var/www/html/storage

ENTRYPOINT ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "80"]
