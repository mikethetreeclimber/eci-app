@extends('crm::layouts.master')

@section('content')

    <a href="{{ route('crm.show', ['circuit' => $circuit]) }}">
        < Go Back</a>
            <div class="flex items-center justify-center">
                <div><livewire:crm::circuit.customer.find-contacts :customer="$customer" :circuit="$circuit" /></div>
            </div>

            <livewire:crm::circuit.customer.customer-header :customer="$customer" :circuit="$circuit" />
            <x-crm::section-border />
            <livewire:crm::circuit.customer.possible-contacts-list />


        @endsection
