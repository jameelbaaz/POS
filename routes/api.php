<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Model\Employee;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
// EMP
// Route::apiResource('/employee',[Employee::class, 'Api/EmployeeController']);
Route::apiResource('employee', EmployeeController::class);
// Route::apiResource('/supplier',[Employee::class, 'Api/EmployeeController']);
Route::apiResource('supplier', SupplierController::class);
// Route::apiResource('/Category',[Employee::class, 'Api/EmployeeController']);
Route::apiResource('category', CategoryController::class);
// Route::apiResource('/Product',[Product::class, 'Api/productController']);
Route::apiResource('product', ProductController::class);
// Route::apiResource('/expense',[expense::class, 'Api/productController']);
Route::apiResource('expense', ExpenseController::class);
// Route::apiResource('/expense',[expense::class, 'Api/productController']);
Route::post('/salary/paid/{id}', [SalaryController::class, 'Paid']);
Route::get('/salary', [SalaryController::class, 'allSalary']);
Route::get('/salary/view/{id}', [SalaryController::class, 'viewSalary']);
Route::get('/edit/salary/{id}', [SalaryController::class, 'editSalary']);
Route::post('/salary/update/{id}', [SalaryController::class, 'updateSalary']);
Route::post('/stock/update/{id}', [ProductController::class, 'updateStock']);
// Customer
Route::apiResource('customer', CustomerController::class);
// GetProductByID
Route::get('/get/product/{id}', [PosController::class, 'getProductByID']);
// AddtoCart
Route::get('/addtoCart/{id}', [CartController::class, 'AddToCart']);
// Get Cart Products
Route::get('/cart/product/', [CartController::class, 'cartProduct']);
// Remove product from cart
Route::get('/remove/cart/{id}', [CartController::class, 'removeCart']);
// Product Incrment
Route::get('/increment/{id}', [CartController::class, 'incrementProduct']);
// Product decrement
Route::get('/decrement/{id}', [CartController::class, 'decrementProduct']);
// Get Vat
Route::get('/vats', [CartController::class, 'vats']);


