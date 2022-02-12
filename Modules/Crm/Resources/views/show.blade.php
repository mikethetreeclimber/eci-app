@extends('crm::layouts.master')

@section('content')
        
        <livewire:crm::circuit.import-mailing-list :circuit="$circuit"/>

@endsection
