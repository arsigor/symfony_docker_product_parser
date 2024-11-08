FROM php:8.0-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/symfony_docker_product_parser

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash - && \
    mv $(find /root -name 'symfony' -type f | head -n 1) /usr/local/bin/symfony
#RUN git config --global user.email "arsenych.igor@gmail.com" \
#    && git config --global user.name "Arsenych Ihor"
#
#WORKDIR /var/www/symfony_docker_product_parser/app

#RUN composer install

#RUN php bin/console messenger:consume -vv

#CMD bash -c "composer install"