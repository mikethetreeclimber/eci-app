<ul role="list" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
    <li class="bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 justify-center text-center">
                <div class="flex justify-center items-center space-x-3">
                    <h3 class="text-gray-900 text-md font-bold truncate">
                        {{ strlen($customer->name) > 22 ? substr($customer->name, 0, 22) . '...' : $customer->name }}
                    </h3>
                </div>
                <div>
                    <span
                        class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-xs font-medium bg-red-100 rounded-full">Not
                        Approved</span>
                </div>
                <div>
                    <span
                        class="flex-shrink-0 inline-block px-2 py-0.5 text-gray-800 text-xs font-medium bg-yellow-100 rounded-full">{{ Carbon\Carbon::parse($customer->imported_at)->diffForHumans() }}</span>
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

    <li class="bg-white rounded-lg shadow divide-y divide-gray-200">
        @if ($bestResults !== [])
            <div class="w-full flex items-center justify-between p-6 space-x-6">
                <div class="flex-1 justify-center text-center">
                    <div class="flex justify-center items-center space-x-3">
                        <h3 class="text-gray-900 text-md font-bold truncate">
                            {{ strlen($bestResults['customer_name']) > 22? substr($bestResults['customer_name'], 0, 22) . '...': $bestResults['customer_name'] }}
                        </h3>
                    </div>
                    <span class="text-sm text-gray-500">Primary Phone:</span>
                    <p class="mx-1 text-gray-700 text-sm truncate">
                        <a href="tel:+1-{{ $bestResults['primary_phone'] }}">{{ $bestResults['primary_phone'] }}</a>
                    </p>
                    @if ($bestResults['alt_phone'] !== null)
                        <span class="text-sm text-gray-500">Alternative Phone:</span>
                        <p class="myx-1 text-gray-700 text-sm truncate">
                            {{ $bestResults['alt_phone'] }}
                        </p>
                    @endif
                    <span class="text-sm text-gray-500">Service Address:</span>
                <p class="mx-1 text-gray-700 text-sm truncate">
                    {{ ucwords(strtolower(Str::before($bestResults['service_address'], ','))) }},
                    {{ Str::after($bestResults['service_address'], ',') }}
                </p>
                <span class="text-sm text-gray-500">Mailing Address:</span>
                <p class="myx-1 text-gray-700 text-sm truncate">
                    {{ ucwords(strtolower(Str::before($bestResults['mailing_address'], ','))) }},
                    {{ Str::after($bestResults['mailing_address'], ',') }}
                </p>
                </div>
            </div>
        @endif
    </li>

    {{-- < class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200"> --}}
    {{-- < class="w-full flex items-center justify-between p-6 space-x-6"> --}}
    @if ($customer)
        <li class="bg-white rounded-lg shadow divide-y divide-gray-200">
            @if ($customer->phone_finder_used == false)
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
            @if ($customer->phone_finder_used == true && $customer->phone_finder_id == null)
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
            @if ($customer->phone_finder_used == true && $customer->phone_finder_id !== null)
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
                                    <x-nav-link href="https://datafinder.com" target="_blank">DataFinder API</x-nav-link>
                                </p>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </li>
    @endif

</ul>
