#!/bin/bash

# script new of laravel install app

# install dependences with composer
composer install

# install dependences with npm and build files
npm install && npm run dev

# run commands artisan
php artisan key:generate
php artisan migrate
php artisan storage:link