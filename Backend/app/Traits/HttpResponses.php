<?php

namespace App\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

trait HttpResponses
{
    //estrutura para respostas
    public function response(string $mensagem, string|int $status, array|Model|JsonResource $data=[])
    {
        return response()->json([
            'mensagem' => $mensagem,
            'status' => $status,
            'data' => $data
        ],$status);
    }
    //estrutura para erros
    public function error(string $mensagem, string|int $status, array|MessageBag $errors = [], array $data=[])
    {
        return response()->json([
            'mensagem' => $mensagem,
            'status' => $status,
            'errors' => $errors,
            'data' => $data
        ],$status);

    }
}


