@extends("layouts.admin")
@section("title", "Servers")
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
        <div class="flex flex-col m-2 rounded shadow-xl bg-white dark:bg-gray-700 dark:text-white text-black w-full p-4">
            <h1 class="text-xl font-semibold text-gray-500">
                Create New Server
            </h1>
            
            <div class="mt-5">
                <form action="{{ route('admin.servers.store') }}" method="post" id="create-role">
                    @csrf
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 dark:text-white py-2">BattleMetrics ID <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent rounded-lg h-10 px-4" required="required" type="text" id="bm_id" name="bm_id" value="{{old('bm_id')}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                        <button class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Create Server</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex flex-col col-span-2 m-2 rounded shadow-xl bg-white dark:bg-gray-700 dark:text-white text-black w-full p-4">
            <h1 class="text-xl font-semibold text-gray-500 mb-2">
                Manage Servers
            </h1>
            @foreach($details as $server)
            <div class="flex items-center relative p-2 w-full bg-white dark:bg-gray-600 rounded-lg overflow-hidden shadow hover:shadow-md border-solid border-2 border-sky-500 mb-2 flow-root">
                <div class="ml-3 my-auto float-left">
                    <p class="font-medium text-black dark:text-white">{{ $server['data']['attributes']['name'] }}</p>
                </div>
                <div class="float-right">

                    <form action="{{ route('admin.servers.destroy', $server['data']['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-700 dark:text-white hover:text-red-500 dark:hover:text-red-500 flex my-2 transition-colors duration-200 float-right">
                            <span class="text-right">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection