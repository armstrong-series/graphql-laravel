<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Rebing\GraphQL\GraphQLController as GraphQL;



Route::any('/graphql', [GraphQL::class, 'query']);
Route::post('/', [AuthController::class, 'signin']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/account', [AuthController::class, 'signup']);

Route::get('/password/forgot', [AuthController::class, 'passwordForgotPage']);




