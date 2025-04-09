<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

// 自作の404エラーの例外クラス
class NotFoundHttpException extends Exception
{
    public function __construct(string $message = 'Not Found Exception')
    {
        parent::__construct(
            $message,
            Response::HTTP_NOT_FOUND,
        );
    }

    // ログ出力
    public function report(): void
    {
        Log::error($this->getMessage());
    }

    // JSONレスポンス返却
    public function render(): JsonResponse
    {
        return response()->json([
            'status' => $this->getCode(),
            'message' => $this->getMessage()
        ], $this->getCode());
    }
}
