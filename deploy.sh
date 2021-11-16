#!/bin/bash
php8.0 artisan down
php8.0 artisan optimize:clear
git pull origin main
php8.0 /usr/local/bin/composer install
php8.0 artisan migrate
npm i
npm run prod
php8.0 artisan optimize
php8.0 artisan up
