<div>
    <div wire:init="searchForExistingContacts">

        <x-dialog-modal wire:model="existingVerifiedContactFound">
            <x-slot:title>Found Existing Verified Contact Data</x-slot:title>
            <x-slot:content>
                @if ($verifiedContact !== null && $verifiedContact !== [])
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-md font-bold truncate">
                                    {{ $verifiedContact[0]['customer_name'] }}</h3>
                            </div>
                            <span class="text-xs text-gray-500">Phone:</span>
                            <p class="mt-1 text-gray-700 text-sm truncate">
                                {{ $verifiedContact[0]['phone_one'] }}
                            </p>
                            <span class="text-xs text-gray-500">Address:</span>
                            <p class="mt-1 text-gray-700 text-sm truncate">
                                {{ $verifiedContact[0]['service_address'] }}
                            </p>
                            <p class="mt-1 text-gray-700 text-sm truncate">
                                {{ $verifiedContact[0]['mailing_address'] }}
                            </p>
                        </div>
                    </div>
                @endif
            </x-slot:content>
            <x-slot:footer>
                <x-button wire:click="confirmExistingVerifiedContact">Confirm</x-button>
            </x-slot:footer>
        </x-dialog-modal>
    </div>
    <div >
        <x-dialog-modal wire:model="existingPhoneFinderFound">
            <x-slot:title>Found Existing Phone Finder Data</x-slot:title>
            <x-slot:content>
                @if ($existingPhoneFinder)
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-md font-bold truncate">
                                    {{ $existingPhoneFinder[0]['first_name'] }}
                                    {{ $existingPhoneFinder[0]['last_name'] }}</h3>
                            </div>
                            <span class="text-xs text-gray-500">Phone:</span>
                            <p class="mt-1 text-gray-700 text-sm truncate">
                                {{ $existingPhoneFinder[0]['phone'] }}
                            </p>
                            <span class="text-xs text-gray-500">Address:</span>
                            <p class="mt-1 text-gray-700 text-sm truncate">
                                {{ $existingPhoneFinder[0]['address'] }}
                                {{ $existingPhoneFinder[0]['city'] }},
                                {{ $existingPhoneFinder[0]['state'] }}
                            </p>
                            <div class="flex items-center">
                                <span class="mt-3 text-xs text-gray-500">Powered By
                                    <p class="text-gray-700 text-sm truncate">
                                        <x-nav-link href="https://datafinder.com" target="_blank">DataFinder API
                                        </x-nav-link>
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </x-slot:content>
            <x-slot:footer>
                <x-button wire:click="confirmExistingDataFinder">Confirm</x-button>
            </x-slot:footer>
        </x-dialog-modal>
    </div>

    <x-dialog-modal wire:model="verifyModal">
        <x-slot:title>
            Confirm the Contact Information Before Verifying. <div>You can also edit the data before saving it.</div>
        </x-slot:title>
        <x-slot:content>
            @if ($toBeVerified)

                <div class="w-full flex items-center justify-between p-6 space-x-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-gray-500">Customer Name:</span>
                            <p>
                                <x-input type="text" wire:model.debounce="toBeVerified.customer_name" />
                            </p>
                        </div>

                        <div>
                            <span class="text-xs text-gray-500">Service Address:</span>
                            <p>
                                <x-input type="text" wire:model.debounce="toBeVerified.service_address" />
                            </p>
                        </div>
                        <div>

                            <span class="text-xs text-gray-500">Mailing Address:</span>
                            <p>
                                <x-input type="text" wire:model.debounce="toBeVerified.mailing_address" />
                            </p>
                        </div>
                        <div class="col-span-2 grid grid-cols-3">
                            <div class="col-span-3 text-center">
                                Contact Information to Verify
                            </div>
                            @if ($contacts)

                                @foreach ($contacts as $key => $contact)
                                    <div class="col-span-1">
                                        <span class="text-xs text-gray-500">{{ $key }}</span>
                                        <p class="mt-1 text-gray-700 text-sm truncate">
                                            {{ $contact }}
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-span-2 grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-xs text-gray-500">Phone One:</span>
                                <p>
                                    <x-input type="text" wire:model.debounce="toBeVerified.phone_one" />
                                </p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500">Phone Two:</span>
                                <p>
                                    <x-input type="text" wire:model.debounce="toBeVerified.phone_two" />
                                </p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500">Phone Three:</span>
                                <p>
                                    <x-input type="text" wire:model.debounce="toBeVerified.phone_three" />
                                </p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500">Phone Four:</span>
                                <p>
                                    <x-input type="text" wire:model.debounce="toBeVerified.phone_four" />
                                </p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500">Phone Five:</span>
                                <p>
                                    <x-input type="text" wire:model.debounce="toBeVerified.phone_five" />
                                </p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500">Email:</span>
                                <p>
                                    <x-input type="text" wire:model.debounce="toBeVerified.email_address" />
                                </p>
                            </div>
                            <div class="col-span-2">
                                <span class="text-xs text-gray-500">Other Names:</span>
                                <p>
                                    <x-text-area model="toBeVerified.other_names" placeholder="Other Names" />
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </x-slot:content>
        <x-slot:footer>
            <x-button wire:click="confirmVerify">Confirm</x-button>
        </x-slot:footer>
    </x-dialog-modal>
    <div class="divide-y divide-gray-200 space-y-2">
        {{-- <livewire:crm::circuit.customer.customer-best-results :customer="$customer" /> --}}
        <div x-data="{show: true}" class="w-full flex items-center justify-between space-x-6">
            <div class="flex-1 justify-center text-center space-y-2">
                <div @click="show = !show"
                    class="cursor-pointer w-full h-10 py-2 px-4 bg-gray-300 rounded-md shadow-md text-center">
                    Show/Hide Fuzzy Search</div>
                <div x-show="show" style="display: none">
                    <livewire:crm::circuit.customer.find-contacts :customer="$customer" :circuit="$circuit" />
                </div>
            </div>
        </div>


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
        @if ($customer->phone_finder_used == true && $customer->phone_finder_id !== null)
            <div class="mt-2 ">
                <div class="mt-2 flex items-center justify-between space-x-3">
                    <h3 class="text-gray-900 text-md font-bold truncate">
                        Data Finder
                    </h3>
                    <x-button wire:click="verify('customer')">Verify</x-button>
                </div>
                <span class="text-xs text-gray-500">Customer Name:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $customer->phone->first_name }}
                    {{ $customer->phone->last_name }}
                </p>
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
            </div>
        @endif
    </div>
</div>
