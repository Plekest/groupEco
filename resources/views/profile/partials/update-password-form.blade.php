<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Atualizar Senha
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Certifique-se de usar uma senha longa e aleatória para manter sua conta segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group align-items-center">
            <label for="update_password_current_password" class="col-sm-2 col-form-label">Senha Atual</label>
            <div class="col-sm-10">
                <input id="update_password_current_password" name="current_password" type="password"
                    class="form-control" autocomplete="current-password" />
                @if ($errors->updatePassword->has('current_password'))
                    <span class="text-danger">{{ $errors->updatePassword->first('current_password') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group align-items-center">
            <label for="update_password_password" class="col-sm-2 col-form-label">Nova Senha</label>
            <div class="col-sm-10">
                <input id="update_password_password" name="password" type="password" class="form-control"
                    autocomplete="new-password" />
                @if ($errors->updatePassword->has('password'))
                    <span class="text-danger">{{ $errors->updatePassword->first('password') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group align-items-center">
            <label for="update_password_password_confirmation" class="col-sm-2 col-form-label">Confirmar Senha</label>
            <div class="col-sm-10">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="form-control" autocomplete="new-password" />
                @if ($errors->updatePassword->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->updatePassword->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 mt-4">
                <button type="submit" class="btn btn-success">Salvar</button>
                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400 ms-3">Salvo com Sucesso!</p>
                @endif
            </div>
        </div>
    </form>
</section>
