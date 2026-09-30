FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions needed
RUN docker-php-ext-install pdo pdo_mysql

# Install mysqli extension as well
RUN docker-php-ext-install mysqli

# Copy project files to Apache web root
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Make startup script executable
RUN chmod +x /var/www/html/startup.sh

# Apache config: allow .htaccess overrides
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/parkify.conf \
    && a2enconf parkify

# Expose port 80
EXPOSE 80

CMD ["/var/www/html/startup.sh"]

