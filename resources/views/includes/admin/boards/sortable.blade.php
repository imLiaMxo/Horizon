<div class="list-group nested-sortable-1">
    @foreach($boardsCol->where('category_id', $cat->id) as $board)
        @if(isset($boards[$board->id]))
            <div class="list-group-item" data-id="{{$board->id}}" data-category-id="{{$board->category_id}}">
                <div class="flex items-center relative p-2 w-1/2 bg-white rounded-lg overflow-hidden shadow hover:shadow-md border-solid border-2 border-[{{$board->color}}] mb-2 flow-root">
                    <div class="ml-3 float-left">
                        <p class="font-medium text-black">{{ $board->name }}</p>
                    </div>
                    <div class="float-right">
                        <form action="{{route('admin.boards.destroy', $board->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 flex my-2 transition-colors duration-200 float-right hover:text-red-500">
                                <span class="text-right">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
                @include('includes.admin.boards.sortable', ['boardsCol' => $boards[$board->id]])
            </div>
        @else
            <div class="list-group-item" data-id="{{$board->id}}" data-category-id="{{$board->category_id}}">
                <div class="flex items-center relative p-2 w-1/2 bg-white rounded-lg overflow-hidden shadow hover:shadow-md border-solid border-2 border-[{{$board->color}}] mb-2 flow-root">
                    <div class="ml-3 float-left">
                        <p class="font-medium text-black">{{ $board->name }}</p>
                    </div>
                    <div class="float-right">
                        <form action="{{route('admin.boards.destroy', $board->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 flex my-2 transition-colors duration-200 float-right hover:text-red-500">
                                <span class="text-right">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="list-group nested-sortable-1"></div>
            </div>
        @endif
    @endforeach
</div>
