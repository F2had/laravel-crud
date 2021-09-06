# Laravel

#### This is a simple CRUD app made with Laravel

### [Link](https://laravel-crud.f2had.me/)


## Reportico Installations for Laravel
Use compser to install the package 
```
composer require reportico/laravel-reportico
```
Then edit your config/app.php file and add the following in the providers section
```
Reportico\Reportico\ReporticoServiceProvider::class,
```
Then move the reportico assets into the public area by publishing
```
php artisan vendor:publish --provider="Reportico\Reportico\ReporticoServiceProvider" 
```
Finally access it 
<br>
```
{laravel_url}/reportico | http://127.0.0.1:8000/reportico
```
