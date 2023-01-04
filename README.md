composer create-project laravel/laravel todolistOrder
-- Change database name in .env file ie, DB_DATABASE=todolistOrder
cd .\todolistOrder\
php artisan make:model order -m
-- Add table columns in migrate created file ie, title, order, Project
-- Add fillable in ie, order.php
    -- protected $fillable = ['Project', 'title', 'order'];
php artisan migrate
php artisan make:controller ordersController

To add new column in orders table use below command as :
    -- php artisan make:migration add_project_to_orders_table --table=orders

In add_project_to_orders_table migrations up function add below function as :
    Schema::table('orders', function (Blueprint $table) {
        $table->string('Project')->nullable()->after('id');            
    });

php artisan migrate  

php artisan serve 



