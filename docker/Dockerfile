FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && apt-get clean
    
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer