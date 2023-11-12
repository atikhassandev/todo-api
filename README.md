# Laravel Task Management API

A RESTful API for managing tasks built with Laravel.



## Introduction

The Laravel Task Management API is designed to facilitate the management of tasks with features like creating, updating, and filtering tasks. It includes image upload functionality and consistent API responses.

## Features

- Create, retrieve, update, and delete tasks (CRUD operations).
- Filter tasks by status.
- Update task status.
- Image upload for tasks.
- Consistent API responses for success and error scenarios.


### Prerequisites

Make sure you have the following installed:

- PHP
- Composer
- Laravel
- MySQL or another database of your choice

### Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/laravel-task-management.git

# Navigate to the project directory
cd laravel-task-management

# Install dependencies
composer install

# Create a copy of the .env file
cp .env.example .env

# Configure the database connection in the .env file

# Run migrations
php artisan migrate

# Generate application key
php artisan key:generate

# Start the development server
php artisan serve

```

### API Routes
```bash
GET /v1/tasks: Retrieve all tasks.
POST /v1/tasks: Create a new task.
GET /v1/tasks/{id}: Retrieve a specific task.
PUT /v1/tasks/{id}: Update a specific task.
DELETE /v1/tasks/{id}: Delete a specific task.
GET /v1/tasks/status/{status}: Filter tasks by status.
PATCH /v1/tasks/{id}/status: Update the status of a specific task.
```

### Error Handling
The API includes custom error handling to provide meaningful responses for common error scenarios.

### Contributing
Feel free to contribute to the development of this project.

### License
This project is open-source and available under the MIT License.