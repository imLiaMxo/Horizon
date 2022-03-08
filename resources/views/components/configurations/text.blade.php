@props(['configuration'])

<div class="flex items-center mb-5 py-5">
    <input type="text" class="flex-1 py-2 rounded text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent outline-none" id="{{ $configuration->key }}" value="{{ $configuration->value }}"
           placeholder="{{ $configuration->display_name }}" name="{{ $configuration->key }}">
</div>