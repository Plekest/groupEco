@extends('adminlte::page')

@section('title', 'Grupos Econômicos')

@section('content')

    @livewire('economic-group')
    @livewireScripts

@stop 


@section('css')
<style>
    .content > .container-fluid {
        padding: 0 !important;
    }
    .content {
        padding: 0 !important;
    }
</style>
@stop

@section('js')
@stop
