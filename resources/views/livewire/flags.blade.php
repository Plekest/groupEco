<div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Bandeiras</h1>
            <p class="lead">Esta tela permite gerenciar a criação e administração das bandeiras.</p>
            <button type="button" class="btn btn-success" wire:click="resetModal" data-toggle="modal"
                data-target="#flagModal">
                <i class="fas fa-plus pr-2"></i>Nova Bandeira
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="flagModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editMode ? 'Editar Flag' : 'Nova Flag' }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'updateFlag' : 'createFlag' }}">
                        <div class="form-group">
                            <label for="name">Nome da Bandeira</label>
                            <input type="text" id="name" class="form-control" wire:model="name" placeholder="Ex: Voch">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="economic_groups_id">Grupo Econômico</label>
                            <select id="economic_group_id" class="form-control" wire:model="economic_group_id">
                                <option value="">Selecione...</option>
                                @foreach ($economicGroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                            @error('economic_groups_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            {{ $editMode ? 'Atualizar' : 'Criar' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Flags -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Grupo Econômico</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flags as $flag)
                <tr>
                    <td>{{ $flag->id }}</td>
                    <td>{{ $flag->name }}</td>
                    <td>{{ $flag->economicGroup->name ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-primary" wire:click="editFlag({{ $flag->id }})"><i
                                class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" wire:click="deleteFlag({{ $flag->id }})"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $flags->links() }}
</div>

<script>
    window.addEventListener('open-modal', () => {
        $('#flagModal').modal('show');
    });

    window.addEventListener('close-modal', () => {
        $('#flagModal').modal('hide');
    });
</script>
