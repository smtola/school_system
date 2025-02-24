FROM php:8.3

RUN apt-get update -y && apt-get install -y openssl zip unzip git

# Install SQLite client
RUN apt-get install -y sqlite3 libsqlite3-dev

# Install PHP extensions for SQLite
RUN docker-php-ext-install pdo pdo_sqlite

# Check if mbstring extension is installed
RUN php -m | grep mbstring

# Install Node.js and npm for Vite
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - 
RUN apt-get install -y nodejs

WORKDIR /app

COPY . /app

COPY .env /app/.env

# Install npm dependencies and build assets
RUN npm install
RUN npm run build

EXPOSE 8000

# Default command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

