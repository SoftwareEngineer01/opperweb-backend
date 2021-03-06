<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponseApiController extends Controller
{
    
    public function sendResponse($result, $message) {

        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 400) {

        $response = [
            "success" => false,
            "message" => $error
        ];

        if(!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }


    public function unauthorized($error = 'Forbidden', $code = 403) {

        $response = [
            "success" => false,
            "message" => $error
        ];

        return response()->json($response, $code);

    }

}
