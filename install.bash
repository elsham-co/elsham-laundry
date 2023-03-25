#!/bin/bash

git pull origin master
composer install
composer dumpautoload
php artisan migrate
php artisan module:seed Permissions
php artisan module:seed Roles
php artisan module:seed Admins