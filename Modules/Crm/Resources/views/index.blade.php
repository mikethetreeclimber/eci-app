@extends('crm::layouts.master')

@section('header')
    Dashboard
@endsection
@section('content')
    <div x-data="{activeTab: 0}">
        <div>

            <div class="sm:block">
                <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                        <button
                            class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                            :class="activeTab === 0 ? 'text-gray-900' : ''" @click="activeTab = 0">
                            PPL Meter List
                        </button>
                        <button
                            class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                            :class="activeTab === 1 ? 'text-gray-900' : ''" @click="activeTab = 1">
                            Circuits
                        </button>
                        <button
                            class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                            :class="activeTab === 2 ? 'text-gray-900' : ''" @click="activeTab = 2">
                            Planned Units
                        </button>
                </nav>
            </div>
        </div>
        <div class="m-2">
            <div x-show="activeTab===0">
                <livewire:ppl-meter-list-table />
            </div>
            <div x-show="activeTab===1">
                <livewire:crm::circuit.circuit-table />
            </div>
            <div x-show="activeTab===2">
                Content 3
            </div>
        </div>
    </div>

@endsection

