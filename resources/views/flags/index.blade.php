@extends('adminlte::page')

@section('title', 'Bandeiras')

@section('content')

    @livewire('flags')
    @livewireScripts

@stop


@section('css')
    <style>
        .content>.container-fluid {
            padding: 0 !important;
        }

        .content {
            padding: 0 !important;
        }
    </style>
@stop

@section('js')
@stop
