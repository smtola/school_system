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

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

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

# Stage 3: Nginx for Serving the Application
FROM nginx:alpine

# Copy built frontend assets
COPY --from=builder /app/public /var/www/html/public

# Copy the Nginx configuration file (make sure you have this)
COPY nginx.conf /etc/nginx/nginx.conf

# Expose port 80
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
