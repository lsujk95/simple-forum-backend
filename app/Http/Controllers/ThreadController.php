<?php

namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    /**
     * Returns all threads.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return ApiResult::getSuccessResult(Thread::all());
    }

    /**
     * Stores a newly created thread.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
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

            $thread = Thread::create($data);
            return ApiResult::getSuccessResult($thread);
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Displays the specified thread.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Thread $thread): \Illuminate\Http\JsonResponse
    {
        $withReplies = $request->query('withReplies');
        if (!empty($withReplies) && boolval($withReplies)) {
            return ApiResult::getSuccessResult(Thread::with(['replies', 'user'])->find($thread->id));
        }

        return ApiResult::getSuccessResult(Thread::with(['user'])->find($thread->id));
    }

    /**
     * Update the specified reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Thread $thread): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
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
            return ApiResult::getSuccessResult($thread);
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Removes the specified reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Thread $thread): \Illuminate\Http\JsonResponse
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
