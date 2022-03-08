@extends('layouts.app')
@section('title', 'Application')
@section('content')

@include('includes.navbar')

<section class="flex-grow transition-colors transition duration-500" id="serverList">
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                @if($application->current_step < 2)
                    <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">Application Status</h2>
                    <p class="mt- max-w-2xl mx-auto text-xl text-black dark:text-white sm:mt-4">
                        See updates regarding your application.
                    </p>
                @else
                    @if($application->outcome)
                        <h2 class="text-3xl tracking-tight font-extrabold text-green-500 sm:text-4xl">Application Success</h2>
                        <p class="mt- max-w-2xl mx-auto text-xl text-black dark:text-white sm:mt-4">
                            Your application has been successful!
                        </p>
                    @else
                        <h2 class="text-3xl tracking-tight font-extrabold text-red-500 sm:text-4xl">Application Declined</h2>
                        <p class="mt- max-w-2xl mx-auto text-xl text-black dark:text-white sm:mt-4">
                            {{ $application->reason ? "You were not successful with this application: " . $application->reason : "You were not successful with this application.<br>Reason: None Given"}}
                        </p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>

<div class="px-4 py-2 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-2">
  <div class="grid max-w-2xl mx-auto">
    <div class="flex">
      <div class="flex flex-col items-center mr-6">
        <div class="w-px h-10 opacity-0 sm:h-full"></div>
        <div>
          <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border bg-indigo-700 text-white rounded-full">
            1
          </div>
        </div>
        <div class="w-px h-full bg-gray-300"></div>
      </div>
      <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
        <div class="ml-5">
          <p class="text-xl font-semibold sm:text-base dark:text-white">Send Your Application</p>
          <p class="text-sm text-gray-700 dark:text-white">
            Perfect! You've completed the first step to join us, please be patient whilst a recruiting officer is assigned to your application.
          </p>
        </div>
      </div>
    </div>
    <div class="flex">
      <div class="flex flex-col items-center mr-6">
        <div class="w-px h-10 bg-gray-300 sm:h-full"></div>
        <div>
            @if($application->current_step == 0)
            <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border bg-gray-500 text-white rounded-full">
            @else
            <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border bg-indigo-700 text-white rounded-full">
            @endif
            2
          </div>
        </div>
        <div class="w-px h-full bg-gray-300"></div>
      </div>
      @if($application->current_step == 0)
        <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
            <div class="ml-5 mt-5">
            <p class="text-xl font-semibold sm:text-base dark:text-white">Pending...</p>
            <p class="text-sm text-gray-700 dark:text-white">
                We're currently waiting for a recruitment officer to be assigned to your application, please check back later.
            </p>
            </div>
        </div>
        </div>
    @else
    <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
        <div class="ml-5 mt-5">
          <p class="text-xl font-semibold sm:text-base dark:text-white">Recruitment Officer: {{ $application->assigned }}</p>
          <p class="text-sm text-gray-700 dark:text-white">
            You have been assigned a recruitment officer and they have tried to make contact with you. Please check your steam friend requests if you have not already!
          </p>
        </div>
      </div>
    </div>
    @endif
    <div class="flex">
      <div class="flex flex-col items-center mr-6">
        <div class="w-px h-10 bg-gray-300 sm:h-full"></div>
        <div>
            @if ($application->current_step < 2)
            <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border bg-gray-500 text-white rounded-full">
            @else
            <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border bg-indigo-700 text-white rounded-full">
            @endif
            3
          </div>
        </div>
        <div class="w-px h-full opacity-0"></div>
      </div>
      @if ($application->current_step < 2)
      <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
        <div class="ml-5 mt-5">
          <p class="text-xl font-semibold sm:text-base dark:text-white">Outcome</p>
          <p class="text-sm text-gray-700 dark:text-white">
            The outcome of your application will be decided by your assigned recruitment officer. The process length is dependent on the availability of said officer and yourself.
          </p>
        </div>
      </div>
      @else
      <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
        <div class="ml-5 mt-5">
          <p class="text-xl font-semibold sm:text-base dark:text-white">Outcome</p>
          <p class="text-sm text-gray-700 dark:text-white">
            You have been in contact with your assigned recruitment officer and they are going through the rest of the process with you.
          </p>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

@endsection