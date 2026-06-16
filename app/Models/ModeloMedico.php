<?php

namespace App\Models;

class ModeloMedico extends ModeloUsuario
{
    private string $crm;

    public function __construct(string $nome, string $cpf, string $email, string $senha, string $crm) {
        parent::__construct($nome, $cpf, $email, $senha);
        $this->crm = $crm;
    }

    public function toArray(): array {
        return array_merge(parent::toArray(), [
            "tipo" => "medico",
            "crm" => $this->crm,
        ]);
    }
}
