<ul role="list" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
    <li class="bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 justify-center text-center">
                <div class="flex justify-center items-center space-x-3">
                    <h3 class="text-gray-900 text-md font-bold truncate">{{ $customer->name }}</h3>
                    <span
                        class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-xs font-medium bg-red-100 rounded-full">Not
                        Approved</span>
                </div>
                <span class="text-sm text-gray-500">Service Address:</span>
                <p class="mx-1 text-gray-700 text-sm truncate">
                    {{ ucwords(strtolower(Str::before($customer->service_address, ','))) }},
                    {{ Str::after($customer->service_address, ',') }}
                </p>
                <span class="text-sm text-gray-500">Mailing Address:</span>
                <p class="myx-1 text-gray-700 text-sm truncate">
                    {{ ucwords(strtolower(Str::before($customer->full_mailing_address, ','))) }},
                    {{ Str::after($customer->full_mailing_address, ',') }}
                </p>
            </div>
        </div>
    </li>
    {{-- < class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200"> --}}
    {{-- < class="w-full flex items-center justify-between p-6 space-x-6"> --}}
    <li class="bg-white rounded-lg shadow divide-y divide-gray-200">
        @if ($customer->phone == null)
            <div class="w-full flex items-center justify-between p-6 space-x-6">
                <div class="flex-1 justify-center text-center">
                    <div class="flex justify-center items-center space-x-3 mb-3">
                        <button wire:click="phoneFinder"
                            class="p-2 border hover:bg-orange-400 bg-orange-200 rounded-md border-gray-900 shadow hover:shadow-lg text-gray-900 text-md font-bold truncate">
                            Click To
                            Search Data Finder</button>
                    </div>
                    <p class="mt-1 text-gray-700 text-sm truncate">
                        Search With Mailing Address and Name
                    </p>
                    <span class="mt-3 text-xs text-gray-500">Powered By</span>
                    <p class="text-gray-700 text-sm truncate">
                        <x-nav-link href="https://datafinder.com">DataFinder API</x-nav-link>
                    </p>
                </div>
            </div>
        @endif
        @if ($customer->phone === 0)
            <div class="w-full flex items-center justify-between p-6 space-x-6">
                <div class="flex-1 justify-center text-center">
                    <div class="flex justify-center items-center space-x-3 mb-3">
                        Data Finder Has No Results
                    </div>
                    <span class="mt-3 text-xs text-gray-500">Powered By</span>
                    <p class="text-gray-700 text-sm truncate">
                        <x-nav-link href="https://datafinder.com">DataFinder API</x-nav-link>
                    </p>
                </div>
            </div>
        @endif
        @if ($customer->phone !== null)
            <div class="w-full flex items-center justify-between p-6 space-x-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="text-gray-900 text-md font-bold truncate">{{ $customer->phone->first_name }}
                            {{ $customer->phone->last_name }}</h3>
                    </div>
                    <span class="text-xs text-gray-500">Phone:</span>
                    <p class="mt-1 text-gray-700 text-sm truncate">
                        {{ $customer->phone->phone }}
                    </p>
                    <span class="text-xs text-gray-500">Address:</span>
                    <p class="mt-1 text-gray-700 text-sm truncate">
                        {{ $customer->phone->address }}
                        {{ $customer->phone->city }},
                        {{ $customer->phone->state }}
                    </p>
                    <div class="flex items-center">
                        <span class="mt-3 text-xs text-gray-500">Powered By
                        <p class="text-gray-700 text-sm truncate">
                            <x-nav-link href="https://datafinder.com">DataFinder API</x-nav-link>
                        </p>
                    </span>
                    </div>
                </div>
            </div>
        @endif
    </li>
    @if ($possibleContacts !== [])
        @dump($possibleContacts)
    @endif
</ul>
