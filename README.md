# Task Management GraphQL API

This is a Laravel-based GraphQL API with LightHouse for managing tasks, built with Lighthouse. It supports user authentication via JWT and provides endpoints for creating, updating, deleting, and querying tasks.

## Prerequisites

- Docker(Optional, you can set it up locally)
- Php >= 8.3
- A MySQL database 
- Nginx (Server)



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
 <p>Setup your project base Url i.e {{baseUrl}}/graphql on postman. Import the API collection in collection/ directory in the project root folder into your postman</p>

### Clone the Repository
```bash
git clone https://github.com/armstrong-series/graphql-laravel.git
cd task
git switch dev
cp .env.example .env

composer install
php artisan key:generate
php artisan migrate
php artisan jwt:secret
php artisan db:seed

docker build -t task-management-api .

docker run -d -p 80:80 --name task-api task-management-api

docker logs task-api