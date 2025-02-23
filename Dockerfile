# Use the official PHP image as a base
FROM php:8.1-fpm

# Install necessary dependencies for SQLite and TailwindCSS
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm for TailwindCSS build
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

RUN groupadd -r www-data && useradd -r -g www-data www-data \
    && chown -R www-data:www-data /var/www/html/storage

# Set working directory
WORKDIR /var/www/html

# Copy project files into container
COPY . .

# Install PHP dependencies via Composer
RUN composer install

# Install Node.js dependencies (TailwindCSS)
RUN npm install

# Build TailwindCSS
RUN npm run dev

# Expose port 80
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
