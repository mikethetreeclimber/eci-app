@extends('crm::layouts.master')

@section('content')
    <a href="{{ url()->previous() }}">
        < Go Back</a>

         
            <livewire:crm::circuit.customer.customer-header :customer="$customer" :circuit="$circuit" />

            <main class="flex-grow w-full max-w-7xl mx-auto space-y-6 lg:space-y-0 lg:flex mt-3 lg:space-x-6">
                <x-crm::customer-section-wrapper>
                    <x-slot:title>
                        Customer Details
                    </x-slot:title>
                    <x-slot:content>
                        <livewire:crm::circuit.customer.customer-details :customer="$customer" :circuit="$circuit" />
                    </x-slot:content>
                </x-crm::customer-section-wrapper>
                <x-crm::customer-section-wrapper>
                    <x-slot:title>
                        Permissions
                    </x-slot:title>
                    <x-slot:content>
                        <livewire:crm::circuit.customer.customer-permissions :customer="$customer" :circuit="$circuit" />
                    </x-slot:content>
                </x-crm::customer-section-wrapper>
                <x-crm::customer-section-wrapper>
                    <x-slot:title>
                        Contact Information
                    </x-slot:title>
                    <x-slot:content>
                        <livewire:crm::circuit.customer.customer-contacts :customer="$customer" :circuit="$circuit" />
                    </x-slot:content>
                </x-crm::customer-section-wrapper>
                
            </main>

            <section id="possibleContacts" class="mt-3">
                <livewire:crm::circuit.customer.possible-contacts-list />
            </section>


           
        @endsection
