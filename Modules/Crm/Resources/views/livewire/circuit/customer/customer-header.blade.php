   {{-- Customer Header --}}
    <div class="mt-2 space-y-2 lg:space-y-0 lg:flex lg:items-center lg:justify-between">
       {{-- Header Title --}}
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl ">
                {{ $customer->name }}
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
        {{-- End Header Title --}}

        {{-- Header Buttons --}}
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
        {{-- End Header Buttons --}}

        {{-- Header Modals --}}
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
                <x-input-error for="customer.*" />
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 grid grid-cols-5 gap-6">
                        <label for="first-name" class="col-span-5 block text-sm font-medium text-gray-700">Customer
                            Name</label>
                        <x-input type="text" wire:model.defer="customer.first_name" class="col-span-2" />
                        <x-input type="text" wire:model.defer="customer.last_name" class="col-span-2" />
                    </div>

                    <div class="col-span-6 grid grid-cols-5 gap-6">
                        <label for="first-name" class="col-span-5 block text-sm font-medium text-gray-700">Mailing
                            Address</label>
                        <x-input type="text" wire:model.defer="customer.mailing_address" class="col-span-3" />
                        <x-input type="text" wire:model.defer="customer.city" class="col-span-3" />
                        <x-input type="text" wire:model.defer="customer.state" class="col-span-1" />
                    </div>

                    <div class="col-span-6 grid grid-cols-5 gap-6">
                        <label for="first-name" class="col-span-5 block text-sm font-medium text-gray-700">Physical
                            Address</label>
                        <x-input type="text" wire:model.defer="customer.physical_address" class="col-span-3" />
                        <x-input type="text" wire:model.defer="customer.physical_city" class="col-span-3" />
                        <x-input type="text" wire:model.defer="customer.physical_state" class="col-span-1" />
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
        {{-- End Header Modals --}}
    </div>
        {{-- End Customer Header --}}

