<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function noDataAvailable($message = null)
    {
        return response()->json([
            'code' => Response::HTTP_NOT_FOUND,
            'message' => $message ?? 'មិនមានទិន្នន័យ',
        ]);
    }
    public function normalResponse($data = null)
    {
        $response['code'] = Response::HTTP_OK;
        $response['message'] = 'ជោគជ័យ';
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }
    public function customResponse($data = [])
    {
        $response['code'] = Response::HTTP_OK;
        $response['message'] = 'ជោគជ័យ';
        return response()->json(array_merge($response, $data));
    }

    public function errorsResponse(\Throwable $errors)
    {
        return response()->json([
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $errors->getMessage(),
        ]);
    }
}
