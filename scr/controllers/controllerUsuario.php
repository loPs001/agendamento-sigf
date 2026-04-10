<?php
require_once __DIR__ . "/../models/Consulta.php";

class ControllerUsuario {
    public static function MarcarConsulta (
        $usuarioLogado,
        $dadosUsuarios,
        $dadosConsulta,
        $caminhoFileUsuarios,
        $caminhoFileConsultas,
        ) {
        print ("=== Que consulta você deseja marcar? ===\n1.Dentista\n2.Clinico Geral\n3.Ortopedista\n");
        $valorConsulta = "";
        $inputP = readline("Qual será sua ação: ");
        switch ($inputP) {
            case "1":
                $valorConsulta .= "Dentista";
                break;
            case "2": 
                $valorConsulta .= "Clinico Geral";
                break;
            case"3":
                $valorConsulta .= "Ortopedista";
                break;
            default: 
                print ("Não foi possivel marcar a consulta...\n");
                break;
        }

        //Verificação de duplicidade de consulta:
        $decisao = false;
        foreach ($usuarioLogado->consultas as $consulta) {
            if ($consulta->tipoConsulta === $valorConsulta) {
                $decisao = true;
            }
        }
        if ($decisao != false ) {
            print ("=== [ERROR]Essa consulta já foi cadastrada por esse usuario... ===\n");
        } else {
            //Criação de consulta que vai para /dados-consulta
            $novaConsulta = new Consulta ($usuarioLogado->cpf, $usuarioLogado->nome, $valorConsulta);
            $dadosConsulta[] = (array) $novaConsulta;
            file_put_contents($caminhoFileConsultas, json_encode($dadosConsulta, JSON_PRETTY_PRINT));

            //Agregação de consulta no usuario:
            $decisao = false;
            foreach ($dadosConsulta as $dados) {
                if ($dados["cpf"] === $usuarioLogado->cpf) {
                    $userConsulta = new Consulta ($usuarioLogado->cpf, $usuarioLogado->nome, $valorConsulta);
                    $decisao = true;
                }
            }
            if ($decisao === true) {
                $usuarioLogado->AdicionarConsulta($userConsulta);
                $atualIndice = 0;
                foreach ($dadosUsuarios as $indice => $usuario) {
                    if ($usuario["cpf"] === $usuarioLogado->cpf) {
                        $atualIndice = $indice;
                    }
                }
                $dadosUsuarios[$atualIndice] = (array) $usuarioLogado;
                file_put_contents($caminhoFileUsuarios, json_encode($dadosUsuarios, JSON_PRETTY_PRINT));
            } else {
                print("=== [ERROR]Houve um problema... ===\n");
            }
            print ("=== Consulta criada com sucesso! ===\n");
        }
    }
}