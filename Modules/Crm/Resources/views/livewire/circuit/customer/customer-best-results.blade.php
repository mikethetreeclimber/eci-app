<div wire:init="bestResultsSearch">
    @if ($bestResults !== [] && $bestResults !== null)
        <div>
            <div class="mt-2 flex items-center justify-between space-x-3">
                <h3 class="text-gray-900 text-md font-bold truncate">
                    Best Results
                </h3>
                <x-button wire:click="$emit('verify', 'bestResults', {{ $bestResults['id'] }})">Verify</x-button>
            </div>
            @if ($bestResults['customer_name'] !== null)
                <span class="text-xs text-gray-500">Customer Name:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $bestResults['customer_name'] }}
                </p>
            @endif
            @if ($bestResults['primary_phone'] !== null)
                <span class="text-xs text-gray-500">Primary Phone:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    <a href="tel:{{ $bestResults['primary_phone'] }}">{{ $bestResults['primary_phone'] }}</a>
                </p>
            @endif
            @if ($bestResults['alt_phone'] !== null)
                <span class="text-xs text-gray-500">Alternative Phone:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $bestResults['alt_phone'] }}
                </p>
            @endif
            @if ($bestResults['email_address'] !== null)
                <span class="text-xs text-gray-500">Email Address:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    <a href="mailto:{{ $bestResults['email_address'] }}">
                        {{ $bestResults['email_address'] }}
                    </a>
                </p>
            @endif
        </div>
  
    @elseif ($bestResults === null)
        <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 justify-center text-center">
                Sorry, It seems best results could not be found!
                Try searching the database manually below.
            </div>
        </div>
    @elseif ($hasVerifiedContacts)
        <div class="flex-1 justify-center text-center">
            This customer already has verified Contacts
        </div>
    @else
        <div class="flex-1 justify-center text-center mb-4">
            If best results are found they will be displayed<span class="font-bold"> HERE!</span>
        </div>
    @endif

</div>
