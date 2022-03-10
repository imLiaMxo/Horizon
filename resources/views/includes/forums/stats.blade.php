<!-- Recent Threads -->
@if($recentThreads->count() > 0)
<div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden px-2 py-2 mt-5 transition-500">
    <div class="font-bold text-xl">Latest Threads</div>
    <span class="text-sm font-normal mt-2">Recent threads posted in our community.</span>
    <hr class="hr mb-2"/>

    @foreach($recentThreads as $thread)
        <a href="#" class="w-full flex p-1 pl-4 items-center hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer mb-2">
            <div class="mr-4">
                <div class="h-16 w-16 rounded-sm flex items-center justify-center text-3xl" >
                    <img class="rounded" src="{{ $thread->user->avatar }}"/>
                </div>
            </div>
            <div>
                <div class="font-bold text-lg">{{ $thread->title }}</div>
                <div class="text-xs text-gray-500">
                    <span class="mr-2">{{ $thread->created_at->diffForHumans() }} by <b>{{ $thread->user->name }}</b></span>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endif

<!-- Recent Posts -->

@if($recentPosts->count() > 0)
<div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden p-1 mt-5 transition-500">
    @foreach($recentPosts as $post)
        <a href="#" class="w-full flex p-1 pl-4 items-center hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer mb-2">
            <div class="mr-4">
                <div class="h-16 w-16 rounded-sm flex items-center justify-center text-3xl" >
                    <img class="rounded" src="{{ $post->user->avatar }}"/>
                </div>
            </div>
            <div>
                <div class="font-bold text-lg">{{ $post->thread->title }}</div>
                <div class="text-xs text-gray-500">
                    <span class="mr-2">{{ $post->created_at->diffForHumans() }} by <b>{{ $post->user->name }}</b></span>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endif