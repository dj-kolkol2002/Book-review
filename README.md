# Book Review

A book review application built with Laravel 12.

## Features

- Browse books with pagination
- Add reviews with star ratings (1-5)
- Filter books by popularity, highest/lowest rated
- Sort by latest, oldest
- Star rating component

## Requirements

- PHP >= 8.2
- Composer
- MySQL / MariaDB (or Docker)

## Installation

```bash
# Clone the repository
git clone https://github.com/dj-kolkol2002/Book-review.git
cd Book-review

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate
```

## Database

The project includes a `docker-compose.yml` with MariaDB and Adminer.

```bash
# Start the database via Docker
docker compose up -d mysql

# Configure .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-10-book-review
DB_USERNAME=root
DB_PASSWORD=root

# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

## Running the application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Database structure

### `books` table

| Column     | Type      | Description       |
|------------|-----------|-------------------|
| id         | bigint    | Primary key       |
| title      | string    | Book title        |
| author     | string    | Book author       |
| created_at | timestamp | Creation date     |
| updated_at | timestamp | Last update date  |

### `reviews` table

| Column     | Type      | Description                  |
|------------|-----------|------------------------------|
| id         | bigint    | Primary key                  |
| book_id    | bigint    | Foreign key to books (cascade) |
| review     | text      | Review text                  |
| rating     | tinyint   | Rating (1-5)                 |
| created_at | timestamp | Creation date                |
| updated_at | timestamp | Last update date             |

## Tech stack

- Laravel 12
- PHP 8.2+
- MySQL / MariaDB
- Blade templates
