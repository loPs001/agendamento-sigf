<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModeloConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ControllerUser extends Controller
{
    public function ExibirHomeUser()
    {
        $usuario = session("usuario_logado");
        return view("painel", compact("usuario"));
    }

    // função de criação de agendamento, puxar dados de usuario
    public function CadastrarConsulta(Request $request)
    {
        $arquivo = "dados-consultas.json";
        $listaConsultas = [];

        if (Storage::exists($arquivo)) {
            $dadosObtidos = Storage::get($arquivo);
            $listaConsultas = json_decode($dadosObtidos, true) ?? [];
        }

        $usuario = session("usuario_logado");

        $novaConsulta = new ModeloConsulta(
            $usuario["cpf"],
            $usuario["nome"],
            $request->json("tipoConsulta"),
            $request->json("dataHora"),
            $request->json("unidade")
        );
        $listaConsultas[] = $novaConsulta->toArray();

        Storage::put($arquivo, json_encode($listaConsultas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json([
            "status" => 201,
            "mensagem" => "Consulta cadastrada com sucesso!"
        ]);
    }

    public function ExibirConsultasUser()
    {
        $usuario = session("usuario_logado");

        $arquivo = "dados-consultas.json";
        $consultaDoUsuario = [];
        $listaConsultas = [];

        if (Storage::exists($arquivo)) {
            $dadosObtidos = Storage::get($arquivo);
            $listaConsultas = json_decode($dadosObtidos, true) ?? [];
        }

        foreach ($listaConsultas as $consulta) {
            if (isset($consulta['cpf']) && $consulta["cpf"] === $usuario["cpf"]) {
                $consultaDoUsuario[] = $consulta;
            }
        }

        return view("consultas", [
            "consultas" => $consultaDoUsuario
        ]);
    }

    public function CancelarConsulta($dataHora)
    {
        $usuario = session("usuario_logado");

        $arquivo = "dados-consultas.json";

        if (!Storage::exists($arquivo)) {
            return redirect()->route("page_consultas")->with("erro", "Nenhuma consulta encontrada.");
        }

        $dadosObtidos = Storage::get($arquivo);
        $listaConsultas = json_decode($dadosObtidos, true) ?? [];

        $dataHoraDecodificada = urldecode($dataHora);

        $listaAtualizada = array_filter($listaConsultas, function ($consulta) use ($usuario, $dataHoraDecodificada) {
            return !(
                $consulta["cpf"] === $usuario["cpf"] &&
                $consulta["dataHora"] === $dataHoraDecodificada
            );
        });

        $listaAtualizada = array_values($listaAtualizada);

        Storage::put($arquivo, json_encode($listaAtualizada, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route("page_consultas")->with("sucesso", "Consulta cancelada com sucesso!");
    }

    // visualização de opções e função de sair
    public function ExibirOpcoesUser()
    {
        $usuario = session("usuario_logado");
        return view("opcao", compact("usuario"));
    }

    public function Logout()
    {
        session()->forget("usuario_logado");
        return redirect()->route("home");
    }
}