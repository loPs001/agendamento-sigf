<?php 
require_once __DIR__ ."/controllers/controllerUser.php";

//Diretorio e formatação para Array:
$caminho = __DIR__ . DIRECTORY_SEPARATOR . "./dados.json";
$dados = json_decode(file_get_contents($caminho), true); 

while (True) {
    print ("==================================================\n");  
    print("Bem vindo ao SIGF");
    print("\n1.Cadastrar \n2.Login \n3.Sair \n");
    $inputP = readline("Qual será a sua ação?: ");
    print ("==================================================\n");  
    switch ($inputP) {
        case "1":       
            ControllerUsuario::Cadastro($dados, $caminho);
            break;
        case "2":
            ControllerUsuario::Login($dados);
            break;
        case "3":
            return true;
        default: 
            print("Houve um problema!\n");
    }
}

//

