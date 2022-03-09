<div class="m-4">
    <div wire:loading.delay="contacts">
       <x-loading />
    </div>
    <div class="pb-5 border-b border-green-200 sm:flex sm:items-center sm:justify-between">
        <h3 class="text-2xl font-bold text-gray-900 truncate">
            {{ $circuit->circuit_name }}
        </h3>
        <div class="flex space-x-4">
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <label for="mailing"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <span class="text-base-300">Import Mailing List</span>
                    <input wire:model="mailing" id="mailing" type="file" class="sr-only" />
                </label>
            </div>
            {{-- FIXME: remove this once master list is able to process --}}
            {{-- <div class="mt-3 sm:mt-0 sm:ml-4">
                <label for="contacts"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <span class="text-base-300">Import Contact List</span>
                    <input wire:model="contacts" id="contacts" type="file" class="sr-only" />
                </label>
            </div> --}}
        </div>
    </div>
    <div class="space-x-4 flex">
        @if ($customers)
            <span>
                <x-button wire:click="$set('permissionStatus', 'Approved')">
                    All Approved
                </x-button>
            </span>
            <span>
                <x-danger-button wire:click="$set('permissionStatus', '')">
                    Not Approved
                </x-danger-button>
            </span>
            <x-danger-button wire:click="confirmDestroyCustomers">Destroy Customers</x-danger-button>
        @endif
    </div>
    <x-confirmation-modal wire:model="confirmDestroyCustomers">
        <x-slot:title>
           Destroy All Customers
        </x-slot:title>
        <x-slot:content>Are You Sure? This cannot be undone </x-slot:content>
        <x-slot:footer>
            <x-danger-button wire:click="$set('confirmDestroyCustomers', 'false')">Cancel</x-danger-button>
            <x-button wire:click="destroyCustomers">Confim</x-button>
        </x-slot:footer>
    </x-confirmation-modal>
    <ul role="list" class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($customers as $customer)
            <livewire:crm::circuit.customer.customer-card :circuit="$circuit" :customer="$customer"
                :wire:key="$customer['id']" />

        @empty
            <div class="flex justify-center items-center">
                <h4 class="text-lg text-center font-bold">No Customers</h4>
            </div>
        @endforelse
    </ul>
    @if ($customers)
        <div class="flex justify-center items-center space-x-6">
            @if ($skip > 1)
                <div class="mt-4 flex justify-center items-center">
                    <x-button wire:click="back">Back</x-button>
                </div>
            @endif
            @if (number_format($skip / 3) < number_format($customersCount / 3 - 1))
                <div class="mt-4 flex justify-center items-center">
                    <x-button wire:click="next">Next</x-button>
                </div>
            @endif
        </div>
    @endif



</div>


