# Task Management

An API for a simplified version of a task management system using Laravel.
The system should allow users to create, update, delete, and list tasks. Additionally, tasks can
be assigned to different users, and each task can have multiple comments. The author of the
task needs to receive a notification through email if it has new comments.

## Installation

```bash
git clone https://github.com/amrfoley/task-management.git
```
```bash
cd task-management
```
Use the package manager [docker](https://docs.docker.com/engine/install/) to install the project.

```bash
docker compose up
```

## Usage

```python
docker exec -it --user root tm-app bash

# copy config files
cp .env.example .env
cp data/.htaccess ./htaccess
cp data/000-default.conf /etc/apache2/sites-available/000-default.conf
a2enmod rewrite

# install packages
composer install

# run laravel configurations
php artisan key:generate
php artisan migrate
```

## APIs

Inside data directory there is a Postman collection with variables configured to this project URL. 
Import it for test.

## License

[MIT](https://choosealicense.com/licenses/mit/)