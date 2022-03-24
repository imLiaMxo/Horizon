<label for="{{ $configuration->key }}"></label>
<textarea name="{{ $configuration->key }}" id="{{ $configuration->key }}" class="text-black dark:text-black">
    {!! $configuration->value !!}
</textarea>