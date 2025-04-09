<?php
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bad-request-exception', [ErrorController::class, 'badRequestException']);
Route::get('/not-found-exception', [ErrorController::class, 'notFoundException']);
Route::get('/unprocessable-entity-exception', [ErrorController::class, 'unprocessableEntityException']);
