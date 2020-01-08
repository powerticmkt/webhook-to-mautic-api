FROM php:7.2-apache

LABEL maintainer="Luiz Eduardo <luiz@powertic.com>"

RUN apt-get update

RUN apt-get install software-properties-common -y

RUN apt-get install sudo build-essential tcl8.5 zlib1g-dev libicu-dev g++ -y

RUN apt-get install -y \
  curl \
  libmemcached-dev \
  libz-dev \
  libpq-dev \
  libjpeg-dev \
  libpng-dev \
  libfreetype6-dev \
  libcurl4-openssl-dev \
  libssl-dev \
  bzip2 \
  csstidy \
  libfreetype6-dev \
  libicu-dev \
  libldap2-dev \
  libmemcached-dev \
  libxml2-dev \
  libz-dev \
  tidy \
  libapache2-modsecurity \
  wget \
  nano \
  htop \
  zip \
  unzip

RUN docker-php-ext-install pdo intl xml zip mysqli pdo_mysql soap

# Install Extra modules
RUN pecl install \
  apcu-5.1.11 \
  memcached-3.0.4

# Enable Extra modules
RUN docker-php-ext-enable \
  apcu \
  memcached

RUN a2enmod setenvif headers deflate filter expires rewrite include ext_filter

WORKDIR /var/www/html

COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
