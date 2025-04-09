<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ErrorController extends Controller
{
    public function badRequestException(): void
    {
        // Laravelで用意されている400エラーの例外クラスでスロー
        throw new BadRequestHttpException("不正なエラー！ from " . __FILE__);
    }

    public function notFoundException(): void
    {
        // 自作の404エラーの例外クラスでスロー
        throw new NotFoundHttpException("見つかりません！ from " . __FILE__);
    }

    public function unprocessableEntityException(): void
    {
        // PHPで用意されているベース例外クラスでスロー
        throw new Exception("バリデーションエラー！ from " . __FILE__, 422);
    }
}
