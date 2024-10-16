@extends('admin.layouts.master')

@section('title', 'Ảnh banner')

@section('contents')

@livewire('banner-images.list-image')
@livewire('banner-images.update-image')
@livewire('banner-images.delete-image')

@endsection