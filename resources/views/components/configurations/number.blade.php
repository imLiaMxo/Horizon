@props(['configuration'])

<div class="mb-0">
    <input type="number" class="flex-1 py-2 rounded text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent" id="{{ $configuration->key }}" value="{{ $configuration->value }}"
           placeholder="{{ $configuration->display_name }}" name="{{ $configuration->key }}">
</div>