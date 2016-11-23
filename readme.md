## iBorhan Forecast Game

This is a forecast football game

## Official Documentation

#### Installation
##### installing after cloning
    composer install --no-scripts
##### update composer file
    composer update
##### install bower components
    bower install
##### configure database
    copy form .env.example to .env
    configure .env
##### generate key for app
    php artisan key:generate   
##### migrate and add table to database and seed them
    php artisan migrate --seed
##### add team to the team table
    php artisan make:team
##### view the app on localhost:8000
    php artisan serve
    
### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
