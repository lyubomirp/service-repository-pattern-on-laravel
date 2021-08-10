To run locally you need:

a local mysql instance

composer install
npm i
php artisan make:database
php artisan migrate:fresh --seed
php artisan serve

After script/css changes:
npm run development
