@extends("layouts.app")
@section("title", "Donate")
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="serverList">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">Donations</h2>
            </div>
            <div class="grid grid-cols-5 gap-3 mt-5">
                <div class="col-span-4 flex justify-left items-left">
                    <div class="w-3/4 bg-gray-200 dark:bg-gray-700 rounded h-full">
                        <form action="{{ route('donate.post') }}" method="post">
                            @CSRF
                            <div class="flex items-center mb-5 py-5 w-1/2">
                                <label for="amount" class="inline-block w-20 mt-5 mr-6 text-right font-bold text-black dark:text-white">Amount:</label>
                                <input type="number" id="amount" name="amount" class="flex-1 mt-5 mr-4 py-2 rounded text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent outline-none" required="" placeholder="0.00"/>
                            </div>
                            <input type="hidden" name="steamid" id="steamid" value="{{ auth()->check() ? auth()->user()->steamid : ''}}"/>
                            <input type="submit" name="submit" value="Donate with PayPal" class="bg-blue-700 text-white p-2 py-3 rounded-md mb-8 font-bold ml-3 hover:bg-blue-600">
                        </input>
                        </form>
                    </div>
                </div>
                <div class="col-1">
                    <div class="w-full mx-auto">
                        <div class="text-center">
                            <h2 class="text-2xl tracking-tight font-extrabold text-black dark:text-white sm:text-xl">Recent Donors</h2>
                        </div>
                    </div>
                    @forelse($recents as $user)
                    <div class="p-2 mt-2 rounded-full bg-neutral-100 dark:bg-neutral-700 flex w-auto max-w-sm mx-auto items-center justify-between text-neutral-600 dark:text-neutral-200 text-sm">
                        <div class="flex items-center">
                            <img class="object-cover select-none pointer-events-none rounded-full inline w-8 h-8" src="{{ $user->avatar }}">
            
                            <p class="ml-2 inline">
                                <a href="#" target="_blank">{{ $user->name }}</a> donated!
                            </p>
                        </div>
            
                        <p class="ml-auto flex items-center">
                            <svg class="inline w-4 text-primary-500 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="7.25" stroke="currentColor" stroke-width="1.5"></circle>
                                <path stroke="currentColor" stroke-width="1.5" d="M12 8V12L14 14"></path>
                             </svg>
                             {{ $user->updated_at->diffForHumans() }}
                        </p>
                    </div>
                    <!--
                        <a href="#" class="w-full flex p-3 mt-2 pl-4 items-center bg-gray-200 dark:bg-indigo-500 hover:bg-gray-300 dark:hover:bg-indigo-700 rounded-lg cursor-pointer">
                            <div class="mr-4">
                                <div class="h-9 w-9 rounded-sm flex items-center justify-center text-3xl" >
                                    <img class="rounded-full relative" src=" "/>
                                </div>
                            </div>
                            <div class="font-bold text-lg dark:text-white text-black"> </div>
                        </a>
                    -->
                    @empty
                        No Recent Donors
                    @endforelse
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection