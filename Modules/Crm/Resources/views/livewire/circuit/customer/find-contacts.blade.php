<div class="flex space-x-4" >
    
            <x-button type="button" wire:click='fuzzySearch'>Fuzzy Search Database</x-button>
        <div wire:loading='possibleContacts'>

            <div class="flex animate-pulse flex-row items-center justify-center space-x-5">
                <h5 class="text-xl font-bold">Searching Database For Contact Information</h5>
            </div>
        </div>
    
</div>
