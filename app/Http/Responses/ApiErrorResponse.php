<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiErrorResponse implements Responsable
{

    public function __construct(
        private string $message,
        private array $errors = array(),
        private int $code = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {}

    public function toResponse($request)
    {

        $data = [
            'success' => false,
            'message' => $this->message,
            'errors' => $this->errors
        ];


        return response()->json($data, $this->code);
    }
}