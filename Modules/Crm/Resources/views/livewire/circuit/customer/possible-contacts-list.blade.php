    <div>
        
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            @if ($fuzzySearchSent === true)
            <div class=" m-4 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Possible Contacts</h3>
            </div>
                <ul role="list" class="divide-y divide-gray-200">
                    @if ($possibleContacts !== [])
                        <div class="flex items-center justify-center w-full">
                            <div class="sm:hidden">
                                <label for="tabs" class="sr-only">Select a tab</label>
                                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                                <select wire:model="searchBy" id="tabs" name="tabs"
                                    class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                    <x-dropdown-link value="byAddress" :active="$searchBy === 'byAddress'">
                                        Show Search By Address
                                    </x-dropdown-link>
                                    <x-dropdown-link value="byName" :active="$searchBy === 'byName'">
                                        Show Search By Name
                                    </x-dropdown-link>
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex w-full" aria-label="Tabs">
                                        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                        <x-filter-tab wire:click="setSearchBy" :active="$searchBy === 'byAddress'">
                                            Show Search By Address
                                        </x-filter-tab>
                                        <x-filter-tab wire:click="setSearchBy" :active="$searchBy === 'byName'">
                                            Show Search By Name
                                        </x-filter-tab>
                                    


                                    </nav>
                                </div>
                            </div>
                        </div>
                        @foreach ($possibleContacts as $key => $possibleContact)
                            <li>
                                <div class="w-full block ">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <button type="button" class="w-8 h-8"
                                            wire:click="remove('{{ $key }}')">
                                            <!-- Heroicon name: solid/chevron-right -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                        <div class="min-w-0 flex-1 flex items-center">

                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                <div>
                                                    <p class="text-sm font-medium text-green-600 truncate">
                                                        {{ $possibleContact['customer_name'] }}</p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <!-- Heroicon name: solid/mail -->
                                                        {{ $possibleContact['service_address'] }}
                                                    </p>
                                                </div>
                                                <div class="block">
                                                    <div>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            Primary Phone
                                                        </p>
                                                        <p class="text-sm text-gray-900">
                                                            {{ $possibleContact['primary_phone'] }}
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            Alt Phone
                                                        </p>
                                                        <p class="text-sm text-gray-900">
                                                            {{ $possibleContact['alt_phone'] }}
                                                        </p>
                                                        {{-- <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <!-- Heroicon name: solid/check-circle -->
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                clip-rule="evenodd" />
                                                        </svg> 
                                                        Completed phone screening
                                                    </p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <x-button class="hover:bg-green-300 hover:bg-opacity-60" type="button"
                                                wire:click="$emit('verify', 'possibleContact', {{ $possibleContact['id'] }})">
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </x-button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="py-5">
                            <div class="relative focus-within:ring-2 focus-within:ring-green-500">
                                <h3 class="text-xl font-semibold text-gray-800">
                                    No Contacts Found
                                </h3>
                            </div>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
