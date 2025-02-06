<div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Funcionários</h1>
            <p class="lead">Esta tela permite gerenciar a criação e administração dos funcionários.</p>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#employeeModal">
                <i class="fas fa-plus pr-2"></i>Novo Funcionário
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="employeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editMode ? 'Editar Funcionário' : 'Novo Funcionário' }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'updateEmployee' : 'createEmployee' }}">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" id="name" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" class="form-control" wire:model="cpf">
                            @error('cpf')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="unit_id">Unidade</label>
                            <select id="unit_id" class="form-control" wire:model="unit_id">
                                <option value="">Selecione...</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->fantasy_name }}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Funcionários -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Unidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->cpf }}</td>
                    <td>{{ $employee->unit->fantasy_name ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-primary" wire:click="editEmployee({{ $employee->id }})"><i
                                class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" wire:click="deleteEmployee({{ $employee->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $employees->links() }}
</div>

<script>
    window.addEventListener('open-modal', () => {
        $('#employeeModal').modal('show');
    });

    window.addEventListener('close-modal', () => {
        $('#employeeModal').modal('hide');
    });
</script>
