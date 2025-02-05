<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Excluir Conta
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Uma vez que sua conta for excluída, todos os seus dados serão permanentemente apagados. Antes de excluir, faça backup de qualquer informação que deseja manter.
        </p>
    </header>

    <!-- Botão para abrir a modal -->
    <div class="form-group">
        <div class="col-sm-10 mt-4">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
                Excluir Conta
            </button>
        </div>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Depois que sua conta for excluída, não será possível recuperar os seus dados. Digite sua senha para confirmar a exclusão.</p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Digite sua senha" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Excluir Conta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
