<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function sendResponse($response,$status = 200)
    {
        return response()->json($response, $status);
    }


    public function sendError($error, $code = 404)
    {
    	$response = [
            'error' => $error,
        ];
        return response()->json($response, $code);
    }
}
