@extends('layout.app')
@section('lista_funcionario')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Call Center</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/adm">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/funcionarios">Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cadastrofuncionario">Cadastrar Clientes</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$usuario->nome}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/perfil-adm">Perfil</a>
          <a class="dropdown-item" href="/logout">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>


<div class="row">
            <div class="container col-md-8 offset-md-2">
                <div class="card border">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Clientes</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Senha</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($funcionarios as $fun)
                                <tr>
                                    <td>{{$fun->id}}</td>
                                    <td>{{$fun->nome}}</td>
                                    <td>{{$fun->login}}</td>
                                    <td>{{$fun->senha}}</td>
                                    <td><a href="/funcionario/editar/{{$fun->id}}" class="btn btn-sm btn-primary">Editar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
@endsection