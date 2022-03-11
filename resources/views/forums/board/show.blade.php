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
            <!-- Breadcrumbs -->
            <div class="dark:bg-gray-700 transition-colors transition p-4 mt-3 mb-3 flex items-center flex-wrap rounded shadow-xl text-black dark:text-white">
                <ul class="flex items-center">
                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.index') }}">
                            <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
                        </a>
                        <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
                    </li>

                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.index') }}">
                            Forums
                        </a>
                        <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
                    </li>
                    <li class="inline-flex items-center">
                        <a href="#">
                            {{ $board->name }}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End -->

            <!-- Content -->
            <div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden p-1 mt-5 transition-500">
                <div class="font-bold text-3xl p-2">{{ $board->name }}</div>
                <span class="text-sm font-normal p-2"> {{ $board->description }}</span>
                    <div class="text-right">
                        <a href="{{route('forums.threads.create', $board->id)}}" class="border-2 border-blue-500 mb-3 text-black px-8 py-2 rounded-md text-1xl font-medium hover:bg-blue-500 transition duration-300 dark:text-white">
                            Create Thread
                        </a>
                    </div>
                <hr class="hr mt-4 mb-2"/>
                @forelse($threads as $thread)
                    <a href="{{ route('forums.threads.show', $thread->id) }}" class="w-full flex p-3 pl-4 items-center hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer border border-gray-400 dark:border-indigo-800 mb-2">
                        <div class="mr-4">
                            <div class="h-9 w-9 rounded-sm flex items-center justify-center text-3xl" >
                                <img src="{{ $thread->user->avatar }}" class="rounded relative"/>
                            </div>
                        </div>
                        <div>
                        <div class="font-bold text-lg">{{ $thread->title }}
                            @if($thread->locked)
                                <i class="fa fa-lock text-normal" style="color: #d63031"></i>
                            @endif
                        </div>
                            <div class="text-xs text-gray-500">
                                <span class="mr-2">Author: {{ $thread->user->name }}</span>
                                <span class="mr-2">Replies: {{ $thread->posts_count }}</span>
                                <span class="mr-2">Posted: {{ $thread->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
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
    </div>
</section>
@endsection