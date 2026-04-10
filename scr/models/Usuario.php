<?php
class Usuario {
    public string $nome;
    public string $cpf;
    public string $email;
    public string $senha;
    public $consultas;
    public function __construct( string $nome, string $cpf, string $email, string $senha) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = $senha;
        $this->consultas = [];
    }
    public function AdicionarConsulta ($novaConsulta) {
        $this->consultas[] = $novaConsulta;

    }
}