@props(['configuration'])

<div class="flex items-center mb-5 py-5">
    <input type="file" class="flex-1 py-2 rounded text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent border border-solid border-gray-300 transition ease-in-out focus:border-blue-600 focus:outline-none" id="{{ $configuration->key }}" value="{{ $configuration->value }}" name="{{ $configuration->key }}">
</div>