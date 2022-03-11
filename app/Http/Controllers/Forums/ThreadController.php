<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThreadForm;
use App\Models\Forums\Board;
use App\Models\Forums\Category;
use App\Models\Forums\Thread;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Mews\Purifier\Facades\Purifier;

class ThreadController extends Controller
{

    public function create(Board $board)
    {
        $this->authorize('create', [Thread::class, $board]);

        return view('forums.threads.create', compact('board'));
    }

    public function store(ThreadForm $request, Board $board)
    {
        $this->authorize('create', [Thread::class, $board]);

        /** @var Thread $thread */
        $thread = $board->threads()->create([
            'title' => request('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->id()
        ]);

        if (!$request->user()->hasAchievement(FirstThread::class)) // TODO: move this logic to event listener
            $request->user()->achieve(FirstThread::class);

        toastr()->success('Successfully created new thread!');
        return redirect()->route('forums.threads.view', $thread->id);
    }

    public function show(Thread $thread)
    {

        $posts = $thread->posts()->with([
            'user', 'user.displayRole'
        ])->paginate(8);

        [$categories, $canManageThreads, $canMoveThreads] = [null, false, false];
        if (auth()->check()) {
            $canManageThreads = auth()->user()->hasPermissionTo('manage-forums');

            if ($canManageThreads && $canMoveThreads = auth()->user()->hasPermissionTo('manage-forums')) {
                $categories = Category::with('boards')->get();
            }
        }

        return view('forums.threads.view', compact(
            'thread', 'posts', 'categories', 'canManageThreads', 'canMoveThreads'
        ));
    }
}
