FROM php:8.2-apache

# Instala extensões PHP necessárias
RUN apt-get update && \
    apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git && \
    docker-php-ext-install pdo_mysql

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Instala o Composer globalmente
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia o projeto
COPY . /var/www/html

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Opcional: define o DocumentRoot para /public (caso use)

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

# Exibe erros em DEV
RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/dev.ini

EXPOSE 80
