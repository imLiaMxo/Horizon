@extends("layouts.app")
@section("title", "Viewing Thread " . $thread->title)
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="thread">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">{{ $thread->title }}</h2>
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
                    @foreach($thread->board->breadcrumbs as $breadcrumb)
                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.boards.show', $breadcrumb->id) }}">
                            {{ $breadcrumb->name }}
                        </a>
                        <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
                    </li>
                    @endforeach

                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.threads.show', $thread->id) }}">
                            <b>{{ $thread->title }}</b>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End -->

            <!-- Content -->
            <div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden p-1 mt-5 transition-500">
                <div class="grid grid-cols-5 gap-3 h-full">
                    <div class="col-span-1 w-full text-center border-r-2">
                        <div class="p-4 mt-4">
                            <img src="{{ $thread->user->avatar }}" class="rounded my-auto mx-auto"/>
                        </div>
                        <div class="p-2">
                            <span class="text-2xl">{{ $thread->user->name }}</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full p-4 mt-4">
                            {!! $thread->content !!}
                        </div>
                    </div>
                </div>
                <span class="p-2 text-sm"><i class="fa fa-clock"></i> {!! $thread->created_at->diffForHumans() !!}</span>
            </div>
        </div>
    </div>
</section>
@endsection