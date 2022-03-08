@extends("layouts.admin")
@section("title", "Viewing Application: " . $application->username)
@section("content")

<div class="overflow-auto h-screen pb-24 px-4 md:px-6">
    <h1 class="text-4xl font-semibold text-gray-800 dark:text-white">
        Hello, {{ auth()->user()->name }}
    </h1>
    <h2 class="text-md text-gray-400">
        This is the administration panel.
        Use the navigation panel on the left to configure your application.
    </h2>

    <div class="mt-4 w-full text-black dark:text-white">
        {{ $application->username }}
    </div>
</div>

@endsection