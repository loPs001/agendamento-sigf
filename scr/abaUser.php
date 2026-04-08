<?php
 function abaUser ($usuario) {
    print ("==================================================\n");  
    print("Seja bem vindo, " . $usuario["nome"] . ".\n");
    print("\n1.Marcar consultas \n2.Ver consultas \n3.Opções \n");
    $inputP = readline("Qual será a sua ação?: ");
    while (true) {
        switch ($inputP) {
            case "3":
                return true;
            default : 
                print("Houve um problema!\n");

        }
    }

}