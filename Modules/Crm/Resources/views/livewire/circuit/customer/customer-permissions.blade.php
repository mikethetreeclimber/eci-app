<div>
    <x-dialog-modal wire:model="addAttemptModal">
        <x-slot:title>
            <div class="text-center">Attempt Form</div>
        </x-slot:title>
        <x-slot:content>
            <x-form-section submit="submit" title="Add Attempt" description="Be sure to make good notes">
                <x-slot:form>
                    <div class="col-span-2">
                        <label for="attempt_number" class="block text-sm font-medium text-gray-700">
                            Attempt Number
                        </label>
                    </div>
                    <div class="col-span-4">
                        <x-input type="text" wire:model="attempt_number" />
                    </div>
                    <div class="col-span-2">
                        <label for="attempt_type" class="block text-sm font-medium text-gray-700">
                            Type
                        </label>
                    </div>
                    <div class="col-span-4">
                        <x-input-error for="attempt_type" />

                        <select id="attempt_type" wire:model="attempt_type"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                            <option selected>Select An Option</option>
                            <option>Phone</option>
                            <option>Verbal</option>
                            <option>Email</option>
                            <option>Mail</option>
                            <option>Verbal</option>
                            <option>Door Hanger</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700">
                            Notes
                        </label>
                    </div>
                    <div class="col-span-6">
                        <x-input-error for="attempt_notes" />
                        <x-text-area model="attempt_notes" rows="6" placeholder="Add Notes Here...">Notes</x-text-area>
                    </div>


                </x-slot:form>
                <x-slot:actions>
                    <x-button type="submit">Add Attempt</x-button>
                </x-slot:actions>

            </x-form-section>

        </x-slot:content>
        <x-slot:footer>
            <div class="space-y-2">
                <x-danger-button wire:click="$set('addAttemptModal', false)">Cancel</x-danger-button>
            </div>
        </x-slot:footer>
    </x-dialog-modal>
    <div class="flex items-center justify-between space-x-3">
        <h3 class="text-gray-900 text-md font-bold truncate">
            Attempts: <span>{{ $permissionsCount }}</span>
        </h3>
        <x-button wire:click="$set('addAttemptModal', true)">Add Attempt</x-button>
    </div>

    <ul role="list" class="divide-y divide-gray-200">
        @forelse ($permissions as $permission)
            <li class="relative bg-white py-5 px-4 ">
                <div class="flex justify-between space-x-3">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900"># {{ $permission->attempt_number }}</p>
                    </div>

                    <time datetime="{{ $permission->created_at }}"
                        class="flex-shrink-0 whitespace-nowrap text-sm text-gray-900">
                        {{ $permission->created_at->toDayDateTimeString() }}
                    </time>
                </div>
                <div x-data="{permission: @js([
                    'date_time' => $permission->created_at->toDayDateTimeString().'/n',
                    'notes' => $permission->attempt_notes,
                    '/n',
                    'type' => $permission->attempt_type,
                    ]) }"
                    class="flex justify-between items-center">
                    <p class="text-sm font-medium text-gray-900">Type: {{ $permission->attempt_type }}</p>
                    <button type="button"
                        class="hidden sm:flex sm:items-center sm:justify-center relative w-9 h-9 rounded-lg text-gray-400 hover:text-gray-600 group ml-2.5"
                        @click="navigator.clipboard.writeText(JSON.stringify(permission))">
                        <span class="sr-only">Copy code</span>

                        <svg aria-hidden="true" width="32" height="32" viewBox="0 0 32 32" fill="none"
                            class="stroke-current transform group-hover:rotate-[-4deg] transition" style="">
                            <path
                                d="M12.9975 10.7499L11.7475 10.7499C10.6429 10.7499 9.74747 11.6453 9.74747 12.7499L9.74747 21.2499C9.74747 22.3544 10.6429 23.2499 11.7475 23.2499L20.2475 23.2499C21.352 23.2499 22.2475 22.3544 22.2475 21.2499L22.2475 12.7499C22.2475 11.6453 21.352 10.7499 20.2475 10.7499L18.9975 10.7499"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M17.9975 12.2499L13.9975 12.2499C13.4452 12.2499 12.9975 11.8022 12.9975 11.2499L12.9975 9.74988C12.9975 9.19759 13.4452 8.74988 13.9975 8.74988L17.9975 8.74988C18.5498 8.74988 18.9975 9.19759 18.9975 9.74988L18.9975 11.2499C18.9975 11.8022 18.5498 12.2499 17.9975 12.2499Z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.7475 16.2499L18.2475 16.2499" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M13.7475 19.2499L18.2475 19.2499" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <g class="opacity-0 transition-opacity">
                                <path d="M15.9975 5.99988L15.9975 3.99988" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M19.9975 5.99988L20.9975 4.99988" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M11.9975 5.99988L10.9975 4.99988" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="mt-1">
                    <p
                        class="border flex flex-col border-gray-700 p-2 rounded-md bg-gray-200 shadow-lg line-clamp-2 text-sm text-gray-900">
                        <span class="text-sm text-gray-500 truncate">Notes</span>
                        {{ $permission->attempt_notes }}

                    </p>
                </div>
            </li>

            {{-- <!-- More messages... -->
    </ul>
    <ul role="list" class="-my-5 divide-y divide-gray-200">
        @forelse ($permissions as $permission)
            <li class="py-5 grid grid-cols-3">
                <div class="mt-2 col-span-2">
                    <p class="mt-1 text-gray-700 text-base text-center">
                        Attempt Number: {{ $permission->attempt_number }}
                    </p>
                </div>
                <div class="mt-2 col-span-2">
                    <p class="mt-1 text-gray-700 text-base text-center">
                        Added: {{ $permission->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="mt-2 col-span-2">
                    <p class="mt-1 text-gray-700 text-base text-center">
                        Attempt Type: {{ $permission->attempt_type }}
                    </p>
                </div>
                <div class="mt-1 col-span-3 flex justify-center items-center">
                    <div>
                        <span class="text-sm text-gray-500 text-center">Attempt Notes:</span>
                        <p class="mt-1 text-gray-700 text-base">
                            {{ $permission->attempt_notes }}
                        </p>
                    </div>
                </div>
                <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                    <h3 class="text-sm font-semibold text-gray-800">
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 line-clamp-2">


                    </p>
                </div>
            </li> --}}
        @empty
            <li class="py-5">

                <div class="mt-4 text-center font-bold text-base">No Permissioning Attempts To Show</div>
            </li>
        @endforelse
    </ul>
    <script>
        function handleClick(e) {
            console.log(e)
        }
    </script>
</div>
