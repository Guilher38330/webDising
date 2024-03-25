<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300&display=swap');

        body {
            margin: 0;
            font-family: 'Gemunu Libre', sans-serif;
        }

        .main-container {
            display: flex;
            height: 100vh;
        }

        .left-section,
        .right-section {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .left-section {
            background-image: url("imagem/plano\ de\ fundo.jpg");
            background-size: cover;
        }

        .left-section>h1 {
            font-size: 3vw;
            color: #000000;
        }

        .left-section-image {
            width: 35vw;
            max-width: 500px;
        }

        .right-section {
            background: #ffffff;
        }

        .card-container {
            width: 60%;
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 8px;
            padding: 30px 35px;
            background: #D9D9D9;
            box-shadow: 0px 10px 40px #00000056;
        }

        .card-container>h1 {
            color: #000000;
            font-weight: 800;
            margin: 0;
        }

        .textfield {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            margin: 10px 0px;
        }

        .textfield>input {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #ffffff;
            color: #000000de;
            font-size: 12pt;
            box-shadow: 0px 10px 40px #00000056;
            outline: none;
            box-sizing: border-box;
        }

        .textfield>label {
            color: #000000de;
            margin-bottom: 10px;
        }

        .textfield>input::placeholder {
            color: #98989894;
        }

        .btn-submit {
            width: 100%;
            padding: 16px 0px;
            border: none;
            border-radius: 8px;
            outline: none;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 3px;
            color: #000000;
            background-color: #E36708;
            cursor: pointer;
            box-shadow: 0px 10px 40px -12px #E36708;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="left-section">
            <img src="imagem/relogioLogo.svg" class="left-section-image" alt="">
        </div>
        <div class="right-section">
            <div class="card-container">
                <h1>LOGIN</h1>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST["email"];
                    $senha = $_POST["senha"];

                    try {
                        include("config.php");
                        $conexao = conectar();

                        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
                        $stmt = $conexao->prepare($sql);

                        $stmt->bindParam(':email', $email);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row) {
                            if (password_verify($senha, $row["senha"])) {
                                header("Location: menu.html");
                                exit();
                            } else {
                                echo "Senha incorreta.";
                            }
                        } else {
                            // Usuário não encontrado
                            echo "Usuário não encontrado. ";
                            // Adicione a mensagem de cadastro aqui
                            echo "<a href='cadastro.php'>Cadastre-se aqui</a> ou ";
                            echo "já é cadastrado? Faça <a href='login.php'>login aqui</a>.";
                        }
                    } catch (PDOException $e) {
                        echo "Erro ao realizar login: " . $e->getMessage();
                    }
                }
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="textfield">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" required>
                    </div>
                    <button class="btn-submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>