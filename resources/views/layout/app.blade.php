<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Cadastro de Produtos</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">        
    </head>
<body>  
        @hasSection('usuariocomun')
            @yield('usuariocomun')
        @endif
        @hasSection('lista_funcionario')
            @yield('lista_funcionario')
        @endif
        @hasSection('cad_funcionario')
            @yield('cad_funcionario')
        @endif
        @hasSection('adm')
            @yield('adm')
        @endif
        @hasSection('historico_chamado')
            @yield('historico_chamado')
        @endif
        @hasSection('novo_chamado')
            @yield('novo_chamado')
        @endif
        @hasSection('perfil')
            @yield('perfil')
        @endif
    <div class="container">        
        <main role="main">
            @hasSection('login')
                @yield('login')
            @endif
        </main>
    </div>
    
    <script src="{{ asset('js/app.js')}}" type="text/javascript"></script>    
</body>
</html>