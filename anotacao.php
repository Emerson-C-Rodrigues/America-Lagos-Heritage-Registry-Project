<!DOCTYPE html>
<html>
<head>
	<title>Editar Anotação</title>
	<style>
	  body {
  background-color: blue;
  background-image: url(america-lagos.png);
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  margin: 0px;
  color: #333;
  font-family: Arial, sans-serif;
}

nav ul {
  text-align: center;
  padding: 1.6vw;
  background-color: rgba(255, 255, 255, 0.8);
  border-bottom: 0.8px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 0.8vw rgba(0, 0, 0, 0.2);
  margin:0px 0px 20px 0px;
}

nav li {
  display: inline-block;
  margin-right: 20px;
}

nav a {
  color: #000;
  text-decoration: none;
}
	h1 {
		color: red;
		font-size: 24px;
		font-weight: bold;
		margin-top: 20px;
		margin-bottom: 10px;
	}

	p {	
		color: red;
		font-size: 20px;
		margin-bottom: 20px;
	}

	label {
		color: red;
		display: block;
		font-size: 24px;
		margin-bottom: 10px;
		font-weight: bold;
	}

	textarea {
		display: block;
		width: 100%;
		padding: 10px;
		font-size: 16px;
		border-radius: 5px;
		border: 1px solid #ccc;
		box-sizing: border-box;
		resize: none;
		height: 100px;
		margin-bottom: 20px;
	}

	input[type="submit"] {
		background-color: #4CAF50;
		color: white;
		padding: 10px 20px;
		border-radius: 5px;
		border: none;
		font-size: 16px;
		cursor: pointer;
	}

	input[type="submit"]:hover {
		background-color: #3e8e41;
	}

	form {
		margin-bottom: 20px;
	}

	.anotacao{

		color: black;
		font-size: 18px;
		font-family: Arial, sans-serif;;
	}

	.lista {
  list-style: none;
  margin: 0;
  padding: 0;
}

.lista li {
  padding: 10px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
  background-color: #f5f5f5;
}

	.excluir {
  background-color: #8B0000;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 4px;
}
	.container {
		max-width: 800px;
		margin: 0 auto;
		padding: 20px;
		background-color: #fff;
		box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
		border-radius: 5px;
		margin-top: 50px;
		margin-bottom: 50px;
	}

	footer {
		background-color: #333;
		color: #fff;
		padding: 10px 20px;
		text-align: center;
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
	}
	@media screen and (max-width: 768px) {
  main {
    max-width: 72vw;
  }

  legend {
    font-size: 2.4vw;
    margin-bottom: 1.92vw;
  }

  label {
    font-size: 1.6vw;
    margin-bottom: 1.2vw;
  }
}
	</style>
	
	<?php
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "americalagos";

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se ocorreu um erro na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se foi enviado o ID da anotação a ser excluída
    if (isset($_GET['excluir'])) {
        $id = $_GET['excluir'];

        // Prepara uma instrução SQL DELETE para excluir a anotação do banco de dados
        $sql = "DELETE FROM registros WHERE id = $id";

        // Executa a instrução SQL
        if ($conn->query($sql) === TRUE) {
            echo "Anotação excluída com sucesso.";
        } else {
            echo "Erro ao excluir anotação: " . $conn->error;
        }
    }

    // Verifica se o formulário de alterações foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $numero_nota = $_POST['numero_nota'];
        $especificacoes = $_POST['especificacoes'];
        $validade_garantia = $_POST['validade_garantia'];
        $anotacao = $_POST['anotacao'];

        // Prepara uma instrução SQL UPDATE para atualizar as informações no banco de dados
        $sql = "UPDATE registros SET numero_nota = '$numero_nota', especificacoes = '$especificacoes', validade_garantia = '$validade_garantia', anotacao = '$anotacao'";

        // Executa a instrução SQL
        if ($conn->query($sql) === TRUE) {
            echo "Alterações salvas com sucesso.";
        } else {
            echo "Erro ao salvar as alterações: " . $conn->error;
        }
    }

    // Prepara uma instrução SQL SELECT para buscar todas as informações no banco de dados
    $sql = "SELECT * FROM registros";

    // Executa a instrução SQL
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Especificações do produto</title>
	<nav>
          <ul>
            <li><a href="index/index.html">Pagina Inicial</a></li>
            <li><a href="registro.php">Registros</a></li>
          </ul>
    </nav>
</head>
<body>
    <h1>Especificações do produto</h1>

    <!-- Formulário de alterações -->
    <form method="post">
        <label for="numero_nota">Número da nota:</label><br>
        <input type="text" id="numero_nota" name="numero_nota"><br><br>

        <label for="especificacoes">Especificações:</label><br>
        <textarea id="especificacoes" name="especificacoes"></textarea><br><br>

        <label for="validade_garantia">Validade da garantia:</label><br>
        <input type="text" id="validade_garantia" name="validade_garantia"><br><br>

        <label for="anotacao">Anotação:</label><br>
        <textarea id="anotacao" name="anotacao"></textarea><br><br>

        <input type="submit" value="Salvar Alterações">
    </form>

    <!-- Lista de informações -->
    <ul class="lista">
        <?php
            // Verifica se há informações para exibir
            if ($result->num_rows > 0) {
                // Exibe as informações
                while ($row = $result->fetch_assoc()) {
                    echo "<li>Número da nota: " . $row['numero_nota'] . "</li>";
                    echo "<li>Especificações: " . $row['especificacoes'] . "</li>";
                    echo "<li>Validade da garantia: " . $row['validade_garantia'] . "</li>";
                    echo "<li>Anotação: " . $row['anotacao'] . "</li>";
                    echo "<li class='anotacao'><a class='excluir' href='?excluir=" . $row['id'] . "'>Excluir</a></li>";
                    echo "<br>";
                }
            } else {
                echo "<li>Nenhuma informação encontrada.</li>";
            }
        ?>
    </ul>

    <?php
        // Fecha a conexão com o banco de dados
        $conn->close();
    ?>
</body>
</html>
