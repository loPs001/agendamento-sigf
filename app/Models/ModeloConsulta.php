<?php

namespace App\Models;

class ModeloConsulta {
    private string $cpf;
    private string $paciente;
    private string $tipoConsulta;
    private string $dataHora;
    private string $unidade; 
    private string $status;


    public function __construct(string $cpf, string $paciente, string $tipoConsulta, string $dataHora, string $unidade, string $status = "Agendado") {
        $this->cpf = $cpf;
        $this->paciente = $paciente;
        $this->tipoConsulta = $tipoConsulta;
        $this->dataHora = $dataHora;
        $this->unidade = $unidade;
        $this->status = $status;
    }

    public function toArray(): array {
        return [
            "cpf"           => $this->cpf,
            "paciente"      => $this->paciente,
            "tipoConsulta"  => $this->tipoConsulta,
            "dataHora"      => $this->dataHora, 
            "unidade"       => $this->unidade,
            "status"        => $this->status,
            
            "data_formatada" => $this->formatarDataHora(), 
            "cor_status"     => $this->obterCorStatus()
        ];
    }

    private function formatarDataHora(): string {
        if (empty($this->dataHora)) return "Data não definida";
        
        $timestamp = strtotime($this->dataHora);
        return date('d/m/Y', $timestamp) . ' às ' . date('H:i', $timestamp) . 'h';
    }

    /**
     * Retorna uma cor correspondente para você aplicar direto na tag HTML do Blade ou do JS
     */
    private function obterCorStatus(): string {
        return match ($this->status) {
            'Agendado'  => '#28a745', // Verde
            'Realizado' => '#007bff', // Azul
            'Cancelado' => '#dc3545', // Vermelho
            default     => '#6c757d'  // Cinza
        };
    }
}