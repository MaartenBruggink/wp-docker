FROM wordpress:5.8

# Install `unzip` and `composer`
RUN apt-get update && \
        apt-get install unzip && \
        curl -sS https://getcomposer.org/installer | \
        php -- --install-dir=/usr/bin/ --filename=composer

# Files
COPY ./.htaccess /var/www/html/.htaccess
COPY ./wp-content/themes /var/www/html/wp-content/themes
COPY ./wp-config.php /var/www/html/wp-config.php

# Configs
COPY ./php_settings.ini /usr/local/etc/php/conf.d/php_settings.ini
COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./ports.conf /etc/apache2/ports.conf

# The Wordpress Docker image is extracting the Wordpress library in the temporary folder /usr/src/wordpress
# We use this folder to install our composer dependencies
# and copy the non-composer managed plugins

# Remove the default Wordpress wp-content folder
RUN rm -rf /usr/src/wordpress/wp-content/

# Copy non-composer managed plugins from repository to the Docker image
WORKDIR /usr/src/wordpress
RUN mkdir wp-content
RUN mkdir wp-content/uploads
COPY ./wp-content/plugins ./wp-content/plugins

# Run composer to install composer managed plugins (listed in composer.json)
COPY ./composer.json ./composer.json
RUN composer install --no-dev --no-interaction -o

# Change owner of entire wp-content dir
RUN chown -R www-data:www-data /usr/src/wordpress/wp-content

# Remove composer files after installation
RUN rm ./composer.json ./composer.lock

WORKDIR /var/www/html

EXPOSE 80