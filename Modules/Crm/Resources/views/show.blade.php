@extends('crm::layouts.master')

@section('content')
    <div class="px-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-2xl font-bold text-gray-900 truncate">
                {{ $circuit->circuit_name }}
            </h3>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <label for="mailing-list"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="text-base-300">Import Mailing List</span>
                    <input id="mailing-list"  type="file" class="sr-only" />
                </label>
            </div>
        </div>
    </div>

@endsection
