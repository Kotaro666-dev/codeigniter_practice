FROM php:7.2-apache

# Type: Error
# Message: Call to undefined function mysqli_init()

RUN apt-get update \
    && docker-php-ext-install mysqli

RUN a2enmod rewrite

CMD apache2-foreground