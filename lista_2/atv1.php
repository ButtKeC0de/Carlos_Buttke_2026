<?php


function contarOcorrencias($texto, $padrao) {

    return preg_match_all($padrao, $texto);
}


function contarMaiusculas($senha) {
    return contarOcorrencias($senha, '/[A-Z]/');
}


function contarMinusculas($senha) {
    return contarOcorrencias($senha, '/[a-z]/');
}


function contarNumeros($senha) {
    return contarOcorrencias($senha, '/[0-9]/');
}


function contarEspeciais($senha) {
    return contarOcorrencias($senha, '/[^A-Za-z0-9]/');
}


function classificarSenha($tamanho, $maiusculas, $minusculas, $numeros, $especiais) {

    if ($tamanho < 8) {
        return "Fraca";
    }

    $pontos = 0;
    if ($maiusculas > 0) $pontos++;
    if ($minusculas > 0) $pontos++;
    if ($numeros > 0) $pontos++;
    if ($especiais > 0) $pontos++;

    if ($pontos === 4) return "Muito Forte";
    if ($pontos === 3) return "Forte";
    if ($pontos === 2) return "Média";
    
    return "Fraca";
}


function analisarSenha($senha) {

    $tamanho = strlen($senha);
    $qtdMaiusculas = contarMaiusculas($senha);
    $qtdMinusculas = contarMinusculas($senha);
    $qtdNumeros = contarNumeros($senha);
    $qtdEspeciais = contarEspeciais($senha);
    
    $nivelDeSeguranca = classificarSenha(
        $tamanho, 
        $qtdMaiusculas, 
        $qtdMinusculas, 
        $qtdNumeros, 
        $qtdEspeciais
    );


    return [
        $qtdMaiusculas, 
        $qtdMinusculas, 
        $qtdNumeros, 
        $qtdEspeciais, 
        $tamanho, 
        $nivelDeSeguranca
    ];
}



$senhaTeste = "Seguranca@2024";
$relatorio = analisarSenha($senhaTeste);

echo "Analisando a senha: " . $senhaTeste . "\n";
echo "Array Retornado:\n";
print_r($relatorio);


echo "\n--- Detalhes ---\n";
echo "Letras Maiúsculas: " . $relatorio[0] . "\n";
echo "Letras Minúsculas: " . $relatorio[1] . "\n";
echo "Números: " . $relatorio[2] . "\n";
echo "Caracteres Especiais: " . $relatorio[3] . "\n";
echo "Tamanho: " . $relatorio[4] . "\n";
echo "Nível de Segurança: " . $relatorio[5] . "\n";

?>