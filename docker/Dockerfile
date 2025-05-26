FROM php:8.2-apache

WORKDIR /var/www/html

# Habilita o mod_rewrite do Apache (para URLs amigáveis)
RUN a2enmod rewrite

# Define o DocumentRoot para /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
