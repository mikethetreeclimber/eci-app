   {{-- Customer Header --}}
   <div class="mt-2 space-y-2 lg:space-y-0 lg:flex lg:items-center lg:justify-between">
       <div class="flex-1 min-w-0">
           <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl ">
               {{  $customer->name }}
           </h2>
       </div>
       <div class="flex-1 min-w-0">
           <x-permission-badge size="sm" :permissionStatus="$customer->permission_status" />
       </div>
       <div class="flex-1 min-w-0">
           <p class="mr-1 text-base font-semibold text-gray-500">
               Assessed On:
               <span class="text-gray-700 font-bold text-lg truncate">
                   {{ $customer->assessed_date }}
               </span>
           </p>

       </div>
       <div class="flex lg:ml-4 space-x-3">

           <x-secondary-button wire:click="$set('editModal', true)" type="button">
               Edit
           </x-secondary-button>

           @if (ucwords($customer->permission_status) === 'No Contact')
               <x-danger-button wire:click="$set('notApprovedModal', true)" type="button">
                   Not Approved
               </x-danger-button>

               <x-danger-button wire:click="$set('refusalModal', true)" type="button">
                   Refusal
               </x-danger-button>

               <x-button wire:click="$set('approvalModal', true)" type="button">
                   Approve
               </x-button>
           @endif
           @if (ucwords($customer->permission_status) === 'Refusal')
               <x-danger-button wire:click="$set('notApprovedModal', true)" type="button">
                   Not Approved
               </x-danger-button>

               <x-warning-button wire:click="$set('noContactModal', true)" type="button">
                   No Contact
               </x-warning-button>

               <x-button wire:click="$set('approvalModal', true)" type="button">
                   Approve
               </x-button>
           @endif
           @if (ucwords($customer->permission_status) === 'Approved')
               <x-warning-button wire:click="$set('noContactModal', true)" type="button">
                   No Contact
               </x-warning-button>

               <x-danger-button wire:click="$set('notApprovedModal', true)" type="button">
                   Not Approved
               </x-danger-button>

               <x-danger-button wire:click="$set('refusalModal', true)" type="button">
                   Refusal
               </x-danger-button>
           @endif
           @if (ucwords($customer->permission_status) === '')
               <x-danger-button wire:click="$set('refusalModal', true)" type="button">
                   Refusal
               </x-danger-button>

               <x-warning-button wire:click="$set('noContactModal', true)" type="button">
                   No Contact
               </x-warning-button>

               <x-button wire:click="$set('approvalModal', true)" type="button">
                   Approve
               </x-button>
           @endif

       </div>
       <x-confirmation-modal wire:model="approvalModal">
           <x-slot name="title">
               Final Approval
           </x-slot>
           <x-slot name="content">
               Are You Sure You Are Ready To Approve This Customer?
               <p>You Have Made {{ count($customer->permissions) }} Attempts So Far.</p>
           </x-slot>
           <x-slot name="footer">
               <div class="space-x-3">
                   <x-warning-button wire:click="$set('approvalModal', false)">Cancel</x-warning-button>

                   <x-button wire:click="approve">Approve</x-button>
               </div>
           </x-slot>

       </x-confirmation-modal>

       <x-confirmation-modal wire:model="noContactModal">
           <x-slot name="title">
               No Contact
           </x-slot>
           <x-slot name="content">
               Are You Sure You Want To Make This Customer A No Contact?
           </x-slot>
           <x-slot name="footer">
               <div class="space-x-3">
                   <x-warning-button wire:click="$set('noContactModal', false)">Cancel</x-warning-button>

                   <x-danger-button wire:click="noContact">No Contact</x-danger-button>
               </div>
           </x-slot>

       </x-confirmation-modal>

       <x-confirmation-modal wire:model="refusalModal">
           <x-slot name="title">
               Refusal
           </x-slot>
           <x-slot name="content">
               Are You Sure You Want To Make This Customer A Refusal?
           </x-slot>
           <x-slot name="footer">
               <div class="space-x-3">
                   <x-warning-button wire:click="$set('refusalModal', false)">Cancel</x-warning-button>

                   <x-danger-button wire:click="refusal">Refusal</x-danger-button>
               </div>
           </x-slot>

       </x-confirmation-modal>

       <x-dialog-modal wire:model="editModal">
           <x-slot name="title">
               Edit Customer Details
           </x-slot>
           <x-slot name="content">
               <div class="grid grid-cols-6 gap-6">
                   <div class="col-span-6 grid grid-cols-5 gap-6">
                       <label for="first-name" class="col-span-5 block text-sm font-medium text-gray-700">Customer
                           Name</label>
                       <x-input type="text" wire:model="customer.first_name" class="col-span-2" />
                       <x-input type="text" wire:model="customer.last_name" class="col-span-2" />
                   </div>

                   <div class="col-span-6 grid grid-cols-5 gap-6">
                       <label for="first-name" class="col-span-5 block text-sm font-medium text-gray-700">Mailing
                           Address</label>
                       <x-input type="text" wire:model="customer.mailing_address" class="col-span-3" />
                       <x-input type="text" wire:model="customer.city" class="col-span-3" />
                       <x-input type="text" wire:model="customer.state" class="col-span-1" />
                   </div>

                   <div class="col-span-6 grid grid-cols-5 gap-6">
                       <label for="first-name" class="col-span-5 block text-sm font-medium text-gray-700">Physical
                           Address</label>
                       <x-input type="text" wire:model="customer.physical_address" class="col-span-3" />
                       <x-input type="text" wire:model="customer.physical_city" class="col-span-3" />
                       <x-input type="text" wire:model="customer.physical_state" class="col-span-1" />
                   </div>
               </div>

           </x-slot>
           <x-slot name="footer">
               <div class="space-x-3">
                   <x-warning-button wire:click="$set('editModal', false)">Cancel</x-warning-button>

                   <x-button wire:click="editCustomer">Save</x-button>
               </div>
           </x-slot>

       </x-dialog-modal>

       <x-confirmation-modal wire:model="notApprovedModal">
           <x-slot name="title">
               Switch Approved Customer to Not Approved
           </x-slot>
           <x-slot name="content">
               Are you sure you want to perform this action ?
           </x-slot>
           <x-slot name="footer">
               <div class="space-x-3">
                   <x-warning-button wire:click="$set('notApprovedModal', false)">Cancel</x-warning-button>

                   <x-danger-button wire:click="notApproved">Not Approved</x-danger-button>
               </div>
           </x-slot>

       </x-confirmation-modal>
   </div>

   {{-- End Customer Header --}}







   {{-- <section class="h-full lg:pl-6 mt-1 lg:w-2/6">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg rounded-md">

                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Contact Information</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    @if ($bestResults === null)
                        <div class="w-full flex items-center justify-between p-6 space-x-6">
                            <div class="flex-1 justify-center text-center">
                                No verified contacts
                                <br />
                                Click below to search the PPL contact list.
                                <br />
                                <hr>
                                <br>
                                <livewire:crm::circuit.customer.find-contacts :customer="$customer"
                                    :circuit="$circuit" />
                                <br />
                                If the best results are found they will be displayed here!
                            </div>
                        </div>
                    @endif

                    @if ($bestResults !== [] && $bestResults !== null)
                        <div class="flex-1 justify-center text-center">
                            <div class="flex justify-center items-center space-x-3">
                                <h3 class="text-gray-900 text-md font-bold truncate">
                                </h3>
                            </div>
                            <span class="text-sm text-gray-500">Primary Phone:</span>
                            <p class="mx-1 text-gray-700 text-sm truncate">
                                <a
                                    href="tel:{{ $bestResults['primary_phone'] }}">{{ $bestResults['primary_phone'] }}</a>
                            </p>
                            @if ($bestResults['alt_phone'] !== null)
                                <span class="text-sm text-gray-500">Alternative Phone:</span>
                                <p class="mx-1 text-gray-700 text-sm truncate">
                                    {{ $bestResults['alt_phone'] }}
                                </p>
                            @endif
                            @if ($bestResults['email_address'] !== null)
                                <span class="text-sm text-gray-500">Email Address:</span>
                                <p class="myx-1 text-gray-700 text-sm truncate">
                                    <a href="mailto:{{ $bestResults['email_address'] }}">
                                        {{ $bestResults['email_address'] }}
                                    </a>
                                </p>
                            @endif
                            <span class="text-sm text-gray-500">Service Address:</span>
                            <p class="mx-1 text-gray-700 text-sm truncate">
                                {{ ucwords(strtolower(Str::before($bestResults['service_address'], ','))) }},
                                {{ Str::after($bestResults['service_address'], ',') }}
                            </p>
                            <span class="text-sm text-gray-500">Mailing Address:</span>
                            <p class="mx-1 text-gray-700 text-sm truncate">
                                {{ ucwords(strtolower(Str::before($bestResults['mailing_address'], ','))) }},
                                {{ Str::after($bestResults['mailing_address'], ',') }}
                            </p>
                        </div>
                    @endif

                    @if ($bestResults === [] && $bestResults !== null)
                        <div class="w-full flex items-center justify-between p-6 space-x-6">
                            <div class="flex-1 justify-center text-center">
                                It seems best results could not be found but there maybe possible contacts down
                                below!
                                <br />
                                Click here to scroll to
                                <x-nav-link href="#possibleContacts">Possible Contacts</x-nav-link>
                                <br>
                                OR
                                <br>
                                Use DataFinder
                            </div>

                        </div>
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
                    @endif
                    @if ($customer->phone_finder_used == true && $customer->phone_finder_id !== null)
                        <div class="w-full flex items-center justify-between p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-gray-900 text-md font-bold truncate">
                                        {{ $customer->phone->first_name }}
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
                                            <x-nav-link href="https://datafinder.com" target="_blank">DataFinder API
                                            </x-nav-link>
                                        </p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </section> --}}
