<?php

namespace App\Http\Controllers\Admin\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryForm;
use App\Models\Forums\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-forums');
    }

    public function index()
    {
        $categories = Category::all();

        return view('admin.forums.categories', compact('categories'));
    }

    public function store(CategoryForm $request): RedirectResponse
    {
        Category::create($request->validated());

        toastr()->success('Successfully created new category!');
        return redirect()->route('admin.categories');
    }

    public function update(CategoryForm $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        toastr()->success('Successfully updated category!');
        return redirect()->route('admin.categories');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        toastr()->warning('Successfully deleted category!');
        return redirect()->route('admin.categories');
    }
}
