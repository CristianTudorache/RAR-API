FROM php:8.2-apache

# Instalează extensii pentru PostgreSQL (sau ce folosești tu)
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Activăm mod_rewrite
RUN a2enmod rewrite

# Setăm DocumentRoot înapoi la /var/www/html (nu în /public)
ENV APACHE_DOCUMENT_ROOT=/var/www/html

# Updatăm configurația Apache ca să reflecte noul DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiem fișierele în container
COPY . /var/www/html