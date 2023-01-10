<?php

namespace App\Handlers;

class ApiResult {
    private $success = false;
    private $data = null;
    private $message = null;
    private $code = null;

    private function getResult(): \Illuminate\Http\JsonResponse
    {
        $result = [];
        $result['success'] = $this->success;

        if ($result['success']) {
            $result['data'] = $this->data;
            $result['message'] = $this->message;
        } else {
            $result['code'] = $this->code;
            $result['message'] = $this->message;
        }

        return response()->json($result);
    }

    static function getSuccessResult($data = null, $message = null): \Illuminate\Http\JsonResponse
    {
        $result = new ApiResult();
        $result->success = true;
        $result->data = $data;
        $result->message = $message;

        return $result->getResult();
    }

    static function getErrorResult($code, $message = null): \Illuminate\Http\JsonResponse
    {
        $result = new ApiResult();
        $result->success = false;
        $result->code = $code;
        $result->message = $message;

        return $result->getResult();
    }
}
