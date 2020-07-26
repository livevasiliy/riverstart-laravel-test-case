<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryAPIRequest;
use App\Http\Requests\UpdateCategoryAPIRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryAPIController extends Controller
{
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * CategoryAPIController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->categoryService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryAPIRequest $request
     * @return Response
     */
    public function store(CreateCategoryAPIRequest $request)
    {
        return $this->categoryService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        return $this->categoryService->show($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryAPIRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(UpdateCategoryAPIRequest $request, Category $category)
    {
        return $this->categoryService->update($request, $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        return $this->categoryService->destroy($category);
    }
}
