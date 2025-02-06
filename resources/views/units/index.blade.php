@extends('adminlte::page')

@section('title', 'Unidades')

@section('content')

    @livewire('units')
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
