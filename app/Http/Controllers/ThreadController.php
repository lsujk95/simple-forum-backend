<?php

namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return ApiResult::getSuccessResult(Thread::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'forum_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            $data = $request->all();
            $data['user_id'] = $request->user()->id;

            Thread::create($data);
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Thread $thread)
    {
        return ApiResult::getSuccessResult($thread);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Thread $thread)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'forum_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('VALIDATION', $validator->errors());
        }

        try {
            if ($thread->user_id != $request->user()->id) {
                if (!$request->user()->hasAction('ThreadController@update')) {
                    return ApiResult::getErrorResult('UNAUTORIZED');
                }
            }

            $thread->update($request->all());
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Thread $thread)
    {
        try {
            if ($thread->user_id != $request->user()->id) {
                if (!$request->user()->hasAction('ThreadController@destroy')) {
                    return ApiResult::getErrorResult('UNAUTORIZED');
                }
            }

            $thread->delete();
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }
}
