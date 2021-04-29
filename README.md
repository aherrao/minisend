# Minisend

## Steps for Installation
 - git clone https://github.com/swan03/minisend.git
 - cd minisend
 - cp .env.example .env
    - Note: create database and set in .env file
    - Note: set smtp credentials
        - MAIL_DRIVER=smtp
        - MAIL_HOST=smtp.mailtrap.io
        - MAIL_PORT=2525
        - MAIL_USERNAME=xxxxxxxxxxx
        - MAIL_PASSWORD=xxxxxxxxxxx
        - MAIL_FROM_ADDRESS=no-reply@minisend.com
        - MAIL_FROM_NAME='Minisend Team'
 - composer install
 - php artisan key:gen
 - php artisan migrate
 - php artisan db:seed
 - ./clear.sh
 - npm install
 - npm run dev
 
 Login credentials (Note: seeder must run)
 Username: admin@minisend.com
 Password: admin
 
 
# test
