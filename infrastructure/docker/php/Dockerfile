FROM php:7.4-fpm
RUN apt-get update && apt-get install -y
RUN apt-get update && apt-get install -y --no-install-recommends \
	git \
        wget\
	libxml2-dev \
	libzip-dev \
	&& docker-php-ext-install \
	zip \
	intl \
	mysqli \
	pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash; \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony; \
    rm -rf /root/.symfony/; \
    addgroup --force-badname _www; \
    adduser --no-create-home --force-badname --disabled-login --disabled-password --system _www; \
    addgroup _www _www

