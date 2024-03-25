<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="main-container">
        <div class="left-section">
            <h1>Cadastro</h1>
            <img class="left-section-image" src="imagem/relogioLogo.svg" alt="Imagem de fundo">
        </div>
        <div class="right-section">
            <div class="card-container">
                <h1>Cadastro</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="textfield">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required>
                    </div>
                    <div class="textfield">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="Digite a sua senha" required>
                    </div>
                    <input class="btn-submit" type="submit" value="Cadastrar">
                </form>
            </div>
        </div>
    </div>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        try {
            include("config.php");
            $conexao = conectar();

            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conexao->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);

            $stmt->execute();

            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
    ?>

</body>

</html>