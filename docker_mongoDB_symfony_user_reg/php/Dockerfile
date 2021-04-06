FROM php:7.4.2-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends git openssl wget libxml2-dev libzip-dev unzip

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash && \
   mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN apt-get update \
    && apt-get install pkg-config libssl-dev libsasl2-dev

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN extension=mongodb.so

WORKDIR /var/www/ms_user_reg/back

EXPOSE 9000
CMD ["php-fpm"]
