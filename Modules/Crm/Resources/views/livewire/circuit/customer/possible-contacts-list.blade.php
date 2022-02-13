    <div class="max-w-screen mx-auto sm:px-6 lg:px-8">
        @if ($searchBy == 'byName')
            <x-button wire:click='searchBestResults'> Search Best Results </x-button>
        @endif
        @if ($searchBy == 'bestResults')
            <x-button wire:click='searchByName'> Search By Last Name </x-button>
        @endif
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                @if ($fuzzySearchSent === true)
                    @if ($possibleContacts !== [])
                        @foreach ($possibleContacts as $possibleContact)
                            <li>
                                <a href="#" class="block hover:bg-gray-50">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex items-center">
                                           
                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                <div>
                                                    <p class="text-sm font-medium text-indigo-600 truncate">{{ $possibleContact['customer_name'] }}</p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <!-- Heroicon name: solid/mail -->
                                                        {{ $possibleContact['service_address'] }}
                                                    </p>
                                                </div>
                                                <div class="block">
                                                    <div>
                                                        <p class="text-sm text-gray-900">
                                                            {{ $possibleContact['primary_phone'] }}
                                                            {{ $possibleContact['alt_phone'] }}
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            <!-- Heroicon name: solid/check-circle -->
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Completed phone screening
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Heroicon name: solid/chevron-right -->
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            {{-- <li class="py-5">
                                <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <a href="#" class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            
                                        </a>
                                    </h3>
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <a href="#" class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            
                                        </a>
                                    </h3>
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <a href="#" class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $possibleContact['primary_phone'] }}
                                        </a>
                                    </h3>
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <a href="#" class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $possibleContact['alt_phone'] }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600 line-clamp-2">

                                        Alias inventore ut autem optio
                                        voluptas et
                                        repellendus. Facere totam quaerat quam quo laudantium cumque eaque excepturi
                                        vel.
                                        Accusamus
                                        maxime ipsam reprehenderit rerum id repellendus rerum. Culpa cum vel natus. Est
                                        sit
                                        autem
                                        mollitia.</p>
                                </div>
                            </li> --}}
                        @endforeach
                    @else
                        <li class="py-5">
                            <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                                <h3 class="text-xl font-semibold text-gray-800">
                                    No Contacts Found
                                </h3>
                                {{-- <p class="mt-1 text-sm text-gray-600 line-clamp-2">Cum qui rem deleniti. Suscipit in dolor veritatis
                                sequi aut. Vero ut earum quis deleniti. Ut a sunt eum cum ut repudiandae possimus. Nihil ex
                                tempora neque cum consectetur dolores.</p> --}}
                            </div>
                        </li>
                    @endif
            </ul>
            @endif

    </div>
    {{-- <div class="mt-6">
            <a href="#"
                class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                View all </a>
        </div> --}}
    </div>
