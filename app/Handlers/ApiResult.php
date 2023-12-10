<?php

namespace App\Handlers;

use Illuminate\Http\JsonResponse;

class ApiResult {
    private $success = false;
    private $data = null;
    private $message = null;
    private $code = null;

    /**
     * Return json result
     * @return JsonResponse
     */
    private function getResult(): \Illuminate\Http\JsonResponse
    {
        $result = [];
        $result['success'] = $this->success;

        if (!$result['success']) {
            $result['code'] = $this->code;
        }

        $result['data'] = $this->data;
        $result['message'] = $this->message;

        return response()->json($result);
    }

    /**
     * Returns json success result
     * @param $data
     * @param $message
     * @return JsonResponse
     */
    static function getSuccessResult($data = null, $message = null): \Illuminate\Http\JsonResponse
    {
        $result = new ApiResult();
        $result->success = true;
        $result->data = $data;
        $result->message = $message;

        return $result->getResult();
    }

    /**
     * Returns json error result
     * @param $code
     * @param $data
     * @param $message
     * @return JsonResponse
     */
    static function getErrorResult($code, $data = null, $message = null) : \Illuminate\Http\JsonResponse
    {
        $result = new ApiResult();
        $result->success = false;
        $result->code = $code;
        $result->data = $data;
        $result->message = $message;

        return $result->getResult();
    }
}
