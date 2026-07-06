<?php
include("../infra/db/connect.php");
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir usuário.');</script>";
    }
    $stmt->close();
   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $senha);
    if ($stmt->execute()) {
        echo "<script>alert('Usuário Cadastrado com sucesso!')</script>";
    } else {
        echo "<script>alert('Erro Usuário Não Cadastrado!')</script>";
    }
    $stmt->close();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php
    include("../public/component/navbar.php");
    ?>
    <h2>Bem-vindo!</h2>
    <p> Usuário logado:
        <?php echo $_SESSION["usuario"]; ?>
    </p>

    <h4>Cadastrar Novo Usuário</h4>
    <form method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario">
        <br>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha">
        <br>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
    <?php

    include("../public/component/table.php");
    ?>

    <a href="logout.php">Sair</a>


</body>

</html>