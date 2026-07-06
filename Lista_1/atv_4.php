<?php




$tamanho = 825; 
$alfabeto = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';


function gerarSenha() {
    global $tamanho, $alfabeto;
    $senha = '';
    $maxIndex = strlen($alfabeto) - 1;

    for ($i = 0; $i < $tamanho; $i++) {
        $index = rand(0, $maxIndex);
        $senha .= $alfabeto[$index];
    }

    return $senha;
    
}


echo "A senha gerada é: " . gerarSenha();

?>