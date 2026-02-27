FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files
COPY . /var/www/html/

# Enable mod_rewrite
RUN a2enmod rewrite

EXPOSE 80
