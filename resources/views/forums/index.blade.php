@extends("layouts.app")
@section("title", "Forums")
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="serverList">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">Forums</h2>
            </div>
            <div class="grid grid-cols-5 gap-3">
                <div class="bg-blue-10 col-span-4">
                    <!-- Forum Content -->
                    @foreach($categories as $category)
                        <div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden p-1 mt-5 transition-500">
                            <div class="font-bold text-xl">{{ $category->name }}</div>
                            <span class="text-sm font-normal mt-2"> {{ $category->description }}</span>
                            <hr class="hr mb-2"/>
                            @foreach($category->boards as $board)
                                <a href="{{ route('forums.boards.show', $board->id) }}" class="w-full flex p-3 pl-4 items-center hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer border border-gray-400 dark:border-indigo-800 mb-2">
                                    <div class="mr-4">
                                        <div class="h-16 w-16 rounded-sm flex items-center justify-center text-3xl" >
                                            <i class="text-[{{ $board->color ?? '#fff'}}] {{ $board->icon ?? "fa fa-gavel" }}"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg">{{ $board->name }}</div>
                                        <div class="text-xs text-gray-500">
                                            <span class="mr-2">{{ $board->description ?? "" }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-0">
                    @include('includes.forums.stats')
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection