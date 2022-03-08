@extends("layouts.admin")
@section("title", "Settings")
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
        <ul class="flex">
            <li class="mr-1 ">
                <a class="inline-block py-2 px-4 font-semibold rounded shadow-xl bg-gray-200 dark:bg-indigo-500 hover:bg-gray-300 dark:hover:bg-indigo-700 dark:text-white text-black" href="{{ route('admin.settings', 'general') }}">General</a>
            </li>
            <li class="mr-1">
                <a class="inline-block py-2 px-4 font-semibold rounded shadow-xl bg-gray-200 dark:bg-indigo-500 hover:bg-gray-300 dark:hover:bg-indigo-700 dark:text-white text-black" href="{{ route('admin.settings', 'site') }}">Site</a>
            </li>
            <li class="mr-1">
                <a class="inline-block py-2 px-4 font-semibold rounded shadow-xl bg-gray-200 dark:bg-indigo-500 hover:bg-gray-300 dark:hover:bg-indigo-700 dark:text-white text-black" href="{{ route('admin.settings', 'meta') }}">Meta</a>
            </li>
            <li class="mr-1">
                <a class="inline-block py-2 px-4 font-semibold rounded shadow-xl bg-gray-200 dark:bg-indigo-500 hover:bg-gray-300 dark:hover:bg-indigo-700 dark:text-white text-black" href="{{ route('admin.settings', 'forums') }}">Forums</a>
            </li>
            <li class="mr-1">
                <a class="inline-block py-2 px-4 font-semibold rounded shadow-xl bg-gray-200 dark:bg-indigo-500 hover:bg-gray-300 dark:hover:bg-indigo-700 dark:text-white text-black" href="{{ route('admin.settings', 'store') }}">Donations</a>
            </li>
        </ul>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
        <button class="p-2 pl-5 pr-5 bg-gray-400 dark:bg-gray-700 border-2 border-indigo-500 text-indigo-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-indigo-500 hover:text-gray-100 focus:border-4 focus:border-indigo-300" form="settings-form">Save</button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
        <!-- Content -->

        <form action="{{ route('admin.settings.save', $activeCategory) }}" method="POST"
                      id="settings-form">
                    @csrf
                    @method('PATCH')
                    <div class="flex">
            @foreach($configurations as $category => $configs)
                    <article class="m-2 rounded shadow-xl bg-gray-200 dark:bg-gray-700 dark:text-white text-black">
                        <div class="h-9 w-9 pl-2 rounded-sm flex items-left justify-left text-2xl" >
                            <h5 class="mb-0 font-weight-bold">{{ $category ?? 'Uncategorized' }}</h5>
                        </div>
                        <div class="p-2">
                            @foreach($configs as $configuration)
                                <div class="mt-2">
                                    <h6 class="mb-0 font-weight-bold">{!! $configuration->display_name !!}</h6>

                                    <x-configuration :configuration="$configuration"/>
                                </div>
                            @endforeach
                        </div>
                    </article>
            @endforeach
            </div>
        </form>
    </div>
</div>

@endsection