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

    <x-confirmation-modal wire:model="noVerifiedContacts">
        <x-slot:title>No Verified Contacts</x-slot:title>
        <x-slot:content>Sorry, currently you are not able to add attempts without first verifying contacts for the
            customer</x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-danger-button wire:click="$set('noVerifiedContacts', false)">Cancel</x-danger-button>
                <x-button wire:click="addVerifiedContact">Add Contact</x-button>
            </div>
        </x-slot:footer>
    </x-confirmation-modal>

    <div class="flex items-center justify-between space-x-3">
        <h3 class="text-gray-900 text-md font-bold truncate">
            Attempts: <span>{{ $permissionsCount }}</span>
        </h3>
        <x-button wire:click="addAttempt">Add Attempt</x-button>
    </div> 
    <div class="@if ($permissions) h-40 @else h-20 @endif overflow-y-auto mt-4">
        <div class="relative">
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
                        $permission->created_at->toDayDateTimeString(),
                        $permission->attempt_notes,
                        $permission->attempt_type,
                        ]) }" class="flex justify-between items-center">
                            <p class="text-sm font-medium text-gray-900">Type: {{ $permission->attempt_type }}</p>
                            <div class="flex justify-center items-center">
                                {{-- ClipBoard --}}
                                <button type="button"
                                    class="hidden sm:flex sm:items-center sm:justify-center relative w-9 h-9 rounded-lg text-gray-400 hover:text-gray-600 group ml-2.5"
                                    @click="navigator.clipboard.writeText(JSON.stringify(permission))">
                                    <span class="sr-only">Copy attempt</span>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        class="stroke-current transform group-hover:rotate-[-4deg] transition"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                </button>
                                {{-- Delete --}}
                                <button type="button" wire:click="remove({{ $permission->id }})"
                                    class="hidden sm:flex sm:items-center sm:justify-center relative w-9 h-9 rounded-lg text-gray-400 hover:text-gray-600 group ml-2.5">
                                    <span class="sr-only">Delete attempt</span>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        class="stroke-current transform group-hover:rotate-[-4deg] transition"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                {{-- Edit --}}
                                <button type="button" wire:click="edit({{ $permission->id }})"
                                    class="hidden sm:flex sm:items-center sm:justify-center relative w-9 h-9 rounded-lg text-gray-400 hover:text-gray-600 group ml-2.5">
                                    <span class="sr-only">Edit Attempt</span>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        class="stroke-current transform group-hover:rotate-[-4deg] transition"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-1">
                            <p
                                class="border flex flex-col border-gray-700 p-2 rounded-md bg-gray-200 shadow-lg line-clamp-2 text-sm text-gray-900">
                                <span class="text-sm text-gray-500 truncate">Notes</span>
                                {{ $permission->attempt_notes }}
                            </p>
                        </div>
                    </li>
                @empty
                    <li class="py-5">
                        <div class="mt-4 text-center font-bold text-base">No Permissioning Attempts To Show</div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
