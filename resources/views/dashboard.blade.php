<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                      <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Customers</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $customersCount }}</dd>
                      </div>
                  
                      <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Attempts</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $permissionCount }}</dd>
                      </div>
                  
                      <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Active Circuits</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $activeCircuits }}</dd>
                      </div>
                    </dl>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>