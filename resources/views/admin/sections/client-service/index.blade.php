@extends('admin.layouts.master')

@section('title', 'Chăm sóc khách hàng')

@section('contents')

@livewire('client-service.search-client')
@livewire('client-service.list-client')
@livewire('client-service.add-client')

@endsection