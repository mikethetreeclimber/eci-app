@extends('crm::layouts.master')

@section('content')

<livewire:crm::circuit.create-circuit-form />
<x-crm::section-border />
<livewire:crm::circuit.circuit-table />

@endsection
