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
    @if ($customer->verifiedContact)
        <div x-data="{verifiedContact: false}" class="sm:col-span-2">
            <div @click="verifiedContact = !verifiedContact" x-show="verifiedContact == false"
                class="w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
                <span>Show Verified Contacts</span>
            </div>
            <div x-show="verifiedContact" style="display: none" class="grid grid-cols-1 sm:grid-cols-2">
                <div class="sm:col-span-2 sm:text-center mb-4">
                    <div @click="verifiedContact = !verifiedContact" x-show="verifiedContact"
                        class="w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
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
    {{-- <div class="sm:col-span-1 space-y-2">
            <div>
                <dt class="text-sm font-medium text-gray-500">Primary Phone</dt>
                <dd class="mt-1 text-sm text-gray-900">570-111-2222</dd>
            </div>
            <dt class="text-sm font-medium text-gray-500">Alt Phone</dt>
            <dd class="mt-1 text-sm text-gray-900">570-222-3333</dd>
        </div> --}}
    <div x-data="{stationData: false}" class="sm:col-span-2">
        <div @click="stationData = !stationData" x-show="stationData == false"
            class="w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
            <span>Show Station Data</span>
        </div>
        <div x-show="stationData" style="display: none" class="grid grid-cols-1 sm:grid-cols-2">
            <div class="sm:col-span-2 sm:text-center mb-4">
                <div @click="stationData = !stationData" x-show="stationData"
                    class="w-full h-10 border border-gray-600 hover:bg-gray-300 flex justify-center items-center font-bold text-lg rounded-md">
                    <span>Hide Station Data</span>
                </div>
            </div>
            <div class="col-span-1 sm:text-center">
                <dt class="text-sm font-medium text-gray-500">{{ $customer->station_name }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $customer->unit }}</dd>
            </div>
            <div class="col-span-1 sm:text-center">
                <dt class="text-sm font-medium text-gray-500">{{ $customer->station_name }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $customer->unit }}</dd>
            </div>
            <div class="col-span-1 sm:text-center">
                <dt class="text-sm font-medium text-gray-500">{{ $customer->station_name }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $customer->unit }}</dd>
            </div>

        </div>
    </div>
</dl>
