<?php


$cpf = "123.456.789-00";
    function mascararCpf($cpf){


        $cpfMascarado = str_repeat("*", strlen($cpf) - 4) . substr($cpf, -4);
        return $cpfMascarado;
    }

        echo "O cpf original é  $cpf <br>";
        echo "O cpf mascarado é: " . mascararCpf($cpf) . "<br>";

        ?>