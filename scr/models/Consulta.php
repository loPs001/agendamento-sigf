<?php
class Consulta {
    public string $cpf;
    public string $paciente;
    public string $tipoConsulta;
    public $dataHora;
    public $status;


    public function __construct (string $cpf, string $pac, string $tipoConsulta,$dtH = null, $status = "Agendado"  ) {
        $this->cpf = $cpf;
        $this->paciente = $pac;
        $this-> tipoConsulta = $tipoConsulta;
        $this->dataHora = $dtH ?? date('Y-m-d H:i:s');
        $this->status = $status;
    }   

}

