# Installation

## Composer dependencies

    composer require opcodesio/log-viewer
    composer require cloudinary-labs/cloudinary-laravel
    composer require php-open-source-saver/jwt-auth

## Laravel dependencies

    composer install
    php artisan key:generate
    php artisan storage:link
    php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --tag="cloudinary-laravel-config"
    php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
    php artisan jwt:secret

