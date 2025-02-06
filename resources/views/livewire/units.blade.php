<div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Unidades</h1>
            <p class="lead">Esta tela permite gerenciar a criação e administração das unidades.</p>
            <button type="button" class="btn btn-success" wire:click="resetModal" data-toggle="modal" data-target="#unitModal">
                <i class="fas fa-plus pr-2"></i>Nova Unidade
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="unitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editMode ? 'Editar Unidade' : 'Nova Unidade' }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'updateUnit' : 'createUnit' }}">
                        <div class="form-group">
                            <label for="fantasy_name">Nome Fantasia</label>
                            <input type="text" id="fantasy_name" class="form-control" wire:model="fantasy_name" placeholder="Ex: Voch Tech">
                            @error('fantasy_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_name">Razão Social</label>
                            <input type="text" id="company_name" class="form-control" wire:model="company_name" placeholder="Ex: Voch Tecnologia e Sistemas de Informacao Ltda">
                            @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" id="cnpj" class="form-control" wire:model="cnpj" placeholder="Ex: 00.000.000/0000-00">
                            @error('cnpj')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="flag_id">Bandeira</label>
                            <select id="flag_id" class="form-control" wire:model="flag_id">
                                <option value="">Selecione...</option>
                                @foreach ($flags as $flag)
                                    <option value="{{ $flag->id }}">{{ $flag->name }}</option>
                                @endforeach
                            </select>
                            @error('flag_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            {{ $editMode ? 'Atualizar' : 'Criar' }}
                        </button>                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Unidades -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome Fantasia</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Bandeira</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->fantasy_name }}</td>
                    <td>{{ $unit->company_name }}</td>
                    <td>{{ $unit->cnpj }}</td>
                    <td>{{ $unit->flag->name ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-primary" wire:click="editUnit({{ $unit->id }})"><i
                                class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" wire:click="deleteUnit({{ $unit->id }})"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $units->links() }}
</div>

<script>
    window.addEventListener('open-modal', () => {
        $('#unitModal').modal('show');
    });

    window.addEventListener('close-modal', () => {
        $('#unitModal').modal('hide');
    });
</script>
