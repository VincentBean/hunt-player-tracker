#!/bin/bash
php8.0 artisan down
php8.0 artisan optimize:clear
git pull origin main
php8.0 /usr/local/bin/composer install
php8.0 artisan migrate
php8.0 artisan storage:link
php8.0 artisan optimize
npm i
npm run prod
php8.0 artisan up
