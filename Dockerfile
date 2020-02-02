FROM php:7.3.14-apache-buster


#COPY php.ini /usr/local/etc/php/conf.d/

RUN apt-get update && apt-get install -y libpq-dev libxml2-dev libpng-dev git zip unzip vim nano cron openssh-server --no-install-recommends  \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql

RUN docker-php-ext-install gd

WORKDIR /var/www/html

COPY . /var/www/html/
COPY composer.json /var/www/html

EXPOSE 80 2222