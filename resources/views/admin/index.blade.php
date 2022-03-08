@extends("layouts.admin")
@section("title", "Home")
@section("content")

<div class="overflow-auto h-screen pb-24 px-4 md:px-6">
    <h1 class="text-4xl font-semibold text-gray-800 dark:text-white">
        Hello, {{ auth()->user()->name }}
    </h1>
    <h2 class="text-md text-gray-400">
        This is the administration panel.
        Use the navigation panel on the left to configure your application.
    </h2>
    <div class="flex my-6 items-center w-full space-y-4 md:space-x-4 md:space-y-0 flex-col md:flex-row">
        <div class="w-full md:w-6/12">
            <div class="shadow-lg w-full bg-white dark:bg-gray-700 relative overflow-hidden" x-data="getGoal()">
                <a href="#" class="w-full h-full block">
                    <div class="flex items-center justify-between px-4 py-6 space-x-4">
                        <div class="flex items-center">
                            <span class="rounded-full relative p-5 bg-yellow-100">
                                <svg width="40" fill="currentColor" height="40" class="text-yellow-500 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1362 1185q0 153-99.5 263.5t-258.5 136.5v175q0 14-9 23t-23 9h-135q-13 0-22.5-9.5t-9.5-22.5v-175q-66-9-127.5-31t-101.5-44.5-74-48-46.5-37.5-17.5-18q-17-21-2-41l103-135q7-10 23-12 15-2 24 9l2 2q113 99 243 125 37 8 74 8 81 0 142.5-43t61.5-122q0-28-15-53t-33.5-42-58.5-37.5-66-32-80-32.5q-39-16-61.5-25t-61.5-26.5-62.5-31-56.5-35.5-53.5-42.5-43.5-49-35.5-58-21-66.5-8.5-78q0-138 98-242t255-134v-180q0-13 9.5-22.5t22.5-9.5h135q14 0 23 9t9 23v176q57 6 110.5 23t87 33.5 63.5 37.5 39 29 15 14q17 18 5 38l-81 146q-8 15-23 16-14 3-27-7-3-3-14.5-12t-39-26.5-58.5-32-74.5-26-85.5-11.5q-95 0-155 43t-60 111q0 26 8.5 48t29.5 41.5 39.5 33 56 31 60.5 27 70 27.5q53 20 81 31.5t76 35 75.5 42.5 62 50 53 63.5 31.5 76.5 13 94z">
                                    </path>
                                </svg>
                            </span>
                            <p class="text-sm text-gray-700 dark:text-white ml-2 font-semibold border-b border-gray-200">
                                Monthly Donation Goal
                            </p>
                        </div>
                        <div class="border-b border-gray-200 mt-6 md:mt-0 text-black dark:text-white font-bold text-xl">
                            ${{ $donateCur }}
                            <span class="text-xs text-gray-400">
                                /${{ $donateGoal }}
                            </span>
                        </div>
                    </div>
                    <div class="w-full h-3 bg-gray-100">
                        <div x-data="{ width: '{{ $goalProgress }}' }" x-init="$watch('width', value => { if (value > 100) { width = 100 } if (value == 0) { width = 10 } })">
                            <div class="bg-gray-900 h-full" role="progressbar" :aria-valuenow="width"aria-valuemin="0"aria-valuemax="100">
                                <div class="h-full text-center text-xs text-white bg-green-400 transition":style="`width: ${width}%; transition: width 2s;`" x-text="`${width}%`"0>
                                </div>
                            </div>
                            <!-- End Regular with text version -->
                        </div>
                        <!--<div class="w-2/5 h-full text-center text-xs text-white bg-green-400">
                        </div>-->
                    </div>
                </a>
            </div>
        </div>
        <div class="flex items-center w-full md:w-1/2 space-x-4">
            <div class="w-1/2">
                <div class="shadow-lg px-4 py-6 w-full bg-white dark:bg-gray-700 relative">
                    <p class="text-2xl text-black dark:text-white font-bold">
                        {{ $usersCount }}
                    </p>
                    <p class="text-gray-400 text-sm">
                        Registered Users
                    </p>
                    <span class="rounded-full absolute p-4 bg-purple-500 top-2 right-4">
                      <svg width="40" fill="currentColor" height="40" class="text-white h-4 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                      </svg>
                  </span>
                </div>
            </div>
            <div class="w-1/2">
                <div class="shadow-lg px-4 py-6 w-full bg-white dark:bg-gray-700 relative">
                    <p class="text-2xl text-black dark:text-white font-bold">
                        {{ $serversCount }}
                    </p>
                    <p class="text-gray-400 text-sm">
                        Servers
                    </p>
                    <span class="rounded-full absolute p-4 bg-purple-500 top-2 right-4">
                        <svg width="40" fill="currentColor" height="40" class="text-white h-4 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path d="M15.684,16.959L10.879,8.52c0.886-0.343,1.517-1.193,1.517-2.186c0-1.296-1.076-2.323-2.396-2.323S7.604,5.037,7.604,6.333c0,0.993,0.63,1.843,1.517,2.186l-4.818,8.439c-0.189,0.311,0.038,0.708,0.412,0.708h10.558C15.645,17.667,15.871,17.27,15.684,16.959 M8.562,6.333c0-0.778,0.645-1.382,1.438-1.382s1.438,0.604,1.438,1.382c0,0.779-0.645,1.412-1.438,1.412S8.562,7.113,8.562,6.333 M5.55,16.726L10,8.91l4.435,7.815H5.55z M15.285,9.62c1.26-2.046,1.26-4.525,0-6.572c-0.138-0.223-0.064-0.512,0.162-0.646c0.227-0.134,0.521-0.063,0.658,0.16c1.443,2.346,1.443,5.2,0,7.546c-0.236,0.382-0.641,0.17-0.658,0.159C15.221,10.131,15.147,9.842,15.285,9.62 M13.395,8.008c0.475-1.063,0.475-2.286,0-3.349c-0.106-0.238,0.004-0.515,0.246-0.62c0.242-0.104,0.525,0.004,0.632,0.242c0.583,1.305,0.583,2.801,0,4.106c-0.214,0.479-0.747,0.192-0.632,0.242C13.398,8.523,13.288,8.247,13.395,8.008 M3.895,10.107c-1.444-2.346-1.444-5.2,0-7.546c0.137-0.223,0.431-0.294,0.658-0.16c0.226,0.135,0.299,0.424,0.162,0.646c-1.26,2.047-1.26,4.525,0,6.572c0.137,0.223,0.064,0.512-0.162,0.646C4.535,10.277,4.131,10.489,3.895,10.107 M5.728,8.387c-0.583-1.305-0.583-2.801,0-4.106c0.106-0.238,0.39-0.346,0.631-0.242c0.242,0.105,0.353,0.382,0.247,0.62c-0.475,1.063-0.475,2.286,0,3.349c0.106,0.238-0.004,0.515-0.247,0.62c-0.062,0.027-0.128,0.04-0.192,0.04C5.982,8.668,5.807,8.563,5.728,8.387"></path>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-4">

    </div>
</div>

@endsection