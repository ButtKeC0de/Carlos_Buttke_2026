<?php
    //Uma editora deseja obter algumas informações sobre os textos enviados pelos
    //autores.
    //Crie uma função chamada analisarTexto() que receba um texto e retorne:
    //Quantidade de palavras;
    //Quantidade de caracteres;
    //Quantidade de vogais;
    // Quantidade de consoantes;   
    
    $texto = "OIeeeeeeee hoy"; 

    function analisarTexto() {
        
        global $texto;
        
        if (!preg_match('/^[a-zA-Z0-9 ]+$/', $texto)) {
            echo"retire os acentos para continuar";
            }else{ 
                
            
                $numWord = mb_strlen ($texto);

                $palavra  = str_word_count($texto);

                $vog = preg_match_all('/[aeiouAEIOU]/',$texto);

                $nospace= str_replace (' ','',$texto);

                $num =  mb_strlen ($nospace);

                $cons = $num - $vog;

                
            
            echo "O texto é : $texto" . "<br> <br>";

            echo "A quantidade de palavras é : $palavra" . "<br> <br>";

            echo "A quantidade de caracteres é : $numWord" ."<br> <br>";

            echo "A quantidade de vogais é : $vog". "<br><br>";

            echo"A quantidade de consoantes é : $cons"."<br><br>";
            
        }
    }

        analisarTexto()




 ?>