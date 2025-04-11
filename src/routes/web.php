<?php
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Laravelで用意されている400エラーの例外クラスのレスポンスが返却されるEP
Route::get('/bad-request-exception', [ErrorController::class, 'badRequestException']);
// 自作の404エラーの例外クラスのレスポンスが返却されるEP
Route::get('/not-found-exception', [ErrorController::class, 'notFoundException']);
// PHPで用意されているベース例外クラスのレスポンスが返却されるEP
Route::get('/unprocessable-entity-exception', [ErrorController::class, 'unprocessableEntityException']);
