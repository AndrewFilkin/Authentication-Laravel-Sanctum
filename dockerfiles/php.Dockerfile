FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

#install mysql
#RUN docker-php-ext-install pdo pdo_mysql

#install pgsql
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql