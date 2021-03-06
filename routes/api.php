<?php

use App\ExpenseCategory;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::fallback(function(){
    return response()->json(['error' => 'Resource rout not found.'], 404);
})->name('fallback');


Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Api\ResetPasswordController@reset');


Route::middleware("auth:api")->group(function () {

    Route::apiResource('transaction', 'Api\TransactionController');
    Route::apiResource('user', 'Api\UserController');
    Route::apiResource('bill', 'Api\BillsController');
    Route::apiResource('expensecategory', 'Api\ExpenseCategoryController', [
        'parameters' => [
            'ExpenseCategory' => 'expensecategory'
        ]]);
    Route::apiResource('expense', 'Api\ExpenseController');
});
