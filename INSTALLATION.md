# Installation

## Composer dependencies

    composer require opcodesio/log-viewer
    composer require cloudinary-labs/cloudinary-laravel

## Laravel dependencies

    composer install
    php artisan key:generate
    php artisan storage:link
    php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --tag="cloudinary-laravel-config"

