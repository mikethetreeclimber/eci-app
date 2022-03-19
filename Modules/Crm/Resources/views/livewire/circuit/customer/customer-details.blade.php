<div class="grid grid-cols-1 gap-4">

    <dl class="sm:col-span-1 space-y-2">
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
    </dl>
    <div class="sm:col-span-1 space-y-2">
        @if ($customer->verifiedContact)
            <x-button wire:click="$emit('verify', 'new')">Edit Contact</x-button>
        @else
            <x-button wire:click="$emit('verify', 'new')">Add Contact</x-button>
        @endif
    </div>
    <div class="col-span-2">
        <livewire:crm::circuit.customer.customer-best-results :customer="$customer" />
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
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_three ?? '' }}
                        </dd>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_four ?? '' }}
                        </dd>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->phone_five ?? '' }}
                        </dd>
                    </div>
                    <div class="col-span-1 sm:text-center">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $customer->verifiedContact->email_address ?? '' }}">
                                {{ $customer->verifiedContact->email_address ?? '' }}
                            </a>
                        </dd>
                        <dt class="text-sm font-medium text-gray-500">Other Names</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $customer->verifiedContact->other_names ?? '' }}
                        </dd>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="sm:col-span-2">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class="sm:col-span-2">
                @if ($stationData)
                    @foreach ($stationData as $unit => $stations)
                        <div x-data="{open: false}" class="w-full col-span-1 sm:text-center space-y-2 mb-2">
                            <div @click="open = !open"
                                class="cursor-pointer w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
                                <p class="text-base font-medium text-gray-900">
                                    {{ $unit }} / 
                                </p>

                                <p class="text-base font-medium text-gray-900">
                                     {{ count($stations) }} Stations
                                </p>
                            </div>
                            <div class="mb-2 col-span-1 grid grid-cols-2 gap-2">
                                @foreach ($stations as $key => $station)
                                    <div x-show="open == true" class="space-y-1">
                                        <div class="flex justify-center items-center space-y-1">
                                            <p for="email" class="block text-sm font-medium text-gray-700">
                                                <x-permission-badge size="xs"
                                                    :permissionStatus="$station->permission_status" />
                                                <span>{{ $station->station_name }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
