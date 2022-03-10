@extends("layouts.app")
@section("title", "Viewing Forum " . $board->name)
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="threadList">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">{{ $board->name }}</h2>
            </div>
            <div class="grid grid-cols-5 gap-3">
                <div class="bg-blue-10 col-span-4">
                    <!-- Content -->
                    <div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden p-1 mt-5 transition-500">
                        @forelse($threads as $thread)
                            <a href="#" class="w-full flex p-3 pl-4 items-center hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer border border-gray-400 dark:border-indigo-800 mb-2">
                                <div class="mr-4">
                                    <div class="h-9 w-9 rounded-sm flex items-center justify-center text-3xl" >
                                        <img src="{{ $thread->user->avatar }}" class="rounded relative"/>
                                    </div>
                                </div>
                                <div>
                                <div class="font-bold text-lg">{{ $thread->title }}</div>
                                    <div class="text-xs text-gray-500">
                                        <span class="mr-2">Author: {{ $thread->user->name }}</span>
                                        <span class="mr-2">Posted: {{ $thread->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                @if($thread->locked)
                                <div class="mr-4">
                                    <div class="mx-auto" >
                                        <i class="fad fa-lock-alt" style="color: #d63031"></i>
                                    </div>
                                </div>
                                @endif
                            </a>
                        @empty
                            <div class="text-center">
                                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">{{ $board->name }} has no threads.</h2>
                            </div>
                        @endforelse
                    </div>

                    <div class="dark:text-white w-full rounded overflow-hidden p-1 mt-5 transition-500">
                        {{ $threads->links('pagination::tailwind') }}
                    </div>
                </div>
                <div class="col-0">
                    <!-- Sidebar -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection