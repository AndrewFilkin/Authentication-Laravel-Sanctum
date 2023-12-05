FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

#install mysql
#RUN docker-php-ext-install pdo pdo_mysql

#install pgsql
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

#install text editor nano
RUN apk add nano

#Install npn
#RUN apk add --update nodejs npm
#RUN npm install


## start Install and create cronetab
## Install required packages
#RUN apk --no-cache add bash
#
## Add your script to the container
#COPY crontab/create_file.sh /create_file.sh
#
## Make the script executable
#RUN chmod +x /create_file.sh
#
## Add crontab file
#COPY crontab/crontab /etc/crontabs/root
#
## Run crontab
#CMD ["crond", "-f"]
## end Install and create cronetab