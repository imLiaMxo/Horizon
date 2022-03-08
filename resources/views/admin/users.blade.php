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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
        @foreach($users as $user)
        <!-- start -->
        <div class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md border-solid border-2 border-sky-500 flow-root">
            <div class="w-12 h-12 rounded-full bg-gray-100 float-left">
                <img class="rounded-full" src="{{ $user->avatar }}" />
            </div>
            <div class="ml-3 float-left">
                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-600">{{ $user->steamid }}</p>
            </div>
            <div class="mt-16 mb-3 space-y-2 w-full text-xs">

                
                <form class="mt-5 container" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="{{ $user->id }}"/>
                    @foreach($roles as $role)
                    <div class="mb-3 space-y-2 w-full text-xs">
                        <input
                        type="checkbox"
                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        id="roles-{{ $role->name }}"
                        name="roles[]"
                        value="{{ $role->id }}"
                        {{ $user->hasRole($role->id) ? 'checked=""' : '' }}
                        />
                        <label class="font-semibold text-gray-600 py-2" for="roles-{{ $role->name }}">{{ $role->display_name }} ({{ $role->name }})</label>
                    </div>
                    @endforeach
                    <button type="submit" class="text-gray-600 flex m-1 transition-colors duration-200 float-right hover:text-indigo-500">
                        <span class="text-right">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688"></path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <!-- end -->
        @endforeach
    </div>
    {{ $users->links('pagination::tailwind') }}
</div>

@endsection