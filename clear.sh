#!/bin/bash
sudo chmod 777 -R bootstrap/
sudo chmod 777 -R storage/
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan config:cache
composer dump-autoload -o
#sh
echo "clear everything..."  
