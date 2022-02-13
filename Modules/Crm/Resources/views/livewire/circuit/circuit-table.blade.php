<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>

                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">view</span>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">archive</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse ($circuits as $circuit)
                                <tr>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ str_replace('-', ' ', $circuit['circuit_name']) }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('crm.show', ['circuit' => $circuit['circuit_name']]) }}"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            View
                                        </a>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" wire:click='archive({{ $circuit['id'] }})'
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Archive
                                        </button>
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
            </div>
        </div>
    </div>

</div>
