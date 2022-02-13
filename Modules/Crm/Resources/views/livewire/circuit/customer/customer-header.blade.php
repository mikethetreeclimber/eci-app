<ul role="list" class="mt-4 grid grid-cols-1">
    <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                    <h3 class="text-gray-900 text-md font-bold truncate">{{ $customer->name }}</h3>
                    <span
                        class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-xs font-medium bg-red-100 rounded-full">Not
                        Approved</span>
                </div>
                <span class="text-xs text-gray-500">Service Address:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $customer->service_address }}
                </p>
                <span class="text-xs text-gray-500">Mailing Address:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $customer->full_mailing_address }}
                </p>
            </div>
            {{-- </div> --}}
            {{-- </li>
<li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200"> --}}
            {{-- <div class="w-full flex items-center justify-between p-6 space-x-6"> --}}
            @if ($phoneFinder == [])
                <div class="flex-1 w-full h-full">
                    <div class="text-4xl text-orange-700 animate-bounce"> No Results From datafinder</div>
                </div>
            @endif
            @if ($phoneFinder !== [])
                <div class="flex-1 w-full h-full">
                    <div class="flex items-center space-x-3">
                        <h3 class="text-gray-900 text-md font-bold truncate">
                            {{ $phoneFinder->first_name }}
                            {{ $phoneFinder->last_name }}</h3>
                    </div>
                    <span class="text-xs text-gray-500">Phone:</span>
                    <p class="mt-1 text-gray-700 text-md font-bold truncate">
                        {{ $phoneFinder->phone }}
                    </p>
                    <span class="text-xs text-gray-500">Address:</span>
                    <p class="mt-1 text-gray-700 text-sm truncate">
                        {{ $phoneFinder->address }}
                        {{ $phoneFinder->city }}, 
                        {{ $phoneFinder->state }}
                    </p>

                </div>
            @endif
        </div>
    </li>
</ul>
