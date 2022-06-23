<div>

    <x-crm::form-section submit="submit">
        <x-slot name="title">
            {{ __('Add A Circuit') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add a Circuit to the table below by adding the required information.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 md:col-span-3 grid grid-cols-3 gap-6">
                <div class="col-span-3">
                    <label for="circuit_name" class="block text-sm font-medium text-gray-700"> Circuit Name </label>
                    <div class="mt-1 flex rounded-md shadow-sm">

                        <input type="text" wire:model="circuit_name" id="circuit_name"
                            class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                            placeholder="Circuit Name">
                    </div>
                </div>
            </div>
            <div class="col-span-6 md:col-span-3 grid grid-cols-3 gap-6">
                <div class="col-span-3 ">
                    <label for="city" class="block text-sm font-medium text-gray-700"> Circuit Town/City </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="text" wire:model="city" id="city"
                            class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                            placeholder="Town/City">
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="actions">

            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Save</button>
        </x-slot>
    </x-crm::form-section>
</div>
