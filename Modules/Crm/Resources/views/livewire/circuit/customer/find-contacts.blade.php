<div class="h-full w-full">
    @if ($fuzzySearchComplete !== true)
    <div class="relative">
        <x-button type="button" wire:click='fuzzySearch'>Fuzzy Search</x-button>
    </div>
        
    @endif
    <div wire:loading='possibleContacts' class="w-full max-h-full">
        <div class="relative z-50 w-full h-full border-2 rounded-md mx-auto">
            <div class="flex animate-pulse flex-row items-center w-full h-full justify-center space-x-5">
                <h5 class="m-3 p-6 text-xl font-bold">Searching Database For Contact Information</h5>
            </div>
        </div>
    </div>
</div>
