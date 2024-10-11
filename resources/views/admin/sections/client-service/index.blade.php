@extends('admin.layouts.master')

@section('title', 'Khảo sát khách hàng')

@section('contents')

@livewire('client-service.add-survey')
@livewire('client-service.search-client')
@livewire('client-service.list-client')
{{-- @livewire('client-service.add-client') --}}

@endsection