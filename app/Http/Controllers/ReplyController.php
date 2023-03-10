<?php

namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    /**
     * Returns all replies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return ApiResult::getSuccessResult(Reply::all());
    }

    /**
     * Stores a newly created reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'thread_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            $data = $request->all();
            $data['user_id'] = $request->user()->id;

            $reply = Reply::create($data);
            return ApiResult::getSuccessResult(Reply::with(['user'])->find($reply->id));
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Displays the specified reply.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Reply $reply)
    {
        return ApiResult::getSuccessResult($reply);
    }

    /**
     * Updates the specified reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Reply $reply)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'thread_id' => 'numeric',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('VALIDATION', $validator->errors());
        }

        try {
            if ($reply->user_id != $request->user()->id) {
                if (!$request->user()->hasAction('ReplyController@update')) {
                    return ApiResult::getErrorResult('UNAUTORIZED');
                }
            }

            $reply->update($request->all());
            return ApiResult::getSuccessResult(Reply::with(['user'])->find($reply->id));
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Removes the specified reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Reply $reply)
    {
        try {
            if ($reply->user_id != $request->user()->id) {
                if (!$request->user()->hasAction('ReplyController@destroy')) {
                    return ApiResult::getErrorResult('UNAUTORIZED');
                }
            }

            $reply->delete();
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }
}
