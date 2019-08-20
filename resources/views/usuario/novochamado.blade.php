@extends('layout.app')
@section('novo_chamado')

<style>
        
        .navbar { margin-bottom: 20px; }
        :root { --jumbotron-padding-y: 10px; }
        .jumbotron {
          padding-top: var(--jumbotron-padding-y);
          padding-bottom: var(--jumbotron-padding-y);
          margin-bottom: 0;
          background-color: #fff;
        }
        @media (min-width: 768px) {
          .jumbotron {
            padding-top: calc(var(--jumbotron-padding-y) * 2);
            padding-bottom: calc(var(--jumbotron-padding-y) * 2);
          }
        }
        .jumbotron p:last-child { margin-bottom: 0; }
        .jumbotron-heading { font-weight: 300; }
        .jumbotron .container { max-width: 40rem; }
        .btn-card { margin: 4px; }
        .btn { margin-right: 5px; }
</style>


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


<main role="main">
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Escreva aqui seu novo Chamado</h1>
    <form method="POST" action="/novochamado" enctype="multipart/form-data">
      @csrf
      <div class="form-group text-left">
      <select class="form-control {{ $errors->has('responsavel') ? 'is-invalid' : '' }}" name="responsavel">
        <option value="0">Escolha um responsável pelo seu chamado...</option>
        @foreach($responsaveis as $r)
        <option value="{{$r->id}}">{{$r->nome}}</option>
        @endforeach        
      </select>
      @if($errors->has('responsavel'))
            <div class="invalid-feedback">{{$errors->first('responsavel')}}</div>
        @endif
      </div>
      <div class="form-group text-left">
        <label for="mensagem">Sua menssagem</label>
        <textarea class="form-control {{ $errors->has('mensagem') ? 'is-invalid' : '' }}" id="mensagem" name="mensagem" rows="3"></textarea>
        @if($errors->has('mensagem'))
            <div class="invalid-feedback">{{$errors->first('mensagem')}}</div>
        @endif
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
        <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
      </div>
      <p>
        <button type="submit" class="btn btn-primary my-2">Enviar</button>
        <button type="reset" class="btn btn-secondary my-2">Cancelar</button>
      </p>
    </form>
  </div>
</section>

</main>
@endsection