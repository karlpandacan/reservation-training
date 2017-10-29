<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $token;

    public function __construct()
    {

    }
    public function successfulResponse($reponseData = [])
    {
        return response([
            'success' => true,
            'status' => $reponseData['status'] ?? 200,
            'code' => $responseData['code'] ?? 'S200',
            'result' => $reponseData['result'] ?? 'Request Successful.',
        ], $reponseData['status'] ?? 200);
    }

    public function internalError($result = 'Internal Server Error.')
    {
        return response([
            'success' => false,
            'status' => 500,
            'code' => 'E505',
            'result' => $message
        ], 500);
    }

    public function badRequest($result = 'Bad Request.')
    {
        return response([
            'success' => false,
            'status' => 400,
            'code' => 'E400',
            'result' => $result
        ], 400);
    }
}
