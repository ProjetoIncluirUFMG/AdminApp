FROM php:7-apache

MAINTAINER danielmapar@gmail.com

RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng12-dev libmcrypt-dev \
  && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv mcrypt \
	&& ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
