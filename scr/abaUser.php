<?php
require_once __DIR__ . "/controllers/controllerUsuario.php";
require_once __DIR__ ."/models/Usuario.php";
 function abaUser ($usuario) {
    //Diretorio que leva há dados consulta.
    $caminhoDadosConsulta = __DIR__ . DIRECTORY_SEPARATOR . "./banco-de-dados/dados-consultas.json";
    $dadosConsultas = json_decode(file_get_contents($caminhoDadosConsulta), true);
    //Diretorio que leva há dados usuarios.
    $caminhoDadosUsuario = __DIR__ . DIRECTORY_SEPARATOR . "./banco-de-dados/dados-usuarios.json";
    $dadosUsuarios = json_decode(file_get_contents($caminhoDadosUsuario), true);

    $usuarioLogado = new Usuario($usuario["nome"],$usuario["cpf"],$usuario["email"],$usuario["senha"]);

    print ("==================================================\n");  
    print("=== Seja bem vindo, " . $usuario["nome"] . ". ===\n");
  
    while (true) {
        print("\n1.Marcar consultas \n2.Ver consultas \n3.Opções \n");
        $inputP = readline("Qual será a sua ação?: ");
        switch ($inputP) {
            case "1": 
                ControllerUsuario::MarcarConsulta($usuarioLogado, $dadosUsuarios, $dadosConsultas,$caminhoDadosUsuario, $caminhoDadosConsulta);
                break;
            case "3":
                return true;
            default : 
                print("Houve um problema!\n");

        }
    }

}