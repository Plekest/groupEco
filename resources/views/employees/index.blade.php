@extends('adminlte::page')

@section('title', 'Colaboradores')

@section('content')

    @livewire('employees')
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
