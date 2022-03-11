@extends("layouts.admin")
@section("title", "Manage Forums")
@section("content")

<div class="overflow-auto h-screen pb-24 px-4 md:px-6">
    <h1 class="text-4xl font-semibold text-gray-800 dark:text-white">
        Hello, {{ auth()->user()->name }}
    </h1>
    <h2 class="text-md text-gray-400">
        This is the administration panel.
        Use the navigation panel on the left to configure your application.
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
        
            <h1 class="text-xl font-semibold text-black dark:text-white">
                What would you like to manage?
            </h1>

            <a class="border-2 border-purple-600 text-black px-12 py-3 rounded-md text-1xl text-center font-medium hover:bg-purple-600 transition duration-300 dark:text-white" href="{{ route('admin.categories') }}">Manage Categories</a>
            <a class="border-2 border-red-600 text-black px-12 py-3 rounded-md text-1xl text-center font-medium hover:bg-red-600 transition duration-300 dark:text-white" href="{{ route('admin.forums.boards') }}">Manage Boards</a>
            
    </div>
</div>

@endsection