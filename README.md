# Laravel Invoice Management System

## Overview

This is a small Invoice Management System built using Laravel. It allows you to manage products, create invoices with line items, update invoices, and more. This README provides step-by-step instructions on how to set up and run the application.

## Prerequisites

Before getting started, make sure you have the following prerequisites installed on your system:

- [PHP](https://www.php.net/) (>= 7.3)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/docs/8.x/installation)
- [MySQL](https://dev.mysql.com/downloads/) (or any other database of your choice)
- [Postman](https://www.postman.com/) (for API testing)

## Setup Instructions

1. **Clone the Repository:**

   Clone the Laravel Invoice Management System repository to your local machine:

   ```bash
   git clone <repository_url>

2. **Install Dependencies:**

Navigate to the project directory and install the required PHP dependencies using Composer:

bash

cd invoice-management-system
composer install


3. **Database Configuration:**

Create a MySQL database for the application and configure the database connection in the .env file:

makefile

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password


4. **Generate Application Key:**

Generate the Laravel application key:

bash

php artisan key:generate

Run Migrations:

5. **Run database migrations to create the necessary tables:**

bash

php artisan migrate

Start the Development Server:

6. **Start the Laravel development server:**

bash
php artisan serve

The application should be running at http://localhost:8000.

**API Endpoints
The Invoice Management System provides the following API endpoints:**

**Products**
Create a Product (POST):

URL: http://localhost:8000/api/products
Body (JSON):
json
{
    "name": "Product Name",
    "price": 10.99
}


* Update a Product (PUT):

URL: http://localhost:8000/api/products/{product_id}
Body (JSON):
json
{
    "name": "Updated Product Name",
    "price": 12.99
}


* Delete a Product (DELETE):

URL: http://localhost:8000/api/products/{product_id}

*List all Products (GET):

URL: http://localhost:8000/api/products
Invoices
Create an Invoice with Line Items (POST):

URL: http://localhost:8000/api/invoices
Body (JSON):
json
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


*Update an Invoice and its Line Items (PUT):

URL: http://localhost:8000/api/invoices/{invoice_id}
Body (JSON):
json
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


*Delete an Invoice (DELETE):

URL: http://localhost:8000/api/invoices/{invoice_id}

*List all Invoices with Line Items and Associated Products (GET):

URL: http://localhost:8000/api/invoices
Retrieve a Single Invoice by ID (GET):

URL: http://localhost:8000/api/invoices/{invoice_id}
Replace http://localhost:8000 with the appropriate URL where your Laravel application is hosted.

**Testing with Postman**
Open Postman and create requests for each of the API endpoints mentioned above.

Set the request method, URL, and provide the required JSON data in the request body where applicable.

Send the requests to interact with the Invoice Management System.

That's it! You now have a basic Invoice Management System set up with Laravel, and you can use Postman to test the API endpoints. Make sure to adjust the documentation and configurations according to your specific project requirements.
