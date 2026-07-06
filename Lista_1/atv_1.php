<?php

function calcularFormula($x,$y){
    
    if ($x + $y == 0){
            return"Não foi possivel realizar a divisão por zero";
    }

    $resultado = (pow($x,2) + pow($y,2)) / ($x + $y);

    return $resultado;
}

    $x_usuario =9;
    $y_usuario = 12;

    echo "o valor de x é: $x_usuario <br>";
    echo "o valor de y é: $y_usuario <br>";

echo calcularFormula($x_usuario, $y_usuario);

