<?php

use Illuminate\Support\Facades\Route;
use Nuwave\Lighthouse\Http\GraphQLController as GraphQL;
Route::any('/graphql', [GraphQL::class, 'query']);

