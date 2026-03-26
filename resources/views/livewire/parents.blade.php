@extends('layouts.master')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.parents') }}
    </li>
@endsection
@section('content')
    @livewire('add-parent')
@endsection
