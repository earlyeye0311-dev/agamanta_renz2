# Use the official Apache image with PHP support (adjust version as needed)
FROM php:8.2-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy your application files to the Apache web root
COPY . /var/www/html/

# Set permissions (optional, depending on your needs)
RUN chown -R www-data:www-data /var/www/html/

# Update Apache config to allow .htaccess Overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
