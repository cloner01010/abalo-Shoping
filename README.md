#Abalo

##
* Sayed Ali Mir Hosseini Zamani, 3281423
* Yannik Niewöhner, 3184410

## Run Frontend
* ``npm run dev``

## Setup and Run Websocket Server
* ``composer update``
* ``php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"``
* ``php artisan migrate``
* ``php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"``
* `` php artisan websockets:serve``
* Reference: https://ahmedshaltout.com/laravel/how-to-use-laravel-websockets-and-laravel-echo-with-vue-3-app-example/

## Migrate and Seed
* ``php artisan migrate``
* ``composer dumpautoload``
* ``php artisan db:seed --class=DevelopmentData``

## Create Storage Link
* ``php artisan storage:link``
