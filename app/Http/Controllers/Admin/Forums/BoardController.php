<?php

namespace App\Http\Controllers\Admin\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BoardForm;
use App\Models\Forums\Board;
use App\Models\Forums\Category;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-forums');
    }

    public function index()
    {
        $boards = Board::all()->groupBy('parent_id');
        $categories = Category::all();
        $roles = Role::all();

        return view('admin.forums.boards', compact('boards', 'categories', 'roles'));
    }

    public function store(BoardForm $request): RedirectResponse
    {
        /** @var Category $category */
        $category = Category::where('name', $request->post('category'))->firstOrFail();
        $category->boards()->create(array_merge($request->validated(), [
            'roles' => $request->roles ?? []
        ]));

        toastr()->success('Successfully created board!');
        return redirect()->route('admin.forums.boards');
    }

    public function update(BoardForm $request, Board $board): RedirectResponse
    {
        $category = Category::where('name', $request->post('category'))->firstOrFail();

        $board->update(array_merge(
            $request->validated(),
            ['category_id' => $category->id, 'roles' => $request->roles ?? []]
        ));

        toastr()->success('Successfully updated board!');
        return redirect()->route('admin.forums.boards');
    }

    public function destroy(Board $board): RedirectResponse
    {
        $board->delete();

        toastr()->success('Successfully deleted board!');
        return redirect()->route('admin.forums.boards');
    }

    public function sort()
    {
        $board = Board::findOrFail(request('boardId'));
        $parent = Board::find(request('parentId'));

        if(!is_null($parent) && $board->category_id !== $parent->category_id) return;

        $board->update([
           'parent_id' => $parent ? request('parentId') : null
        ]);

        toastr()->success('Successfully sorted the boards!');
    }
}
