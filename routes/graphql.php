<?php 

use Illuminate\Support\Facades\Route;
use Nuwave\Lighthouse\Http\GraphQLController;

Route::any('/graphql', GraphQLController::class);