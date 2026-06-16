<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ControllerMedico extends Controller
{
    public function ExibirPainelMedico()
    {
        $medico = session("medico_logado");
        return view("painel_medico", compact("medico"));
    }

    public function ExibirConsultasMedico()
    {
        $arquivo = "dados-consultas.json";
        $listaConsultas = [];

        if (Storage::exists($arquivo)) {
            $listaConsultas = json_decode(Storage::get($arquivo), true) ?? [];
        }

        return view("consultas_medico", [
            "consultas" => $listaConsultas
        ]);
    }

    public function FinalizarConsulta($cpf, $dataHora)
    {
        return $this->AtualizarStatus($cpf, $dataHora, "Finalizado", "#007bff");
    }

    public function RegistrarAusencia($cpf, $dataHora)
    {
        return $this->AtualizarStatus($cpf, $dataHora, "Ausente", "#dc3545");
    }

    private function AtualizarStatus($cpf, $dataHora, $novoStatus, $novaCor)
    {
        $arquivo = "dados-consultas.json";

        if (!Storage::exists($arquivo)) {
            return redirect()->route("page_consultas_medico")->with("erro", "Nenhuma consulta encontrada.");
        }

        $cpfDecodificado      = urldecode($cpf);
        $dataHoraDecodificada = urldecode($dataHora);

        $listaConsultas = json_decode(Storage::get($arquivo), true) ?? [];

        foreach ($listaConsultas as &$consulta) {
            if (
                $consulta["cpf"] === $cpfDecodificado &&
                $consulta["dataHora"] === $dataHoraDecodificada
            ) {
                $consulta["status"]     = $novoStatus;
                $consulta["cor_status"] = $novaCor;
                break;
            }
        }
        unset($consulta);

        Storage::put($arquivo, json_encode($listaConsultas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route("page_consultas_medico")->with("sucesso", "Consulta atualizada com sucesso!");
    }
}