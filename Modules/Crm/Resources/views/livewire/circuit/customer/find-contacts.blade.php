<div class="grid grid-cols-1">
    <div class="grid mt-1 space-y-2">
        
        <x-input-error for="invalidSearch" />

        <label for="search" class="block text-sm font-medium text-gray-700">
            Search Database For A Matching... 
        </label>
        <select wire:model="search" id="search" name="search"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
            <option value="mailing_address">Mailing Address</option>
            <option value="service_address">Service Address</option>
        </select>

        <label for="searchBy" class="block text-sm font-medium text-gray-700">
            With The Current Customers 
        </label>
        <select wire:model="searchBy" id="searchBy" name="searchBy"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
            <option value="mailing_address">Mailing Address</option>
            <option value="physical_address">Service Address</option>
        </select>

        <div>
            <x-button type="button" wire:click='fuzzySearch'>Fuzzy Search Database</x-button>
        </div>

        <div wire:loading.delay='possibleContacts' class="flex animate-pulse items-center justify-center">
            <h5 class="text-md font-bold">Searching Database For Contact Information</h5>
        </div>

    </div>
</div>
