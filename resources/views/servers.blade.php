@extends("layouts.app")
@section("title", "Server View")
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="serverList">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">Server Status</h2>
                <p class="mt- max-w-2xl mx-auto text-xl text-black dark:text-white sm:mt-4">
                    Check the status of all of our servers.
                </p>
            </div>
            <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">
                @foreach($response as $server)
                <div class="sm:mb-3 flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0"><img src="/img/{{ $server['data']['relationships']['game']['data']['id'] }}.png" alt="image" class="h-48 w-full object-cover" /></div>
                    <div class="flex-1 bg-gray-600 dark:bg-gray-400 p-6 flex flex-col justify-between">
                        <a href="#" class="flex-1 h-full inline-grid">
                            <p class="text-xl text-white font-semibold">{{ $server['data']['attributes']['name'] }}</p>
                            <span class="mt-auto text-base text-white pb-0 mb-0 flex-grow"><b>Current Players: {{ $server['data']['attributes']['players'] }}/{{ $server['data']['attributes']['maxPlayers'] }}</b></span>
                            @if($server['data']['relationships']['game']['data']['id'] == "postscriptum")
                                <span class="mt-auto text-base text-white pb-0 mb-0 flex-grow">Current Map: {{ $server['data']['attributes']['details']['map'] }}</span>
                            @endif
                        </a>
                        <a href="steam://connect/{{ $server['data']['attributes']['ip'] . ':' . $server['data']['attributes']['port'] }}" class="sm:mt-3 mt-flex transition ml-auto text-right items-center px-4 py-2 border-0 text-base
                        font-medium rounded-md shadow-sm text-white bg-red-400 hover:text-white hover:bg-neutral-300 focus:outline-none
                        focus:ring-0"> Join Server</a>
                    </div>
                </div>
                @endforeach
                <!-- For Looop -->
            </div>
        </div>
    </div>
</section>
@endsection