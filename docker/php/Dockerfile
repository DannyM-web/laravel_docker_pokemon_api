FROM php:7.4-fpm-alpine3.12

RUN apk update &&\
    apk add --no-cache $PHPIZE_DEPS &&\
    docker-php-ext-install pdo_mysql



WORKDIR /var/www/app
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&\
    php -r "if (hash_file('sha384', 'composer-setup.php') === '795f976fe0ebd8b75f26a6dd68f78fd3453ce79f32ecb33e7fd087d39bfeb978342fb73ac986cd4f54edd0dc902601dc') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" &&\
    php composer-setup.php --install-dir=/usr/bin --filename=composer &&\
    php -r "unlink('composer-setup.php');"
    

#COPY ./docker-entrypoint.sh /var/www/app/docker-entrypoint.sh



