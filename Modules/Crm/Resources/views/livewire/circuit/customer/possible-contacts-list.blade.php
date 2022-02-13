    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="flow-root mt-6">
            <ul role="list" class="-my-5 divide-y divide-gray-200">
                @if ($fuzzySearchSent === true)
                    @if ($possibleContacts['bestResults'] !== [])
                        @foreach ($possibleContacts['bestResults'] as $possibleContact)
                            <li class="py-5">
                                <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <a href="#" class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $possibleContact['customer_name'] }}
                                        </a>
                                    </h3>
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <a href="#" class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $possibleContact['service_address'] }}
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
                            </li>
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
