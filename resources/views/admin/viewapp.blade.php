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

    <div class="font-sans h-screen w-full flex flex-row justify-center items-center">
        <div class="card w-96 mx-auto bg-white dark:bg-gray-700 dark:text-white text-black shadow-xl hover:shadow">
           <img class="w-32 mx-auto rounded-full -mt-20" src="{{ $userData->avatar }}">
           <div class="text-center mt-2 text-3xl font-medium">{{ $userData->name }}</div>
           <div class="text-center mt-2 font-light text-sm">{{ $application->age }} years old</div>
           <div class="text-center font-normal text-lg">{{ $application->country }}</div>
           <div class="px-6 text-center mt-2 text-sm">
                <a class="px-12 py-2 rounded-md text-lg text-center bg-gray-600 text-white border-2 border-gray-700 hover:bg-gray-500 transition ease-in-out" href="https://steamcommunity.com/profiles/{{ $application->steamid }}">Contact on Steam</a>
           </div>
           <hr class="mt-8">
           <div class="flex p-4">
             <div class="w-full text-center">
               @if($application->assigned_to == auth()->user()->steamid && $application->assigned_to && !$application->outcome)
                <form action="{{ route('admin.apply.assign', $application->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="identifier" value="{{ $application->id }}"/>
                    <button type="submit" class="border-2 border-red-600 text-black px-12 py-3 rounded-md text-lg text-center font-medium hover:bg-red-600 transition duration-300 dark:text-white">Unassign</button>
                </form>
                <hr class="mt-3">
                <div class="flex p-4">
                  <div class="w-1/2 text-center">
                    <form action="{{ route('admin.apply.complete', $application->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="identifier" value="{{ $application->id }}"/>
                        <input type="hidden" name="action" value="decline"/>
                        <input type="hidden" name="reason" value="n/a"/>
                        <button type="submit" class="border-2 border-red-600 text-black px-8 py-3 rounded-md text-lg text-center font-medium hover:bg-red-600 transition duration-300 dark:text-white">Decline</button>
                    </form>
                  </div>
                  <div class="w-0 border border-gray-300">
                    <!-- divider -->
                  </div>
                  <div class="w-1/2 text-center">
                    <form action="{{ route('admin.apply.complete', $application->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="identifier" value="{{ $application->id }}"/>
                        <input type="hidden" name="action" value="accept"/>
                        <input type="hidden" name="steamid" value="{{ $application->steamid }}"/>
                        <button type="submit" class="border-2 border-green-600 text-black px-8 py-3 rounded-md text-lg text-center font-medium hover:bg-green-600 transition duration-300 dark:text-white">Accept</button>
                    </form>
                  </div>
                </div>
               @elseif($application->assigned_to != auth()->user()->steamid && $application->assigned_to && !$application->outcome)
                <form action="#" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="identifier" value="{{ $application->id }}"/>
                    <button type="submit" class="border-2 border-red-600 text-black px-12 py-3 rounded-md text-lg text-center font-medium hover:bg-red-600 transition duration-300 dark:text-white">Already Assigned</button>
                </form>
               @else
                @if(!$application->outcome)
                <form action="{{ route('admin.apply.assign', $application->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="identifier" value="{{ $application->id }}"/>
                    <input type="hidden" name="assigner" value="{{ auth()->user()->steamid }}"/>
                    <button type="submit" class="border-2 border-green-600 text-black px-12 py-3 rounded-md text-lg text-center font-medium hover:bg-green-600 transition duration-300 dark:text-white">Assign</button>
                </form>
                @endif
                @endif
                @if($application->outcome && $application->outcome == 1)
                    <div class="text-center font-normal text-lg text-red-600">Failed Application</div>
                @elseif($application->outcome && $application->outcome == 2)
                    <div class="text-center font-normal text-lg text-green-600">Successful Application</div>
                @endif
             </div>
           </div>
        </div>
    </div>
</div>

@endsection