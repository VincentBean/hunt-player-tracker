#!/bin/bash
php8.0 artisan down
git pull origin main
php8.0 /usr/local/bin/composer install
php8.0 artisan migrate
npm i
npm run prod
php8.0 artisan up
