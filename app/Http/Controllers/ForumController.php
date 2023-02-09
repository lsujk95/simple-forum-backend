<?php

namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    /**
     * Returns all forums.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return ApiResult::getSuccessResult(Forum::all());
    }

    /**
     * Stores a newly created forum.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            Forum::create($request->all());
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Displays the specified forum.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Forum $forum)
    {
        $withThreads = $request->query('withThreads');
        if (!empty($withThreads) && boolval($withThreads)) {
            return ApiResult::getSuccessResult(Forum::with('threads')->find($forum->id));
        }

        return ApiResult::getSuccessResult($forum);
    }

    /**
     * Updates the specified forum.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Forum $forum)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            $forum->update($request->all());
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Removes the specified forum.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Forum $forum)
    {
        try {
            $forum->delete();
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }
}
