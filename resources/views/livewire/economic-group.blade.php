<div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Grupos Econômicos</h1>
            <p class="lead">Esta tela permite gerenciar a criação e administração de Grupos Econômicos.</p>
            <button type="button" class="btn btn-success" data-toggle="modal" wire:click="resetModal"
                data-target="#createEconomicGroup">
                <i class="fas fa-plus pr-2"></i>Novo Grupo Econômico
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createEconomicGroup" tabindex="-1" aria-labelledby="createEconomicGroupLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEconomicGroupLabel">Criar Grupo Econômico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'updateEconomicGroup' : 'createEconomicGroup' }}">
                        <input type="hidden" wire:model="economicGroupId">

                        <div class="form-group">
                            <label for="economicGroupName">Nome do Grupo</label>
                            <input type="text" class="form-control" id="economicGroupName" wire:model="name" required placeholder="Ex: Group ECO">
                        </div>

                        <button type="submit" class="btn btn-success">
                            {{ $editMode ? 'Atualizar' : 'Criar' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Tabela -->
    @if (!isset($economicGroups) || $economicGroups->isEmpty())
        <p class="ml-4 text-sm/relaxed">Nenhum Grupo Econômico cadastrado</p>
    @else
        <table class="table table-bordered mt-4">
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
                            <button type="button" class="btn btn-primary"
                                wire:click="editEconomicGroup({{ $group->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger"
                                wire:click="deleteEconomicGroup({{ $group->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginacao -->
        <div class="d-flex justify-content-center">
            {{ $economicGroups->links() }}
        </div>

    @endif
    <!-- End Tabela -->

</div>

<script>
    window.addEventListener('open-modal', event => {
        $('#createEconomicGroup').modal('show');
    });

    window.addEventListener('close-modal', event => {
        $('#createEconomicGroup').modal('hide');
    });
</script>
