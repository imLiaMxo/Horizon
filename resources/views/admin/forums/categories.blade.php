@extends("layouts.admin")
@section("title", "Manage Categories")
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
        <div class="flex flex-col bg-white shadow-lg rounded p-4">
            <h1 class="text-xl font-semibold text-gray-500">
                Create New Category
            </h1>
            
            <div class="mt-5">
                <form action="{{ route('admin.categories.store') }}" method="post" id="create-role">
                    @csrf
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Category Name <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" id="name" name="name" value="{{old('name')}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Category Description</label> <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" id="description" name="description" value="{{old('description')}}">
                            <p class="text-yellow text-xs hidden">Optional field</p>
                        </div>
                    <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                        <button class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex flex-col bg-white shadow-lg rounded p-4">
            <h1 class="text-xl font-semibold text-gray-500">
                Delete Categories
            </h1>
            
            <div class="mt-5">
            @foreach($categories as $cat)
            <!-- start -->
            <div x-data="{ 'delete{{$cat->name}}': false}">
                <div class="flex items-center relative p-2 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md border-solid border-2 border-sky-500 mb-2 flow-root">
                    <div class="ml-3 float-left">
                        <p class="font-medium text-black">{{ $cat->name }}</p>
                    </div>
                    <div class="float-right">
                        <button type="button" class="text-gray-600 flex my-2 transition-colors duration-200 float-right hover:text-red-500" x-on:click="delete{{ $cat->name }} = true;">
                            <span class="text-right">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="delete{{$cat->name}}">
                    <div
                        class="max-w-1/4 px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                        x-on:click.away="delete{{$cat->name}} = false;"
                        x-transition:enter="motion-safe:ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        >
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-indigo-600">
                                Delete {{ $cat->name }}
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" x-on:click="delete{{ $cat->name }} = false;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <div class="p-6 space-y-6">
                            Are you sure you want to delete this category?
                            You won't be able to recover it later.
                            <!-- Delete Form -->
                            <form action="{{route('admin.categories.destroy', $cat->id)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>

@endsection