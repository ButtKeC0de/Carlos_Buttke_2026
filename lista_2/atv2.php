<?php


function limparEspacos($texto) {
    return trim(preg_replace('/\s+/', ' ', $texto));
}


function extrairPalavras($texto) {

    $textoLimpo = preg_replace('/[^\p{L}\p{N}\s]/u', '', $texto);

    $textoLimpo = mb_strtolower($textoLimpo, 'UTF-8');
    
    if (empty(trim($textoLimpo))) {
        return [];
    }
    
    return explode(' ', $textoLimpo);
}


function contarFrases($texto) {
    if (empty(trim($texto))) return 0;
    
    $ocorrencias = preg_match_all('/[.!?]+/', $texto);

    return $ocorrencias > 0 ? $ocorrencias : 1;
}


function encontrarExtremos($palavras) {
    if (empty($palavras)) {
        return ['maisLonga' => '', 'maisCurta' => ''];
    }
    
    $maisLonga = $palavras[0];
    $maisCurta = $palavras[0];
    
    foreach ($palavras as $palavra) {
        $tamanhoAtual = mb_strlen($palavra, 'UTF-8');
        if ($tamanhoAtual > mb_strlen($maisLonga, 'UTF-8')) {
            $maisLonga = $palavra;
        }
        if ($tamanhoAtual < mb_strlen($maisCurta, 'UTF-8')) {
            $maisCurta = $palavra;
        }
    }
    
    return ['maisLonga' => $maisLonga, 'maisCurta' => $maisCurta];
}


function analisarFrequencia($palavras) {
    if (empty($palavras)) {
        return ['repetidas' => 0, 'top5' => []];
    }

    $frequencias = array_count_values($palavras);
    
    $palavrasRepetidas = 0;
    foreach ($frequencias as $quantidade) {
        if ($quantidade > 1) {
            $palavrasRepetidas++;
        }
    }
    

    arsort($frequencias);
    

    $top5 = array_slice(array_keys($frequencias), 0, 5);
    
    return ['repetidas' => $palavrasRepetidas, 'top5' => $top5];
}


function formatarTextoMaiusculas($texto) {

    return mb_convert_case(mb_strtolower($texto, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
}


function processarTexto($textoOriginal) {
    $textoSemEspacos = limparEspacos($textoOriginal);
    $palavrasArray = extrairPalavras($textoSemEspacos);
    
    $extremos = encontrarExtremos($palavrasArray);
    $frequencia = analisarFrequencia($palavrasArray);
    
    return [
        'qtd_caracteres' => mb_strlen($textoOriginal, 'UTF-8'),
        'qtd_palavras' => count($palavrasArray),
        'qtd_frases' => contarFrases($textoOriginal),
        'palavra_mais_longa' => $extremos['maisLonga'],
        'palavra_mais_curta' => $extremos['maisCurta'],
        'qtd_palavras_repetidas' => $frequencia['repetidas'],
        'top_5_frequentes' => $frequencia['top5'],
        'texto_sem_espacos' => $textoSemEspacos,
        'texto_formatado' => formatarTextoMaiusculas($textoSemEspacos)
    ];
}



$textoTeste = "Este é um     texto de teste! O texto tem palavras repetidas. Teste de texto com   espaços duplicados e palavras curtas. Será que o código acha a inconstitucionalissimamente maior palavra?";

$resultado = processarTexto($textoTeste);

echo "--- Resultado da Análise ---\n";
echo "Caracteres: " . $resultado['qtd_caracteres'] . "\n";
echo "Palavras: " . $resultado['qtd_palavras'] . "\n";
echo "Frases: " . $resultado['qtd_frases'] . "\n";
echo "Palavra mais longa: " . $resultado['palavra_mais_longa'] . "\n";
echo "Palavra mais curta: " . $resultado['palavra_mais_curta'] . "\n";
echo "Palavras que se repetem: " . $resultado['qtd_palavras_repetidas'] . "\n";
echo "Top 5 palavras: " . implode(", ", $resultado['top_5_frequentes']) . "\n";
echo "Texto limpo: " . $resultado['texto_sem_espacos'] . "\n";
echo "Texto formatado: " . $resultado['texto_formatado'] . "\n";

?>