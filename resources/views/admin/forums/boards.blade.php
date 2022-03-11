@extends("layouts.admin")
@section("title", "Manage Boards")
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
                Create New Board
            </h1>
            
            <div class="mt-5">
                <form action="{{ route('admin.boards.store') }}" method="post" id="create-board">
                    @csrf
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Board Name <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" id="name" name="name" value="{{old('name')}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Board Description</label></label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" id="description" name="description" value="{{old('description')}}">
                            <p class="text-yellow text-xs hidden">Optional field</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Board Icon</label> <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" id="icon" name="icon" value="{{old('icon') ?? 'fad fa-server'}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Board Colour</label> <abbr title="required">*</abbr></label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" id="color" placeholder="#3F51B5" name="color" value="{{old('color') ?? '#3F51B5'}}">
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Category</label> <abbr title="required">*</abbr></label>
                            <select id="category" name="category" class="flex-1 py-2 rounded text-gray-600 dark:bg-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent outline-none">
                                @foreach($categories as $category)
                                    <option>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-500 py-2">Allowed Roles</label> <abbr title="required">*</abbr></label>
                            @foreach($roles as $role)
                                <div class="mb-1 space-y-1 w-full">
                                    <input
                                        type="checkbox"
                                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        value="{{$role->name}}"
                                        id="check-{{$role->id}}"
                                        name="roles[]"
                                        checked/>
                                    <label class="font-semibold text-gray-600 py-2" for="check-{{ $role->name }}">{{ $role->display_name }} ({{ $role->name }})</label>
                                </div>
                                @endforeach
                            <p class="text-red text-xs hidden">Please fill out this field.</p>
                        </div>
                    <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                        <button class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Create Board</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex flex-col col-span-3 bg-white w-full shadow-lg rounded p-4">
            <h1 class="text-xl font-semibold text-gray-500">
                Manage Boards
            </h1>

            @if($boards->has(''))
                @foreach($categories as $cat)
                <h5 class="p-2 mb-2 dark:text-white text-black">{{$cat->name}}</h5>
                <div id="nested-{{$cat->id}}" class="row">
                    <div id="nested-list-{{$cat->id}}" class="list-group col nested-sortable">
                        @include('includes.admin.boards.sortable', ['boardsCol' => $boards->get('', [])])
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

    <script>
        $(document).ready(function() {
            var sortables = [].slice.call(document.querySelectorAll('.nested-sortable-1'));

            for (var i = 0; i < sortables.length; i++) {
                $(sortables[i]).sortable({
                    group: 'nested-4',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.1,
                    onEnd: function (sortable) {
                        const newParent = sortable.item.parentElement.parentElement;
                        const oldParent = sortable.target.parentElement;
                        const item = sortable.item;
                        if (typeof (item) === 'undefined' || !item.dataset.id) return;

                        let boardId = item.dataset.id;
                        if (!boardId) return;

                        if (newParent && oldParent && newParent.dataset['id'] === oldParent.dataset['id']) return;

                        Axios.patch('{{ route('admin.boards.sort') }}', {
                            boardId,
                            parentId: newParent.dataset['id']
                        }).then(function () {
                            location.reload();
                        }).catch(function () {
                            toastr.error('An error occurred while trying to sort the boards.');
                        });
                    }
                })
            }
        });
    </script>
@endsection