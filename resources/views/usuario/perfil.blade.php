@extends('layout.app')
@section('perfil')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Call Center</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Novo Chamado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Historico de Chamados</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$usuario->nome}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Perfil</a>
          <a class="dropdown-item" href="/logout">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>


<div class="container">
            <div class="card text-center">
            <div class="card-header">Alteração do Perfil</div>            
            <div class="card-body">
            <form action="/editarperfil" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="nome">Nome do funcionário</label>
                            <input type="text" id="nome" name="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" value="{{$perfil->nome}}">
                        @if($errors->has('nome'))
                            <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                        @endif
                        </div>                      
                        <div class="form-group">
                            <label for="senha">Senha do funcionário</label>
                            <input type="password" id="senha" name="senha" class="form-control {{ $errors->has('senha') ? 'is-invalid' : '' }}" value="{{$perfil->senha}}">
                            @if($errors->has('senha'))
                            <div class="invalid-feedback">{{$errors->first('senha')}}</div>
                        @endif
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">Salvar</button>
                    </form>
            </div>
            
            </div>
        </div>

@endsection