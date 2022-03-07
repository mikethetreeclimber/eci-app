@extends('crm::layouts.master')

@section('content')
<a class="hover:text-green-700" href="{{ route('crm.index') }}">< Go Back</a>
        
        <livewire:crm::circuit.import-mailing-list :circuit="$circuit"/>
       
@endsection
