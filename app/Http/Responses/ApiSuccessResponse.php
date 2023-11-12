<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable
{

    public function __construct(
        private string $message,
        private array $data = array(),
        private int $code = Response::HTTP_OK
    ) {}

    public function toResponse($request)
    {

        $data = [
            'success' => true,
            'message' => $this->message,
        ];


        return response()->json(array_merge($data, $this->data), $this->code);
    }
}