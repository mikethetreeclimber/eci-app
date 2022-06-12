<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <label for="mobile-search-candidate" class="sr-only">Search</label>
                <label for="desktop-search-candidate" class="sr-only">Search</label>
                <div class="flex rounded-md shadow-sm">
                    <div class="relative flex-grow focus-within:z-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Heroicon name: solid/search -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="mobile-search-candidate" id="mobile-search-candidate"
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:hidden border-gray-300"
                            placeholder="Search">
                        <input type="text" name="desktop-search-candidate" id="desktop-search-candidate"
                            class="hidden focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-l-md pl-10 sm:block sm:text-sm border-gray-300"
                            placeholder="Search candidates">
                    </div>
                    <button type="button"
                        class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <!-- Heroicon name: solid/sort-ascending -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                        </svg>
                        <span class="ml-2">Sort</span>
                        <!-- Heroicon name: solid/chevron-down -->
                        <svg class="ml-2.5 -mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="relative min-h-screen flex flex-col">
        <div class="flex-grow w-full mx-auto lg:flex">
            <!-- Left sidebar & main wrapper -->
            <div class="flex-1 min-w-0 xl:flex">
                <div
                    class="border-b border-gray-200 xl:border-b-0 xl:flex-shrink-0 xl:w-64 xl:border-r xl:border-gray-200">
                    <div class="h-full sm:pl-6 lg:pl-8 xl:pl-0">
                        <!-- Start left column area -->
                        <div class="h-full relative" style="min-height: 12rem">
                            <nav class="space-y-1" aria-label="Sidebar">
                                <!-- Current: "bg-gray-100 text-gray-900 hover:text-gray-900 hover:bg-gray-100", Default: "text-gray-600 hover:text-gray-900 hover:bg-gray-50" -->
                                <a href="#"
                                    class="bg-green-400 text-green-900 hover:text-gray-900 hover:bg-gray-100 group flex items-center px-2 py-2 text-sm font-medium">
                                    <!--
                                    Heroicon name: outline/home
                          
                                    Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500"
                                  -->
                                    <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="flex-1"> Dashboard </span>
                                </a>

                                <a href="#"
                                    class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/users -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="flex-1"> Team </span>

                                    <!-- Current: "bg-white", Default: "bg-gray-100 group-hover:bg-gray-200" -->
                                    <span
                                        class="bg-gray-100 group-hover:bg-gray-200 ml-3 inline-block py-0.5 px-3 text-xs font-medium rounded-full">
                                        3 </span>
                                </a>

                                <a href="#"
                                    class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/folder -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                    <span class="flex-1"> Projects </span>

                                    <span
                                        class="bg-gray-100 group-hover:bg-gray-200 ml-3 inline-block py-0.5 px-3 text-xs font-medium rounded-full">
                                        4 </span>
                                </a>

                                <a href="#"
                                    class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/calendar -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="flex-1"> Calendar </span>
                                </a>

                                <a href="#"
                                    class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/inbox -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <span class="flex-1"> Documents </span>

                                    <span
                                        class="bg-gray-100 group-hover:bg-gray-200 ml-3 inline-block py-0.5 px-3 text-xs font-medium rounded-full">
                                        12 </span>
                                </a>

                                <a href="#"
                                    class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                    <!-- Heroicon name: outline/chart-bar -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span class="flex-1"> Reports </span>
                                </a>
                            </nav>
                        </div>
                        <!-- End left column area -->
                    </div>
                </div>

                <div class="lg:min-w-0 lg:flex-1">
                    <div class="h-full py-6 px-4 sm:px-6 lg:px-8">
                        <!-- Start main area-->
                        <div class="relative h-full" style="min-height: 36rem">
                            @if (auth()->user()->is_admin)
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div>
                                            <livewire:import-contact-list />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                            <div>
                                                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                                    <div
                                                        class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                                        <dt class="text-sm font-medium text-gray-500 truncate">Total
                                                            Customers</dt>
                                                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                                            {{ $customersCount }}</dd>
                                                    </div>

                                                    <div
                                                        class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                                        <dt class="text-sm font-medium text-gray-500 truncate">Total
                                                            Attempts</dt>
                                                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                                            {{ $permissionCount }}</dd>
                                                    </div>

                                                    <div
                                                        class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                                        <dt class="text-sm font-medium text-gray-500 truncate">Total
                                                            Active Circuits</dt>
                                                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                                            {{ $activeCircuits }}</dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <!-- End main area -->
                    </div>
                </div>
            </div>

            <div class="pr-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0">
                <div class="h-full pl-6 py-6 lg:w-80">
                    <!-- Start right column area -->
                    <div class="h-full relative" style="min-height: 16rem">
                        Right
                    </div>
                    <!-- End right column area -->
                </div>
            </div>
        </div>
    </div>


    {{-- <script>
            function extractDriver() {
        var dataReceiveData, dataValues, findSub, jsonIn, jsonResponseData, responseData, utilIn, workorderNum;
        workorderNum = "2021-8849";
        jsonIn = {
          "protocol": "GETVIEWDATA",
          "ViewDefinitionGuid": "{3510C114-0B44-451B-902D-B3B013AE4794}",
          "ViewFilter": {
            "FilterName": "WO #",
            "FilterValue": "XXX"
          },
          "ResultFormat": "DDOTable"
        };
        // findSub = jsonIn.get("ViewFilter");
        // findSub.update({
        //   "FilterValue": workorderNum
        // });
        utilIn = "https://ppl01.geodigital.com:8382/DDOProtocol/GETVIEWDATA";
        responseData = fetch.post(utilIn, {
          "json": jsonIn,
          "auth": ["ECI\\eci christian", "andersoneci"],
          "verify": false
        });
        jsonResponseData = responseData.json();
        dataReceiveData = jsonResponseData.get("DataSet");
        dataValues = dataReceiveData.get("Data");
        console.log(dataValues, dataReceiveData, jsonResponseData);
      }

      extractDriver() 
    </script> --}}
</x-app-layout>
