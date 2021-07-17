<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
   
//     return view('welcome');
//   // return "i am bored";
// });

// Route::get('/about', function () {
   
//     return "Hey i am About";

// });

// Route::get('/contact', function () {
   
//     return "i am your contact";
// });


// Route::get('/count/{name}/{age}', function ($name,$age) {
   
//     return "Hey I am ".$name." and My age is ".$age;

// });

// Route::get('admin/post/example',array('as'=>'admin.home',function(){

//     $url=route('admin.home');
//     return "this is full link".$url;
// }));


// Route::get('/user/{id}', [TestController::class, 'index']);

// Route::get('/user','TestController@index');



Route::get('/register', [TestController::class, 'createData']);
Route::post('/register',[TestController::class,'storeData']);




