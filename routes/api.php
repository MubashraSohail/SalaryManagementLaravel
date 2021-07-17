<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[AdminController::class,'register']);
Route::post('/login',[AdminController::class,'login']);
Route::post('/addEmployee',[EmployeeController::class,'addEmployee']);
Route::get('/showEmployee',[EmployeeController::class,'showemployee']);
Route::post('/updateEmployee',[EmployeeController::class,'updateprofile']);
Route::post('/getEmployee',[EmployeeController::class,'getEmployee']);
Route::post('/delete',[EmployeeController::class,'deleteEmployee']);
Route::post('/addbank',[BankController::class,'addbank']);
Route::get('/showbank',[BankController::class,'showaccount']);
Route::post('/updatebank',[BankController::class,'updatebank']);
Route::post('/getbank',[BankController::class,'getbank']);
Route::post('/deletebank',[BankController::class,'deletebank']);
Route::post('/addAmount',[BankController::class,'addAmount']);
Route::post('/TransactionHistory',[SalaryController::class,'TransactionHistory']);
Route::post('/Salary',[SalaryController::class,'Salary']);
Route::get('/showasalary',[SalaryController::class,'showasalary']);
