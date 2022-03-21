@extends("layouts.admin")
@section("title", "Roles")
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
                Create New Role
            </h1>
            
            <div class="mt-5">
                <form action="{{ route('admin.roles.create') }}" method="post" id="create-role">
                    @csrf
                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 dark:text-white py-2">Role Name <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent rounded-lg h-10 px-4" required="required" type="text" id="name"
                            placeholder="administrator" name="name" value="{{old('name')}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 dark:text-white py-2">Display Name <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent rounded-lg h-10 px-4" required="required" type="text" placeholder="Administrator" name="display_name" value="{{old('display_name')}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    </div>
                    <div class="mb-3 space-y-2 w-full text-xs">
                        <label class="font-semibold text-gray-500 dark:text-white py-2">Display Colour <abbr title="required">*</abbr></label>
                        <input class="appearance-none block w-full text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent rounded-lg h-10 px-4" required="required" type="text" id="color" name="color" value="{{old('color', '#673AB7')}}">
                    </div>
                    <div class="mb-3 space-y-2 w-full text-xs">
                        <label class="font-semibold text-gray-500 dark:text-white py-2">Role Precedence <abbr title="required">*</abbr></label>
                        <input class="appearance-none block w-full text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent rounded-lg h-10 px-4" required="required" type="number" id="precedence" name="precedence" value="{{old('precedence', 5)}}">
                    </div>

                    @foreach($permissions as $permission)
                    <div class="mb-3 space-y-2 w-full text-xs">
                        <input 
                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="checkbox"
                        value="{{ $permission->name }}"
                        id="check-{{ $permission->id }}"
                        name="permissions[]">
                        <label for="check-{{ $permission->id }}" class="font-semibold text-gray-500 dark:text-white py-2">{{ $permission->display_name}} <abbr title="required">*</abbr></label>
                    </div>
                    @endforeach
                    <p class="text-xs text-red-500 text-right my-3">Required fields are marked with an
                        asterisk <abbr title="Required field">*</abbr>
                    </p>
                    <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                        <button class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Create Role</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col">
            @foreach($roles as $role)
            <!-- start -->
            <div x-data="{ 'edit{{$role->name}}': false, 'delete{{$role->name}}': false}">
                <div class="flex items-center relative p-2 w-full bg-white dark:bg-gray-200 rounded-lg overflow-hidden shadow hover:shadow-md border-solid border-2 border-sky-500 m-2 flow-root">
                    <div class="ml-3 float-left">
                        <p class="font-medium text-[{{$role->color}}]">{{ $role->display_name }}</p>
                        <p class="text-sm text-gray-600">{{ $role->precedence }}</p>
                    </div>
                    <div class="float-right">
                        <button type="button" class="text-gray-600 flex my-2 transition-colors duration-200 float-right hover:text-indigo-500" x-on:click="edit{{ $role->name }} = true;">
                            <span class="text-right">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
                                </svg>
                            </span>
                        </button>
                        @if($role->deletable)
                        <button type="button" class="text-gray-600 flex my-2 transition-colors duration-200 float-right hover:text-red-500" x-on:click="delete{{ $role->name }} = true;">
                            <span class="text-right">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                </svg>
                            </span>
                        </button>
                        @endif
                    </div>
                </div>
                <!-- EDIT MODAL -->
                <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-opacity-50" x-show="edit{{$role->name}}">
                    <div
                        class="max-w-3xl px-6 py-4 mx-auto text-left bg-white dark:bg-gray-200 rounded shadow-lg"
                        x-on:click.away="edit{{$role->name}} = false;"
                        x-transition:enter="motion-safe:ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        >
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl">
                                Editing <span class="text-[{{$role->color}}]">{{ $role->display_name }}</span>
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" x-on:click="edit{{ $role->name }} = false;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <!-- Update Form -->
                            <form id="form-{{$role->id}}" action="{{ route('admin.roles.update', $role->id) }}" method="post">
                              @csrf
                              @method('PATCH')

                              <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-500 py-2">Role Name <abbr title="required">*</abbr></label>
                                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" id="name"
                                    placeholder="administrator" name="name" value="{{$role->name}}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-500 py-2">Display Name <abbr title="required">*</abbr></label>
                                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" placeholder="Administrator" name="display_name" value="{{$role->display_name}}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>
                            <div class="mb-3 space-y-2 w-full text-xs">
                                <label class="font-semibold text-gray-500 py-2">Display Colour <abbr title="required">*</abbr></label>
                                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" id="color" name="color" value="{{$role->color}}">
                            </div>
                            <div class="mb-3 space-y-2 w-full text-xs">
                                <label class="font-semibold text-gray-500 py-2">Role Precedence <abbr title="required">*</abbr></label>
                                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="number" id="precedence" name="precedence" value="{{$role->precedence}}">
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Role</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- EDIT MODAL -->

                <!-- DELETE MODAL -->
                <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="delete{{$role->name}}">
                    <div
                        class="max-w-1/4 px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                        x-on:click.away="delete{{$role->name}} = false;"
                        x-transition:enter="motion-safe:ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        >
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl">
                                Delete <span class="text-[{{$role->color}}]">{{ $role->display_name }}</span>
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600" x-on:click="delete{{ $role->name }} = false;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <div class="p-6 space-y-6">
                            Are you sure you want to delete this role?
                            You won't be able to recover it later.
                            <!-- Delete Form -->
                            <form action="{{route('admin.roles.destroy', $role->id)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- DELETE MODAL -->
            </div>
            <!-- end -->
            @endforeach
        </div>
    </div>
</div>
@endsection