<?php
class Usuario {
    public string $nome;
    public string $cpf;
    public string $email;
    public string $senha;
    public $consulta;
    public function __construct($nome, $cpf, $email, $senha) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = $senha;
        $this->consulta = [];
    }
}