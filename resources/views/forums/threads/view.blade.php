@extends("layouts.app")
@section("title", "Viewing Thread " . $thread->title)
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="thread">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">{{ $thread->title }}</h2>
            </div>
                    <!-- Breadcrumbs -->
            <div class="dark:bg-gray-700 transition-colors transition p-4 mt-3 mb-3 flex items-center flex-wrap rounded shadow-xl text-black dark:text-white">
                <ul class="flex items-center">
                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.index') }}">
                            <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
                        </a>
                        <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
                    </li>

                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.index') }}">
                            Forums
                        </a>
                        <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
                    </li>
                    @foreach($thread->board->breadcrumbs as $breadcrumb)
                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.boards.show', $breadcrumb->id) }}">
                            {{ $breadcrumb->name }}
                        </a>
                        <svg class="w-5 h-auto fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
                    </li>
                    @endforeach

                    <li class="inline-flex items-center">
                        <a href="{{ route('forums.threads.show', $thread->id) }}">
                            <b>{{ $thread->title }}</b>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End -->

            <!-- Content -->
            <div class="bg-white dark:bg-gray-700 dark:text-white w-full rounded shadow-xl overflow-hidden p-1 mt-5 transition-500">
                <div class="grid grid-cols-5 gap-3 h-full">
                    <div class="col-span-1 w-full text-center border-r-2">
                        <div class="p-4 mt-4">
                            <img src="{{ $thread->user->avatar }}" class="relative rounded-lg bg-white border h-20 w-20 mx-auto my-auto"/>
                        </div>
                        <div class="p-2">
                            <span class="text-2xl">{{ $thread->user->name }}</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full p-4 mt-4">
                            {!! $thread->content !!}
                        </div>
                    </div>
                </div>
                <div class="p-2 ml-2">
                    <i class="fa fa-clock"></i> {{ $thread->created_at->diffForHumans() }}
                </div>
            </div>

            <!-- Replies -->
                @foreach($posts as $post)

                <div class="w-full h-full grid bg-white dark:bg-gray-700 mt-5 rounded grid-cols-1 md:grid-cols-[200px,minmax(900px,1fr)]">
                    <aside class="relative isolate overflow-hidden flex flex-col items-center break-words w-full h-full md:min-h-[22rem] p-4 space-y-2 motion-safe:transition">
                        <img class="absolute inset-0 w-full h-full object-cover object-center max-h-[18rem] opacity-50" src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" />
                        <!-- dark mode gradient -->
                        <div class="hidden dark:block absolute z-10 inset-0 w-full h-full max-h-[18rem] bg-gradient-to-b from-transparent to-gray-700"></div>
                        <div class="hidden dark:block absolute z-10 inset-0 w-full h-full max-h-[18rem] bg-gradient-to-b from-transparent to-gray-700"></div>

                        <!-- light mode gradient -->
                        <div class="dark:hidden absolute z-10 inset-0 w-full h-full max-h-[18rem] bg-gradient-to-b from-transparent to-white"></div>
                        <div class="dark:hidden absolute z-10 inset-0 w-full h-full max-h-[18rem]-gradient-to-b from-transparent to-white"></div>

                        <div class="z-40 relative text-center">
                            <a href="#" class="h4 text-gray-900 dark:text-white">
                                {{ $post->user->name }}
                            </a>
                            <p id="user-title" class="text-xs text-gray-600 dark:text-white"></p>
                        </div>

                        <div class="z-40 relative w-24 h-24"></div>

                        <p id="role" class="z-40 relative text-sm text-gray-300 rounded-full px-2 border border-gray-100 dark:border-gray-600">
                            <!-- Role -->
                        </p>
                    </aside>

                    <article class="flex flex-col">
                        <header class="flex items-center text-neutral-300 text-xs md:text-sm py-2 p-4">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="7.25" stroke="currentColor" stroke-width="1.5"></circle>
                                <path stroke="currentColor" stroke-width="1.5" d="M12 8V12L14 14"></path>
                            </svg>
                            <p class="ml-1">
                                4 months ago
                            </p>

                            <a class="ml-auto" href="#{{ $post->id }}" id="{{ $post->id }}">
                                # {{ $post->id }}
                            </a>
                        </header>
                        <div class="prose prose-neutral dark:prose-invert break-words whitespace-normal max-w-none p-4 flex-grow">
                            {!! $post->content !!}
                        </div>
                    </article>

                    <footer class="p-4 flex col-span-full border-t border-neutral-100 dark:border-neutral-600 text-sm" likes="likes">

                    </footer>
                </div>

                <!-- Content -->
                
                @endforeach

                {{ $posts->links() }}

            <!-- Add Reply -->
            <div class="bg-white dark:bg-gray-700 w-full rounded shadow-xl overflow-hidden p-2 mt-5 transition-500">
                    <div class="w-full max-w-6xl mx-auto rounded-xl bg-white dark:bg-gray-700 shadow-lg p-5 text-white" x-data="app()" x-init="init($refs.wysiwyg)">
                        <div class="border border-gray-200 overflow-hidden rounded-md">
                            <div class="w-full flex border-b border-gray-200 text-xl text-white">
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('bold')">
                                    <i class="mdi mdi-format-bold"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('italic')">
                                    <i class="mdi mdi-format-italic"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('underline')">
                                    <i class="mdi mdi-format-underline"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','P')">
                                    <i class="mdi mdi-format-paragraph"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H1')">
                                    <i class="mdi mdi-format-header-1"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H2')">
                                    <i class="mdi mdi-format-header-2"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H3')">
                                    <i class="mdi mdi-format-header-3"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('insertUnorderedList')">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('insertOrderedList')">
                                    <i class="mdi mdi-format-list-numbered"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyLeft')">
                                    <i class="mdi mdi-format-align-left"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyCenter')">
                                    <i class="mdi mdi-format-align-center"></i>
                                </button>
                                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyRight')">
                                    <i class="mdi mdi-format-align-right"></i>
                                </button>
                            </div>
                            <div class="w-full">
                                <iframe x-ref="wysiwyg" class="w-full h-96 overflow-y-auto"></iframe>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function app() {
        return {
            wysiwyg: null,
            init: function(el) {
                // Get el
                this.wysiwyg = el;
                // Add CSS
                this.wysiwyg.contentDocument.querySelector('head').innerHTML += `<style>
                *, ::after, ::before {box-sizing: border-box;}
                :root {tab-size: 4;}
                html {line-height: 1.15;text-size-adjust: 100%;}
                body {margin: 0px; padding: 1rem 0.5rem; color:white;}
                body {font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";}
                </style>`;
                this.wysiwyg.contentDocument.body.innerHTML += `
                <h1>Hello World!</h1>
                <p>Welcome to the pure AlpineJS and Tailwind WYSIWYG.</p>
                `;
                // Make editable
                this.wysiwyg.contentDocument.designMode = "on";
            },
            format: function(cmd, param) {
                this.wysiwyg.contentDocument.execCommand(cmd, !1, param||null)
            }
        }
    }
</script>
@endsection