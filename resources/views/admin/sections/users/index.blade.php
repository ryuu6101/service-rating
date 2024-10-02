@extends('admin.layouts.master')

@section('title', 'Quản lý tài khoản')

@section('contents')

@livewire('users.list-user')
@livewire('users.crud-user')

@endsection