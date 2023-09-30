<?php

use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Routes for ProductController
Route::get('products', 'ProductController@index');           // List all products
Route::post('products', 'ProductController@store');           // Create a new product
Route::get('products/{product}', 'ProductController@show');    // Retrieve a specific product
Route::put('products/{product}', 'ProductController@update');  // Update a product
Route::delete('products/{product}', 'ProductController@destroy'); // Delete a product

// Routes for InvoiceController // List all invoices
Route::post('invoices', 'InvoiceController@createInvoice');            // Create a new invoice
Route::get('invoices/{invoice}', 'InvoiceController@getInvoice');     // Retrieve a specific invoice
Route::put('invoices/{invoice}', 'InvoiceController@updateInvoice');   // Update an invoice
Route::delete('invoices/{invoice}', 'InvoiceController@deleteInvoice'); // Delete an invoice
Route::get('invoices', 'InvoiceController@listInvoices');




