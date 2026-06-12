<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModeloUsuario;
use Illuminate\Support\Facades\Storage;


class ControllerAuth extends Controller {
    public function Cadastro (Request $request) {
        
        $nomeForm = $request->json("nome");
        $cpfForm = $request->json("cpf");
        $emailForm = $request->json("email");
        $senhaForm = $request->json("senha");
    
        $arquivo = "dados-usuarios.json";
        $listaUsuarios = [];

        if (Storage::exists($arquivo)) {
            $dadosObtidos = Storage::get($arquivo);
            $listaUsuarios = json_decode($dadosObtidos, true) ?? [];
        }

        foreach($listaUsuarios as $usuario) {
            if ($usuario["email"] === $emailForm || $usuario["cpf"] === $cpfForm){
                return response()->json([
                    "status" => 409,
                    "mensagem" => "Usuário com dados cadastrados já existentes..."
                ]);
            }
        }

        $novoUsuario = new ModeloUsuario($nomeForm, $cpfForm, $emailForm, password_hash($senhaForm, PASSWORD_BCRYPT));
        $listaUsuarios[] = $novoUsuario->toArray();
        Storage::put($arquivo, json_encode($listaUsuarios,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json([
            "status" => 201,
            "mensagem" => "Usuário cadastrado com sucesso!"
        ]);
    }

   public function Login(Request $request) {

        $cpfForm = $request->json("cpf");
        $senhaForm = $request->json("senha");

        $arquivo = "dados-usuarios.json";
        $listaUsuarios = [];

        if (Storage::exists($arquivo)) {
            $dadosObtidos = Storage::get($arquivo);
            $listaUsuarios = json_decode($dadosObtidos, true) ?? [];
        }

        foreach($listaUsuarios as $usuario) {
            if ($usuario["cpf"] === $cpfForm) {
                if (password_verify($senhaForm, $usuario["senha"])){

                    session(["usuario_logado" => $usuario]); // A session permite que quando existe um usuario logado, alias de ele apagar após o recarregamentos da página, ele possa guardar esses dados temporariamente até o momento que o usuario faça logouf da conta.

                    return response()->json([
                        "status" => 200,
                        "mensagem" => "Login realizado com sucesso!",
                    ]);
                }
            }
        }

        return response()->json([
            "status" => 401,
            "mensagem" => "Não foi possivel encontrar o usuário, verifique se os dados inseridos estão corretos..."
        ]);
   
    }

}
