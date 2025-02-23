# Stage 1: Base PHP-FPM Image with Composer
FROM php:8.1-fpm AS php

# Install dependencies for Laravel & SQLite
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy PHP project files
COPY . .

# Stage 2: Node.js for Asset Building
FROM node:20 AS builder

# Set working directory
WORKDIR /app

# Copy only package.json and package-lock.json for caching
COPY package*.json ./

# Install Node.js dependencies
RUN npm install

# Copy entire project for Tailwind & Vite build
COPY . .

# Build the frontend assets
RUN npm run build

# Stage 3: Final Image (PHP + Built Assets)
FROM php:8.1-fpm AS final

# Set working directory
WORKDIR /var/www/html

# Copy PHP project files from the PHP stage
COPY --from=php /var/www/html .

# Copy built frontend assets from the Node.js stage
COPY --from=builder /app/public /var/www/html/public

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm", "-F"]
