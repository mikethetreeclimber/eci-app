    <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                    <h3 class="text-gray-900 text-md font-bold truncate">{{ $customer->first_name }}
                        {{ $customer->last_name }}</h3>
                    @if ($customer->permission_status === 'approved')
                        <span
                            class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">
                            {{ ucwords($customer->permission_status) }}
                        </span>
                    @else
                        <span
                            class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-xs font-medium bg-red-100 rounded-full">
                            Not Approved
                        </span>
                    @endif

                </div>
                <span class="text-xs text-gray-500">Physical Address:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $customer->physical_address }}
                    {{ $customer->physical_city }},
                    {{ $customer->physical_state }}
                </p>
                <span class="text-xs text-gray-500">Mailing Address:</span>
                <p class="mt-1 text-gray-700 text-sm truncate">
                    {{ $customer->mailing_address }}
                    {{ $customer->city }},
                    {{ $customer->state }}
                </p>
            </div>
        </div>
   
        <div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="w-0 flex-1 flex">
                    {{-- <a href="{{ route('crm.customer.show', ['circuit' => $circuit, 'customer' => $customer]) }}" --}}
                        <button  wire:click="$toggle('modal')"
                        class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                        <!-- Heroicon name: solid/mail -->
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span class="ml-3">View</span>
                    </button>
                        <x-dialog-modal wire:model="modal">
                            <x-slot name="title">
                             
                            </x-slot>
                            <x-slot name="content">
                              
                                <div class="flex items-center justify-center">
                                    <div>
                                        <livewire:crm::circuit.customer.find-contacts :customer="$customer" :circuit="$circuit" />
                                    </div>
                                </div>
                                <livewire:crm::circuit.customer.customer-header :customer="$customer" :circuit="$circuit" />
                                <x-crm::section-border />
                                <livewire:crm::circuit.customer.possible-contacts-list />
                            </x-slot>
                            <x-slot name="footer">
            
                            </x-slot>
            
                        </x-dialog-modal>
                </div>
                <div class="-ml-px w-0 flex-1 flex">
                    <a href="tel:+1-202-555-0170"
                        class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                        <!-- Heroicon name: solid/phone -->
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <span class="ml-3">Approve</span>
                    </a>
                </div>
            </div>
        </div>
    </li>
