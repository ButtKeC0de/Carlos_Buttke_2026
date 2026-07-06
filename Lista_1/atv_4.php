<?php

//Uma empresa deseja gerar senhas temporárias para seus colaboradores.
//Crie uma função chamada gerarSenha() que receba a quantidade de caracteres
//desejada e retorne uma senha aleatória contendo letras maiúsculas, minúsculas,
//números e caracteres especiais.


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