@extends("layouts.app")
@section("title", "Notifications")
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="serverList">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">Your Notifications</h2>
            </div>
            <div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded-xl shadow-xl overflow-hidden p-1 mt-5 transition-500">
                @forelse ($notifications as $notification)
                <a href="{{ route('notifications.read', $notification->id) }}" class="w-full flex p-3 pl-4 items-center hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer">
                    <div class="mr-4"><div class="h-9 w-9 rounded-sm flex items-center justify-center text-3xl" >
                        <img src="{{ $configs['site_logo'] }}" alt="{{ $configs['site_name'] }}" class="rounded-full"/>
                    </div>
                </div>
                <div>
                    <div class="font-bold text-lg">{{ $notification->data['name'] }}<span class="text-base font-normal"> {{ $notification->data['content'] }}</div>
                        <div class="text-xs text-gray-500">
                            <span class="mr-2">{{ $notification->created_at->toDayDateTimeString() }}</span>
                            @if(!$notification->read_at)
                                <span class="mr-2 text-white bg-green-600 p-1 rounded">NEW</span>
                            @endif
                        </div>
                    </div>
                </a>
                @empty
                <div class="text-center">
                    <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-2xl h-screen">No Notifications</h2>
                </div>
                @endforelse
                
            </div>
            <div class="dark:text-white w-full rounded overflow-hidden p-1 mt-5 transition-500">
                {{ $notifications->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</section>
@endsection