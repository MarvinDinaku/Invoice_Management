<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

#Invoice Management System Documentation

#Setup Instructions
1- Clone the Repository:

Clone the Laravel Invoice Management System repository to your local machine:

bash
Copy code
git clone <repository_url>
Install Dependencies:

Navigate to the project directory and install the required PHP dependencies using Composer:

bash
Copy code
cd Invoice_Management
composer install
Database Configuration:

Create a MySQL database for the application and configure the database connection in the .env file:

makefile
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoice_management
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Generate Application Key:

Generate the Laravel application key:

bash
Copy code
php artisan key:generate
Run Migrations:

Run database migrations to create the necessary tables:

bash
Copy code
php artisan migrate
Start the Development Server:

Start the Laravel development server:

bash
Copy code
php artisan serve
The application should be running at http://localhost:8000.

API Endpoints
The Invoice Management System provides the following API endpoints:

Products
Create a Product (POST):

URL: http://localhost:8000/api/products
Body (JSON):
json
Copy code
{
    "name": "Product Name",
    "price": 10.99
}
Update a Product (PUT):

URL: http://localhost:8000/api/products/{product_id}
Body (JSON):
json
Copy code
{
    "name": "Updated Product Name",
    "price": 12.99
}
Delete a Product (DELETE):

URL: http://localhost:8000/api/products/{product_id}
List all Products (GET):

URL: http://localhost:8000/api/products
Invoices
Create an Invoice with Line Items (POST):

URL: http://localhost:8000/api/invoices
Body (JSON):
json
Copy code
{
    "date": "2023-09-30",
    "line_items": [
        {
            "product_id": 1,
            "quantity": 2
        },
        {
            "product_id": 2,
            "quantity": 3
        }
    ],
    "discount": 5.00
}
Update an Invoice and its Line Items (PUT):

URL: http://localhost:8000/api/invoices/{invoice_id}
Body (JSON):
json
Copy code
{
    "date": "2023-10-01",
    "line_items": [
        {
            "product_id": 1,
            "quantity": 4
        }
    ],
    "discount": 10.00
}
Delete an Invoice (DELETE):

URL: http://localhost:8000/api/invoices/{invoice_id}
List all Invoices with Line Items and Associated Products (GET):

URL: http://localhost:8000/api/invoices
Retrieve a Single Invoice by ID (GET):

URL: http://localhost:8000/api/invoices/{invoice_id}
Replace http://localhost:8000 with the appropriate URL where your Laravel application is hosted.

Testing with Postman
Open Postman and create requests for each of the API endpoints mentioned above.

Set the request method, URL, and provide the required JSON data in the request body where applicable.

Send the requests to interact with the Invoice Management System.

That's it! You now have a basic Invoice Management System set up with Laravel, and you can use Postman to test the API endpoints. Make sure to adjust the documentation and configurations according to your specific project requirements.
