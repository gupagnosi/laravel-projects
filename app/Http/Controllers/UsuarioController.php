<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\RestricaoMiddleware;
use App\Usuario;
use App\Chamado;
use App\HistoricoChamado;
use Illuminate\Support\Facades\Input;

class UsuarioController extends Controller
{
    
    public function logar(Request $request){
        $regras = [
            'login' => 'required',
            'senha' => 'required'        
        ];

        $mensagens = [
            'required' => ':attribute não pode estar em branco!'            
        ];
        // validar os inputs
        $request->validate($regras,$mensagens);
        // tabela -- campo --- input login -- traz o primeiro
        $usuario = DB::table('usuarios')->where('login',$request->input('login'))->first();
        // procurar usuario -- necessario o first
        //$conf = Usuario::find($usuario->id);
        //verifica se existe
        if(isset($usuario)){
        $data = $request->input();
        //iniciao sessao
        session(['usuario'=>$data]);
        $output = $request->session()->get('usuario');
        if($usuario->acesso_id === 1 && isset($output)){
            return redirect('/adm');
        }
        else if ($usuario->acesso_id === 2 && isset($output)){
            return redirect('/home');
        }
        
        }
        return redirect('/login');

    }

    public function index()
    {
        return view('login');
    }

    public function retornarUsuario(Request $request)
    {        
        
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        return view('usuario.homeusuario', compact('usuario'));
        
    }

    public function retornarAdm(Request $request)
    {
        
        $output = $request->session()->get('usuario');
        //TRAZ ARRAY com as informaçoes do usuario
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        return view('admin.homeadmin', compact('usuario'));
        
    }
    
    public function retornaLogin(){
        return redirect('/login');
    }
    public function create()
    {
        
    }
    public function logout(Request $request){
        $request->session()->forget('usuario');
        return redirect('login');
    }
    public function store(Request $request)
    {
        
    }
    public function cadastroFuncionario(Request $request){
        $output = $request->session()->get('usuario');
        //TRAZ ARRAY com as informaçoes do usuario
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        return view('admin.cadastrofuncionario', compact('usuario'));
    }
    public function cadastrarFuncionario(Request $request)
    {
        $regras = [
            'nome'=> 'required|min:3|unique:usuarios',
            'login' =>'required|unique:usuarios',
            'senha' => 'required|min:6'
        ];
        $mensagens = [
            'nome.required' => 'O nome não pode estar em branco!',
            'login.required' => 'O login não pode estar em branco!',
            'senha.required' => 'A senha não pode estar em branco!',
            'senha.min' => 'É necessário uma senha no minimo de 6 digitos',
            'login.unique' => 'login já cadastrado!'
        ];

        
        $request->validate($regras,$mensagens);
        $funcionario = new Usuario();
        $funcionario->nome = $request->input('nome');        
        $funcionario->login = $request->input('login');
        $funcionario->senha = $request->input('senha');
        $funcionario->acesso_id = 2;
        $funcionario->save();
        return redirect('/cadastrofuncionario');
    }
    public function listarFuncionarios(Request $request){
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        $funcionarios = DB::table('usuarios')->where('acesso_id',2)->get();
        return view('admin.funcionario',compact('usuario','funcionarios'));
    }
    
    public function editFuncionario($id, Request $request)
    {
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        $funcionario = Usuario::find($id);
        if(isset($funcionario)){
            return view('admin.editarfuncionario',compact('usuario','funcionario'));
        }
        return redirect('/funcionarios');
    }

    public function atualizaFuncionario(Request $request, $id)
    {
        $funcionario = Usuario::find($id);
        $login = $funcionario->login;
        if(isset($funcionario)){
            $regras = [
                'nome'=> 'required|min:3',
                'senha' => 'required|min:6'
            ];
            $mensagens = [
                'nome.required' => 'O nome não pode estar em branco!',
                'senha.required' => 'A senha não pode estar em branco!',
                'senha.min' => 'É necessário uma senha no minimo de 6 digitos',
            ];
    
            
            $request->validate($regras,$mensagens);
            $funcionario->nome = $request->input('nome');
            $funcionario->senha = $request->input('senha');
            $funcionario->save();
        }
        return redirect('/funcionarios');
    }

    public function irPerfil(Request $request)
    {
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        $perfil = Usuario::find($usuario->id);
        if(isset($perfil)){
            return view('admin.perfil',compact('usuario','perfil'));
        }
        return redirect('/adm');
    }

    public function atualizarPerfil(Request $request)
    {
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        $perfil = Usuario::find($usuario->id);
        if(isset($perfil)){
            $regras = [
                'nome'=> 'required|min:3',
                'senha' => 'required'
            ];
            $mensagens = [
                'nome.required' => 'O nome não pode estar em branco!',
                'senha.required' => 'A senha não pode estar em branco!'
            ];
    
            
            $request->validate($regras,$mensagens);
            $perfil->nome = $request->input('nome');
            $perfil->senha = $request->input('senha');
            $perfil->save();
        }
        return redirect('/adm');
    }

    public function retornaNovoChamado(Request $request){        
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        $responsaveis = DB::table('usuarios')->where('acesso_id', 1)->get();
        return view('usuario.novochamado', compact('usuario','responsaveis'));
    }
    public function registrarChamado(Request $request){
        
        $regras = [
            'responsavel' => 'not_in:0',
            'mensagem'=> 'required'     
        ];
        $mensagens = [
            'responsavel.not_in' => 'É necessário escolher um responsavel pelo seu chamado!',
            'mensagem.required' => 'A menssagem não pode estar em branco!'
        ];
        $request->validate($regras,$mensagens);
        
        $chamado = new Chamado();
        $historicoChamado = new HistoricoChamado();
        
        
        $nome = $request->arquivo->getClientOriginalExtension();
        $extensao = substr($nome,-3);
        
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        $chamado->cliente = $usuario->id;      
        $chamado->responsavel= $request->input('responsavel');
        $chamado->data_abertura = date('Y-m-d H:i:s');
        $chamado->assunto = $request->input('mensagem');
        
        //print_r(Input::get('responsavel'));
        $chamado->save();        
        $historicoChamado->cliente = $usuario->id;
        $historicoChamado->responsavel= $request->input('responsavel');
        $historicoChamado->chamado = $chamado->id;
        $historicoChamado->assunto = $request->input('mensagem');
        if($extensao === "zip" || $extensao === "rar"){
            $path = $request->file('arquivo')->store('documentos','public');
        }
        else if($extensao === null){
            $path = "";            
        }
        else{

        }
        $historicoChamado->anexo = $path;
        $historicoChamado->save();
        return redirect('/novochamado');

    }

    public function trazerChamados(Request $request){
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        //$chamados =  DB::table('chamados')->where('cliente',$usuario->id)->get();
        $chamados = DB::select('
        select c.id, u.nome as responsavel, c.data_abertura, c.data_fechamento, c.assunto from chamados c inner join usuarios u
         on u.id = c.responsavel where c.cliente = :id', ['id' => $usuario->id]);
        return view('usuario.historicochamado', compact('usuario','chamados'));
    }
    public function destroy($id)
    {
        //
    }
}
