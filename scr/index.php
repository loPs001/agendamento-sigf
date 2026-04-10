<?php 
require_once __DIR__ ."/controllers/controllerLogin.php";

//Diretorio e formatação para Array:
$caminho = __DIR__ . DIRECTORY_SEPARATOR . "./banco-de-dados/dados-usuarios.json";
$dadosUsuarios = json_decode(file_get_contents($caminho), true); 

while (True) {
    print ("==================================================\n");  
    print("Bem vindo ao SIGF");
    print("\n1.Cadastrar \n2.Login \n3.Sair \n");
    $inputP = readline("Qual será a sua ação?: ");
    print ("==================================================\n");  
    switch ($inputP) {
        case "1":       
            ControllerLogin::Cadastro($dadosUsuarios, $caminho);
            break;
        case "2":
            ControllerLogin::Login($dadosUsuarios);
            break;
        case "3":
            return true;
        default: 
            print("=== [ERROR]Houve um problema! ===\n");
    }
}

//

