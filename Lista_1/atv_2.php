<?php


echo "<h1>Inverter Texto</h1>";

$texto = "Oi";
function inverterTexto($texto)
{

    $textoInvertido = strrev($texto);
    return $textoInvertido;
}

echo "O texto original é : $texto ";
echo "<br>";
echo "O texto invertido é :" . inverterTexto($texto) . "
<br>";
