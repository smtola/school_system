# Stage 1: PHP with Composer (PHP-FPM)
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

# Set working directory
WORKDIR /var/www/html

# Copy PHP project files
COPY . .

# Start PHP-FPM
CMD ["php-fpm"]

# Stage 2: Node.js for Asset Building (Vite + Tailwind)
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

# Stage 3: Final Image with Nginx + PHP-FPM
FROM nginx:alpine AS final

# Set working directory
WORKDIR /var/www/html

# Copy PHP project files from PHP stage
COPY --from=php /var/www/html .

# Copy built frontend assets from Node.js stage
COPY --from=builder /app/public /var/www/html/public

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
