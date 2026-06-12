<?php

namespace App\Models;

class ModeloUsuario {
    private string $nome;
    private string $cpf;
    private string $email;
    private string $senha;

    public function __construct(string $nome, string $cpf, string $email, string $senha) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = $senha;
    }

    // A única função que precisamos: ela transforma o cofre em um array simples
    public function toArray(): array {
        return [
            "nome"  => $this->nome,
            "cpf"   => $this->cpf,
            "email" => $this->email,
            "senha" => $this->senha,
        ];
    }
}
