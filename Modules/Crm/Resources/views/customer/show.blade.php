@extends('crm::layouts.master')

@section('content')

    <a href="{{ route('crm.show', ['circuit' => $circuit]) }}">
        < Go Back</a>

            <livewire:crm::circuit.customer.customer-header :customer="$customer" :circuit="$circuit" />

            <x-section-border />
            <livewire:crm::circuit.customer.find-contacts :customer="$customer" :circuit="$circuit" />
            <livewire:crm::circuit.customer.possible-contacts-list />


        @endsection
