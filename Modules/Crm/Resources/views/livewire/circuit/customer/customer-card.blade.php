    <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="w-full flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">

                    <h3 class="text-gray-900 text-md font-bold truncate">
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </h3>
                    <x-permission-badge size="sm" :permissionStatus="$customer->permission_status" />
                        
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
                    <a href="{{ route('crm.customer.show', ['circuit' => $circuit, 'customer' => $customer]) }}"
                        class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                        <!-- Heroicon name: solid/mail -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="ml-3">View</span>
                    </a>
                    <x-dialog-modal wire:model="modal">
                        <x-slot name="title">
                            Final Approval Form
                        </x-slot>
                        <x-slot name="content">
                            <x-form-section submit="submit" title="Approval"
                                description="Make your final remarks for the approval">
                                <x-slot:form>
                                    <div class="w-full">
                                        <x-label>
                                            <x-input type="text" value="{{ $customer->name }}" />

                                        </x-label>
                                        <x-section-border />
                                    </div>
                                </x-slot:form>

                            </x-form-section>

                        </x-slot>
                        <x-slot name="footer">
                            <div class="space-x-3">
                                <x-button wire:click="$set('modal', false)">Cancel</x-button>

                                <x-button wire:click="approve">Approve</x-button>
                            </div>
                        </x-slot>

                    </x-dialog-modal>
                </div>
                @if ($customer->permission_status !== 'Approved')
                    <div class="-ml-px w-0 flex-1 flex">
                        <button type="button" wire:click="$set('modal', true)"
                            class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 hover:bg-green-500">
                            <!-- Heroicon name: solid/phone -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="ml-3">Approve</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </li>
