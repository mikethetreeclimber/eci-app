<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block w-full">
                <div class="overflow-hidden sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Reg / Sub</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name / Service Address</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone #'s</th>
                               
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse ($PPLContacts as $contact)
                                <tr>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">
                                                    <span class="underline font-medium mt-1">Region</span>
                                                    <br>
                                                    {{ $contact->region }}
                                                    <br>
                                                    <span class="underline font-medium mt-1">Substation</span>
                                                    <br>
                                                    {{ $contact->substation_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                   
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $contact->customer_name }}
                                                    {{-- <br>
                                                    Service Address
                                                    <br>
                                                    <span class="truncate">{{ $contact->service_address }}</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Primary
                                                    <br>
                                                    {{ $contact->primary_phone }}
                                                    <br>
                                                    Alternative
                                                    <br>
                                                    {{ $contact->alt_phone }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                              
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $contact->email_address }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center" colspan="4">
                                        <h2>No Circuits</h2>
                                        <p>There are no circuits currently active.</p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                @if ($PPLContacts)
                    <div class="mt-4 space-x-6">
                        {{ $PPLContacts->links() }}

                    </div>
                @endif

            </div>
        </div>
    </div>


</div>

     {{-- @dump($contact) --}}
                                {{-- \"id" => 17972
                            "customer_id" => null
                            "region" => "NE"
                            "feeder_id" => 15702
                            "substation_name" => "Tannersville"
                            "customer_name" => "INTERNET INSPIRATIONS INC"
                            "service_address" => "3121 ROUTE 611, SUITE 3 STROUDSBURG, PA 18360"
                            "mailing_address" => "PO BOX 199 TANNERSVILLE, PA 18372"
                            "primary_phone" => "800-294-4876"
                            "alt_phone" => null
                            "email_address" => "lucas@internetinspirations.com"
                            "revenue_class_desc" => "Commercial - Other"
                            "deleted_at" => null
                            "created_at" => "2022-02-21 21:10:13"
                            "updated_at" => "2022-02-21 21:10:13" --}}
