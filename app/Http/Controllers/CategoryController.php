<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\Contracts\ICategoryService;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    protected ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = $this->categoryService->getAll();
        return view('admin.categories.index', compact('categories'))->with('currentTitle', 'Danh sách danh mục');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
{
    $result = $this->categoryService->create($request->validated());

    if ($result === null) {
        return redirect()->back()->with('error', 'Danh mục đã tồn tại');
    }

    return redirect()->route('admin.categories.index')->with('success', 'Danh mục tạo thành công');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = $this->categoryService->findById($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        $result = $this->categoryService->update($id, $request->validated());

    if ($result === null) {
        return redirect()->back()->with('error', 'Tên danh mục đã tồn tại');
    }

    return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã bị xóa');
    }
}
