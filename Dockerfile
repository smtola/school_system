FROM php:8.4.2

RUN apt-get update -y && apt-get install -y openssl zip unzip git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install SQLITE client
RUN apt-get install -y sqlite3 libsqlite3-dev

# Install PHP extensions for SQLite
RUN docker-php-ext-install pdo pdo_sqlite

# Check if mbstring extension is installed
RUN php -m | grep mbstring

WORKDIR /app

COPY . /app

RUN composer install

EXPOSE 8000
# Default command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


