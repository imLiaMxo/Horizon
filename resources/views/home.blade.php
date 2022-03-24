@extends("layouts.app")
@section("title", "Home")
@section("content")

@include("includes.navbar")

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="welcommen">
    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
        <div class="mt-6 flex-col flex shadow-lg justify-between items-center rounded bg-gradient-to-r from-grey-300 to-grey-200 dark:from-gray-700 dark:to-gray-600 dark:to-gray-700  overflow-hidden max-w-7xl p-2 md:flex-row sm:p-6 lg:p-8">
            <div class="flex items-center flex-col md:w-6/12 md:items-start lg:pr-8 py-3 md:py-0">
                <h1 class="flex flex-col items-center text-center text-3xl font-extrabold tracking-tight text-black dark:text-white md:items-start sm:text-4xl">{!! $configs['hero_title']!!}</h1>
                <p class="text-black dark:text-white mt-6 text-center md:text-left md:mr-10">
				{!! $configs['hero_desc']!!}
                </p>
                <div class="mt-6 flex"><a href="{{ route("apply") }}"><button type="button" class="inline-flex items-center mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Join {{$configs['site_name']}}</button></a></div>
            </div>
            <div class="relative">
                <img src="{{ $configs['site_logo'] }}" decoding="async" data-nimg="intrinsic" class="rounded h-64 w-64 hide-overflow z-0">
            </div>
        </div>
    </div>
</section>

<section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500">
	<div class="mx-auto max-w-[1600px] w-full sm:px-6 lg:px-8">
		<div class="max-w-full mx-auto px-2 sm:px-6 lg:px-8">
			<div class="grid md:grid-cols-2 gap-16 mt-12">
				<div class="grid place-content-center gap-16">
					<div class="relative">
						<dt>
							<div
								class="absolute flex items-center justify-center w-10 h-10 text-white rounded-lg bg-orange-500">
								<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 6.75C4.75 5.64543 5.64543 4.75 6.75 4.75H17.25C18.3546 4.75 19.25 5.64543 19.25 6.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V6.75Z"/>
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 8.75V19"/>
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8.25H19"/>
								</svg>
							</div>
							<h4 class="ml-14 dark:text-neutral-100">
								Execellent Playerbase
							</h4>
						</dt>
						<dd class="mt-2 text-base ml-14 text-black dark:text-white">
							Our playerbase is moderated by our top notch game admins who enforce our community rules
						</dd>
					</div>
					<div class="relative">
						<dt>
							<div
								class="absolute flex items-center justify-center w-10 h-10 text-white rounded-lg bg-orange-500">
								<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 14.75V19.25M11.25 19.25H5.78165C5.21714 19.25 4.77296 18.7817 4.88545 18.2285C5.19601 16.7012 6.21027 14 9.49996 14C10.1744 14 10.7532 14.0563 11.25 14.25M19.25 17H14.75M14.75 10.25C16.2687 10.25 17.25 9.01878 17.25 7.5C17.25 5.98122 16.2687 4.75 14.75 4.75M12.25 7.5C12.25 9.01878 11.0187 10.25 9.49996 10.25C7.98118 10.25 6.74996 9.01878 6.74996 7.5C6.74996 5.98122 7.98118 4.75 9.49996 4.75C11.0187 4.75 12.25 5.98122 12.25 7.5Z"/>
								</svg>
							</div>
							<h4 class="ml-14 dark:text-neutral-100">
								Always Accepting
							</h4>
						</dt>
						<dd class="mt-2 text-base ml-14 text-black dark:text-white">
							We"re always accepting new recruits!
						</dd>
					</div>
					<div class="relative">
						<dt>
							<div
								class="absolute flex items-center justify-center w-10 h-10 text-white rounded-lg bg-orange-500">
								<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 7.75H4.75M5.75 7.75V17.25C5.75 18.3546 6.64543 19.25 7.75 19.25H16.25C17.3546 19.25 18.25 18.3546 18.25 17.25V7.75H5.75Z"/>
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 12.25V4.75"/>
								</svg>
							</div>
							<h4 class="ml-14 dark:text-neutral-100">
								Safe Zone
							</h4>
						</dt>
						<dd class="mt-2 text-base ml-14 text-black dark:text-white">
							Our no discrimination rules are in effect to keep everyone safe from bullying!
						</dd>
					</div>
					<div class="relative">
						<dt>
							<div
								class="absolute flex items-center justify-center w-10 h-10 text-white rounded-lg bg-orange-500">
								<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M7 2a1 1 0 011 1v1h3a1 1 0 110 2H9.578a18.87 18.87 0 01-1.724 4.78c.29.354.596.696.914 1.026a1 1 0 11-1.44 1.389c-.188-.196-.373-.396-.554-.6a19.098 19.098 0 01-3.107 3.567 1 1 0 01-1.334-1.49 17.087 17.087 0 003.13-3.733 18.992 18.992 0 01-1.487-2.494 1 1 0 111.79-.89c.234.47.489.928.764 1.372.417-.934.752-1.913.997-2.927H3a1 1 0 110-2h3V3a1 1 0 011-1zm6 6a1 1 0 01.894.553l2.991 5.982a.869.869 0 01.02.037l.99 1.98a1 1 0 11-1.79.895L15.383 16h-4.764l-.724 1.447a1 1 0 11-1.788-.894l.99-1.98.019-.038 2.99-5.982A1 1 0 0113 8zm-1.382 6h2.764L13 11.236 11.618 14z" clip-rule="evenodd" />
								</svg>
							</div>
							<h4 class="ml-14 dark:text-neutral-100">
								Mr World Wide
							</h4>
						</dt>
						<dd class="mt-2 text-base ml-14 text-black dark:text-white">
							Just like Pitbull, we are global. Meaning we have members from all over the globe!
						</dd>
					</div>
				</div>
				<div class="grid place-content-center">
					<img
						class="block relative rounded overflow-hidden object-cover -rotate-6 shadow-xl object-center border border-neutral-100 grayscale  dark:border-neutral-600"
						src="{{ asset('img/postscriptum.png') }}" alt="test" width="720" height="480">
				</div>
			</div>
		</div>
	</div>
</section>

@endsection