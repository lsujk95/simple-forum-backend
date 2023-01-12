<?php

namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return ApiResult::getSuccessResult(Forum::all());
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
     * Display the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Forum $forum)
    {
        return ApiResult::getSuccessResult($forum);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
