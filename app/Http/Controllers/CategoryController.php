<?php

namespace App\Http\Controllers;

use App\Handlers\ApiResult;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $withForums = $request->query('withForums');
        if (!empty($withForums) && boolval($withForums)) {
            return ApiResult::getSuccessResult(Category::with('forums')->get());
        }

        return ApiResult::getSuccessResult(Category::all());
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
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            Category::create($request->all());
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return ApiResult::getSuccessResult($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResult::getErrorResult('UNVALIDATED', $validator->errors());
        }

        try {
            $category->update($request->all());
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return ApiResult::getSuccessResult();
        } catch (\Exception $e) {
            return ApiResult::getErrorResult($e->getCode(), null, $e->getMessage());
        }
    }
}
