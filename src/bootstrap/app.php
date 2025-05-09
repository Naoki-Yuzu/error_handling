<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Laravelはデフォルトだと、BadRequestHttpExceptionの例外クラスをログに出力しないので、
        // ログに出力するように設定する
        //
        // https://readouble.com/laravel/11.x/ja/errors.html#ignoring-exceptions-by-type
        $exceptions->stopIgnoring(BadRequestHttpException::class);

        $exceptions->report(function (BadRequestHttpException $e) {
            Log::error($e->getMessage());
        });

        // Laravelの例外クラスの親子構造
        // 〇〇HttpException > HttpException > RuntimeException > Exception > Throwable
        // Exceptions > Handler > ExceptionHandler > Throwable

        // Laravelで用意されている400エラーの例外クラス
        $exceptions->render(function (BadRequestHttpException $e, Request $r) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        });

        // Laravelで用意されているHTTPエラーのベース例外クラス
        $exceptions->render(function (HttpException $e, Request $r) {
            return response()->json([
                'message' =>  $e->getMessage(),
            ], $e->getStatusCode());
        });

        // PHPで用意されているベース例外クラス
        $exceptions->render(function (Exception $e , Request $r) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        });
    })->create();
