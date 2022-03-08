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
                        <svg t="1645067416159" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1487" width="200" height="200"><path d="M57.6 829.866667C17.066667 804.266667 6.4 750.933333 32 710.4L192 814.933333c-25.6 40.533333-78.933333 51.2-119.466667 25.6l-14.933333-10.666666z" fill="#FF8A14" p-id="1488"></path><path d="M1006.933333 757.333333c0 46.933333-38.4 87.466667-87.466666 87.466667v-189.866667c46.933333 0 87.466667 38.4 87.466666 87.466667v14.933333z" fill="#FF8A14" p-id="1489"></path><path d="M704 358.4h-189.866667l10.666667-42.666667c4.266667-14.933333 17.066667-25.6 34.133333-25.6H661.333333c14.933333 0 29.866667 10.666667 34.133334 25.6l8.533333 42.666667z" fill="#ADC4D9" p-id="1490"></path><path d="M919.466667 885.333333c0 38.4-32 68.266667-68.266667 68.266667H366.933333c-38.4 0-68.266667-32-68.266666-68.266667V652.8C298.666667 480 437.333333 341.333333 608 341.333333s311.466667 138.666667 311.466667 311.466667v232.533333z" fill="#FFE500" p-id="1491"></path><path d="M608 341.333333c-170.666667 0-309.333333 138.666667-309.333333 311.466667v87.466667c0-172.8 138.666667-311.466667 311.466666-311.466667s311.466667 138.666667 311.466667 311.466667v-87.466667C919.466667 480 780.8 341.333333 608 341.333333z" fill="#FFF48C" p-id="1492"></path><path d="M256 979.2a352 32 0 1 0 704 0 352 32 0 1 0-704 0Z" fill="#45413C" p-id="1493"></path><path d="M834.133333 947.2c0 19.2-14.933333 34.133333-34.133333 34.133333H418.133333c-19.2 0-34.133333-14.933333-34.133333-34.133333v-104.533333c0-19.2 14.933333-34.133333 34.133333-34.133334h379.733334c19.2 0 34.133333 14.933333 34.133333 34.133334v104.533333z" fill="#C0DCEB" p-id="1494"></path><path d="M834.133333 842.666667c0-19.2-14.933333-34.133333-34.133333-34.133334H418.133333c-19.2 0-34.133333 14.933333-34.133333 34.133334v42.666666c0-19.2 14.933333-34.133333 34.133333-34.133333h379.733334c19.2 0 34.133333 14.933333 34.133333 34.133333v-42.666666z" fill="#DAEDF7" p-id="1495"></path><path d="M755.2 618.666667m-96 0a96 96 0 1 0 192 0 96 96 0 1 0-192 0Z" fill="#FFFFFF" p-id="1496"></path><path d="M755.2 618.666667m-34.133333 0a34.133333 34.133333 0 1 0 68.266666 0 34.133333 34.133333 0 1 0-68.266666 0Z" fill="#FF6242" p-id="1497"></path><path d="M462.933333 618.666667m-87.466666 0a87.466667 87.466667 0 1 0 174.933333 0 87.466667 87.466667 0 1 0-174.933333 0Z" fill="#FFFFFF" p-id="1498"></path><path d="M462.933333 618.666667m-34.133333 0a34.133333 34.133333 0 1 0 68.266667 0 34.133333 34.133333 0 1 0-68.266667 0Z" fill="#6DD627" p-id="1499"></path><path d="M426.666667 842.666667m-8.533334 0a8.533333 8.533333 0 1 0 17.066667 0 8.533333 8.533333 0 1 0-17.066667 0Z" fill="#C0DCEB" p-id="1500"></path><path d="M426.666667 834.133333c-4.266667 0-8.533333 4.266667-8.533334 8.533334s4.266667 8.533333 8.533334 8.533333 8.533333-4.266667 8.533333-8.533333-2.133333-8.533333-8.533333-8.533334z" fill="#45413C" p-id="1501"></path><path d="M791.466667 842.666667m-8.533334 0a8.533333 8.533333 0 1 0 17.066667 0 8.533333 8.533333 0 1 0-17.066667 0Z" fill="#C0DCEB" p-id="1502"></path><path d="M791.466667 834.133333c-4.266667 0-8.533333 4.266667-8.533334 8.533334s4.266667 8.533333 8.533334 8.533333 8.533333-4.266667 8.533333-8.533333-4.266667-8.533333-8.533333-8.533334z" fill="#45413C" p-id="1503"></path><path d="M800 55.466667m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" fill="#FF6242" p-id="1504"></path><path d="M919.466667 652.8v42.666667c42.666667 0 78.933333 32 85.333333 72.533333 0-4.266667 2.133333-8.533333 2.133333-12.8v-17.066667c0-46.933333-38.4-85.333333-87.466666-85.333333z" fill="#FFAA54" p-id="1505"></path><path d="M29.866667 714.666667c0 32 17.066667 64 49.066666 85.333333l17.066667 10.666667c29.866667 19.2 64 21.333333 91.733333 12.8l6.4-6.4-160-104.533334c-4.266667 0-4.266667 0-4.266666 2.133334z" fill="#FFAA54" p-id="1506"></path></svg>
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