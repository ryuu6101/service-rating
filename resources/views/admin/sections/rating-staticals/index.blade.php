@extends('admin.layouts.master')

@section('title', 'Thống kê')

@section('contents')

{{-- @livewire('rating-staticals.search-statical') --}}
{{-- @livewire('rating-staticals.list-statical') --}}
@livewire('rating-staticals.statical-chart')
@livewire('rating-staticals.list-detail')
@livewire('rating-staticals.update-statical')
@livewire('rating-staticals.delete-statical')

@endsection