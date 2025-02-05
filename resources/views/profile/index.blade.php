@extends('adminlte::page')

@section('title', 'Grupos Econômicos')

@section('content_header')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Perfil</h1>
            <p class="lead">Esta tela permite gerenciar seu cadastro.</p>
        </div>
    </div>
@stop

@section('content')
    <div class=" border">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
@stop

@section('js')
@stop
