@extends('adminlte::page')

@section('title', 'Grupos Econômicos')

@section('content_header')
    <div class="jumbotron jumbotron-flui mb-2">
        <div class="container">
            <h1 class="display-4">Grupos Econômicos</h1>
            <p class="lead">Gerencie aqui a criação e organização de Grupos Econômicos.</p>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createEconomicGroup">
                <i class="fas fa-plus pr-2"></i>Novo Grupo Econômico
            </button>
        </div>
    </div>
@stop

@section('content')
    <!-- Start Modal -->
    <div class="modal fade" id="createEconomicGroup" tabindex="-1" aria-labelledby="createEconomicGroupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEconomicGroupLabel">Criar Grupo Econômico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createEconomicGroupForm">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nome do Grupo</label>
                            <input type="text" class="form-control" id="economicGroupName" placeholder="Digite o nome" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="saveEconomicGroup">Criar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    
    @if ($economicGroups->isEmpty())
        <p class="ml-4 text-sm/relaxed">Nenhum Grupo Econômico cadastrado</p>
    @else    
    <table class="table table-bordered mt-0" id="economicGroupsTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome do Grupo Econômico</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($economicGroups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>
                        <button type="button" class="btn btn-primary"><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#saveEconomicGroup').click(function() {
            $('#createEconomicGroupForm').submit();
        });

        $('#createEconomicGroupForm').submit(function(event) {
            event.preventDefault();
            let name = $('#economicGroupName').val();

            $.ajax({
                url: "{{ route('economic_groups.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name
                },
                success: function(response) {
                    $('#createEconomicGroup').modal('hide');
                    $('#economicGroupName').val('');
                    
                    let newRow = `<tr>
                                    <td>${response.id}</td>
                                    <td>${response.name}</td>
                                  </tr>`;
                    $('#economicGroupsTable tbody').append(newRow);
                },
                error: function(xhr) {
                    alert("Erro ao criar o Grupo Econômico");
                }
            });
        });
    });
</script>
@stop
