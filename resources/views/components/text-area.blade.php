    @props([
        'model',
        'placeholder'
    ])
    <div
        class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-green-500 focus-within:ring-1 focus-within:ring-green-500">
  
        <label for="{{ $model }}" class="sr-only">{{ $model }}</label>
        <textarea wire:model.debounce="{{ $model }}" rows="2" name="{{ $model }}" id="{{ $model }}"
            class="m-1 block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm"
            placeholder="{{ $placeholder }}"></textarea>

        
    </div>

