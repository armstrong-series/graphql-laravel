# Task Management GraphQL API

This is a Laravel-based GraphQL API for managing tasks, built with Lighthouse. It supports user authentication via JWT and provides endpoints for creating, updating, deleting, and querying tasks.

## Prerequisites

- Docker and 
- Git
- A MySQL database (optional, if not using an external DB)



## Project Structure
task/ <br>
├── app/                # Laravel application code<br>
├── graphql/            # GraphQL schema (schema.graphql)<br>
├── routes/             # Route definitions (e.g., graphql.php)<br>
├── docker/             # Docker configuration files<br>
├── Dockerfile          # Docker build instructions<br>
├── composer.json       # PHP dependencies<br>
├── .env.example        # Example environment configuration<br>
└── README.md  <br>



## Setup


### Clone the Repository
```bash
git clone https://github.com/armstrong-series/graphql-laravel.git
cd task
git switch dev
cp .env.example .env

composer install
php artisan key:generate
php artisan migrate
php artisan db:seed




