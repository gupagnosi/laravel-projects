@extends('layout.app')

@section('login')
<style>
    body{
        margin-top: 12%;
    }
</style>
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Login</h5>
            <form method="POST" action="/login">
            @csrf
                <div class="form-group">
                <label for="login">Login</label>
                    <input type="text" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }} " name="login" 
                       id="login" placeholder="Informe o usuario">
                       @if($errors->has('login'))
                            <div class="invalid-feedback">{{$errors->first('login')}}</div>
                        @endif
                </div>
                <div class="form-group">
                <label for="senha">Senha</label>
                    <input type="password" class="form-control {{ $errors->has('senha') ? 'is-invalid' : '' }}" name="senha" 
                       id="senha" placeholder="Informe a senha">

                       @if($errors->has('senha'))
                            <div class="invalid-feedback">{{$errors->first('senha')}}</div>
                        @endif
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@endsection
