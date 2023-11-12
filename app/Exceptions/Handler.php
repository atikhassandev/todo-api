<?php

namespace App\Exceptions;

use App\Http\Responses\ApiErrorResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Exception | Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return new ApiErrorResponse('Record not found.', [], JsonResponse::HTTP_NOT_FOUND);
        }

        if ($e instanceof ValidationException) {
            return new ApiErrorResponse('Invalid input data.', $e->errors(), $e->status);
        }

        return parent::render($request, $e);
    }

}
