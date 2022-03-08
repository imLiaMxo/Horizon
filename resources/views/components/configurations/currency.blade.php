<select class="rounded shadow bg-gray-400 dark:bg-gray-600 text-black dark:text-white" name="{{ $configuration->key }}">
    @foreach(config('horizon.currencies') as $cur => $sym)
        <option value="{{ $cur }}" {{ $cur === $configuration->value ? 'selected=""' : '' }}>
                {{ $cur }} - {{ $sym }}
        </option>
    @endforeach
</select>