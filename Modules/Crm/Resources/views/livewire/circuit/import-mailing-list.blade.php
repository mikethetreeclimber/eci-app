<div class="m-4 space-y-4">
    {{-- <div wire:loading.delay="mailing">
        <x-loading />
    </div> --}}
    <div class="pb-5 border-b border-green-200 sm:flex sm:items-center sm:justify-between">
        <h3 class="text-2xl font-bold text-gray-900 truncate">
            {{ $circuit->circuit_name }}
        </h3>
        <div class="flex space-x-4">
            {{-- <x-input-error for="mailing" /> --}}

            <div class="mt-3 sm:mt-0 sm:ml-4">

                <input type="file" id="file_upload" onchange="upload()"/>
                {{-- <button onclick="upload()">Upload</button> --}}
                {{-- <input type="file" id="my_file_input" />
                <div id='my_file_output'></div>
                <label for="mailing"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <span class="text-base-300">Import Mailing List</span>
                    <input wire:model="mailing" id="mailing" type="file" class="sr-only" />
                </label> --}}
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
    <x-confirmation-modal wire:model="confirmDestroyCustomers">
        <x-slot:title>
            Destroy All Customers
        </x-slot:title>
        <x-slot:content>Are You Sure? This cannot be undone </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-danger-button type="button" wire:click="$set('confirmDestroyCustomers', false)">Cancel
                </x-danger-button>
                <x-button wire:click="destroyCustomers">Confim</x-button>
            </div>
        </x-slot:footer>
    </x-confirmation-modal>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">

            <div class="sm:flex justify-center items-center m-2 sm:space-x-4 sm:m-4">
                <div class="mr-6 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Delete Customers</label>
                    <x-danger-button wire:click="$set('confirmDestroyCustomers', true)">Destroy</x-danger-button>
                </div>
                <div>
                    <label for="permissionStatus" class="block text-sm font-medium text-gray-700">Sort By</label>
                    <select wire:model="permissionStatus" id="permissionStatus" name="permissionStatus"
                        class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                        <option value="Approved">Approved</option>
                        <option value="">Not Approved</option>
                        <option value="PPL Approved">PPL Approved</option>
                        <option value="Refused">Refused</option>
                        <option value="No Contact">No Contact</option>
                        <option value="Defered">Defered</option>
                        <option value="Show All">Show All</option>
                    </select>
                </div>

                <div>
                    <label for="orderBy" class="block text-sm font-medium text-gray-700">Order By</label>
                    <select wire:model="orderBy" id="orderBy" name="orderBy"
                        class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                        <option value="station_name">Station Number</option>
                        <option value="unit">Unit</option>
                        <option value="last_name">Last Name</option>
                        <option value="physical_address">Service Address</option>
                        <option value="physical_city">Service City</option>
                    </select>
                </div>

                <div>
                    <label for="paginate" class="block text-sm font-medium text-gray-700">Show</label>
                    <select wire:model="paginate" id="paginate" name="paginate"
                        class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="{{ $customerCount }}">Show All</option>
                    </select>
                </div>

                <div>
                    <label for="searchBy" class="block text-sm font-medium text-gray-700">Search By</label>
                    <select wire:model="searchBy" id="searchBy" name="searchBy"
                        class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                        @foreach ($searchables as $key => $searchable)
                            <option value="{{ $key }}">{{ $searchable }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <x-input wire:model.debounce.1000ms="search" type="text" />
                </div>


            </div>
            @forelse ($customers as $customer)
                <li>
                    <a href="{{ route('crm.customer.show', ['circuit' => $circuit, 'customer' => $customer]) }}"
                        class="block hover:bg-gray-50">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="sm:flex items-center justify-between">
                                <p class="text-base text-gray-900 font-bold xs:truncate">
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                </p>
                                <x-permission-badge size="sm" :permissionStatus="$customer->permission_status" />

                                <p class="flex items-center text-sm text-gray-800">
                                    <span class="m-2 text-gray-500 text-xs">Unit</span>
                                    {{ $customer->station_name }} / {{ $customer->unit }}
                                </p>
                            </div>

                            <div class="mt-1 sm:flex sm:justify-between">
                                <div class="sm:flex sm:space-x-2">
                                    <p class="flex items-center text-sm text-gray-800">
                                        <span class="m-2 text-gray-500 text-xs">Service Address</span>
                                        {{ $customer->physical_address }}
                                        {{ $customer->physical_city }},
                                        {{ $customer->physical_state }}
                                    </p>
                                </div>
                                <div class="sm:flex sm:space-x-2">
                                    <p class="flex items-center text-sm text-gray-800">
                                        <span class="m-2 text-gray-500 text-xs">Mailing Address</span>
                                        {{ $customer->mailing_address }}
                                        {{ $customer->city }},
                                        {{ $customer->state }}
                                    </p>
                                </div>
                                <div class="mt-1 flex items-center text-sm text-gray-500 sm:mt-0">
                                    <!-- Heroicon name: solid/calendar -->
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p>
                                        Assessed on
                                        <time datetime="2020-01-07">{{ $customer->assessed_date }}</time>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>

            @empty
                <div class="flex justify-center items-center">
                    <h4 class="text-lg text-center font-bold">No Customers</h4>
                </div>
            @endforelse
        </ul>
    </div>

    @if ($customers)
        <div class="mt-4 space-x-6">
            {{ $customers->onEachSide(1)->links() }}

        </div>
    @endif

    <textarea id="json-result" style="display:none;height:500px;width:350px;"></textarea>


    @push('scripts')
        <script>
            // var result = {};

            // Method to upload a valid excel file
            function upload() {
                var files = document.getElementById('file_upload').files;
                if (files.length == 0) {
                    alert("Please choose any file...");
                    return;
                }
                var filename = files[0].name;
                var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
                if (extension == '.XLS' || extension == '.XLSX') {
                    excelFileToJSON(files[0]);
                } else {
                    alert("Please select a valid excel file.");
                }
            }

            // //Method to read excel file and convert it into JSON 
            // function excelFileToJSON(file) {
            //     try {
            //         var reader = new FileReader();
            //         reader.readAsBinaryString(file);
            //         reader.onload = function(e) {

            //             var data = e.target.result;
            //             var workbook = XLSX.read(data, {
            //                 type: 'binary'
            //             });

            //             workbook.SheetNames.forEach(function(sheetName) {
            //                 var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            //                 if (roa.length > 0) {
            //                     result[sheetName] = roa;
            //                 }
            //             });
            //             //   console.log(result);
            //             // //displaying the json result
            //             // var resultEle=document.getElementById("json-result");
            //             // resultEle.value=JSON.stringify(result, null, 4);
            //             // resultEle.style.display='block';
            //             Livewire.emit('setMailing', result);
            //         }
            //     } catch (e) {
            //         console.error(e);
            //     }
            // }

            function excelFileToJSON(file){
          try {
            var reader = new FileReader();
            reader.readAsBinaryString(file);
            reader.onload = function(e) {
 
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type : 'binary'
                });
                var result = {};
                workbook.SheetNames.forEach(function(sheetName) {
                var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                if (roa.length > 0) {
                    result[sheetName] = roa;
                }
              });
                //displaying the json result
                var resultEle=document.getElementById("json-result");
                resultEle.value=JSON.stringify(result, null, 4);
                resultEle.style.display='block';
                }
            }catch(e){
                console.error(e);
            }
      }
        </script>
    @endpush

</div>
