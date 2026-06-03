<hr>

<h4> Usuários Cadastrados</h4>

<table border="1" cellpadding="2">

    <tr>
        <th>ID</th>
        <th>Usuário</th>
        <th>Senha</th>
    </tr>

    <?php


    $sqlUsuarios = "SELECT * FROM users";

    $resultadoUsuarios = $conn->query($sqlUsuarios);

    while ($linha = $resultadoUsuarios->fetch_assoc()) {
        echo "<tr>\n        \n            <td>" . $linha["id"] . "</td>\n        
            <td>" . $linha["username"] . "</td>\n            <td>" . $linha["password"] . "</td>\n            <td>\n    
                        <form method='POST' onsubmit='return confirm(\'Confirma exclusão deste usuário?\');'>\n                  
                          <input type='hidden' name='delete_id' value='" . $linha["id"] . "'>\n                    <button type='submit'>Excluir</button>\n               
                           </form>\n            </td>\n        \n        </tr>";
    }

    ?>

</table>