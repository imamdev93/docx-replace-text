FROM php:8.2-cli-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

COPY deploy/php/php.ini "$PHP_INI_DIR/php.ini"

#RUN apk update && apk add --no-cache libzip-dev && docker-php-ext-enable zip
RUN install-php-extensions zip

WORKDIR /app

COPY . .

RUN composer install --no-cache --no-dev --optimize-autoloader --prefer-dist --no-interaction --no-progress

CMD "php -S 0.0.0.0:80 -t public"
