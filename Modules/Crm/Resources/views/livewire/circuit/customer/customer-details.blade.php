<dl class="grid grid-cols-1 gap-4">

    <div class="sm:col-span-1 space-y-2">
        <div>
            <dt class="text-sm font-medium text-gray-500">Service Address</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ ucwords(strtolower(Str::before($customer->service_address, ','))) }},
                {{ Str::after($customer->service_address, ',') }}
            </dd>
        </div>

        <div>
            <dt class="text-sm font-medium text-gray-500">Mailing Address</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ ucwords(strtolower(Str::before($customer->full_mailing_address, ','))) }},
                {{ Str::after($customer->full_mailing_address, ',') }}
            </dd>
        </div>
    </div>
    <div class="sm:col-span-1 space-y-2">
        @if ($customer->verifiedContact)
        <x-button wire:click="$emit('verify', 'new')">Edit Contact</x-button>
        @else
        <x-button wire:click="$emit('verify', 'new')">Add Contact</x-button>
        @endif
    </div>
    <div class="sm:col-span-2">
        @if ($customer->verifiedContact)
            <div x-data="{verifiedContacts: false}">
                <div @click="verifiedContacts = !verifiedContacts" x-show="verifiedContacts == false"
                    class="cursor-pointer w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
                    <span>Show Verified Contacts</span>
                </div>
                <div x-show="verifiedContacts" style="display: none" class="grid grid-cols-1 sm:grid-cols-2">
                    <div class="sm:col-span-2 sm:text-center mb-4">
                        <div @click="verifiedContacts = !verifiedContacts" x-show="verifiedContacts"
                            class="cursor-pointer w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
                            <span>Hide Verified Contacts</span>
                        </div>
                    </div>
                    <div class="col-span-1 sm:text-center">
                        <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_one ?? '' }}</dd>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_two ?? '' }} </dd>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_three ?? '' }} </dd>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_four ?? '' }} </dd>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_five ?? '' }} </dd>
                    </div>
                    <div class="col-span-1 sm:text-center">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $customer->verifiedContact->email_address ?? '' }}">
                                {{ $customer->verifiedContact->email_address ?? '' }}
                            </a>
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">Other Names</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->other_names ?? '' }}</dd>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- <div class="sm:col-span-1 space-y-2">
            <div>
                <dt class="text-sm font-medium text-gray-500">Primary Phone</dt>
                <dd class="mt-1 text-sm text-gray-900">570-111-2222</dd>
            </div>
            <dt class="text-sm font-medium text-gray-500">Alt Phone</dt>
            <dd class="mt-1 text-sm text-gray-900">570-222-3333</dd>
        </div> --}}
    <div wire:init="stationDataGetter" x-data="{stationData: false}" class="sm:col-span-2">
        <div @click="stationData = !stationData" x-show="stationData == false"
            class="cursor-pointer w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
            <span>Show Station Data</span>
        </div>
        <div x-show="stationData" style="display: none" class="grid grid-cols-1 sm:grid-cols-2">
            <div class="sm:col-span-2 sm:text-center mb-4">
                <div @click="stationData = !stationData" x-show="stationData"
                    class="cursor-pointer w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
                    <span>Hide Station Data</span>
                </div>
            </div>
            @if ($stationData)
                
            @foreach ($stationData as $station)
                <div class="col-span-1 sm:text-center">
                    <dt class="text-sm font-medium text-gray-500">{{ $station->station_name }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $station->unit }}</dd>
                </div>
            @endforeach
            @endif

        </div>
    </div>
</dl>
