FROM php:8-apache
RUN apt-get update && apt-get install -y libxml2-dev
RUN docker-php-ext-install mysqli pdo  pdo_mysql soap xml
COPY etc/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY etc/start-apache /usr/local/bin
RUN a2enmod rewrite

RUN apt-get update \
&& apt-get install -y git acl openssl openssh-client wget vim libzip-dev unzip \
&& docker-php-ext-install intl zip pcntl
  
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

############ Copy application source ##############
COPY /  /var/www/html
RUN chown -R www-data:www-data /var/www

CMD ["start-apache"]
