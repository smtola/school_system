FROM php:8.1-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    sqlite3 \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Configure PHP-FPM to listen on port 9000 for all interfaces
RUN echo "listen = 0.0.0.0:9000" > /usr/local/etc/php-fpm.d/zz-app.conf

WORKDIR /var/www/html

# Copy application files
COPY . .

# Create SQLite database file and set permissions
RUN mkdir -p storage \
    && touch storage/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage
