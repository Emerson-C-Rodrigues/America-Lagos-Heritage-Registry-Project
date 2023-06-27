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
header {
  text-align: center;
  padding: 1.6vw;
  background-color: rgba(255, 255, 255, 0.8);
  border-bottom: 0.8px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 0.8vw rgba(0, 0, 0, 0.2);
}

main {
  margin: 1.6vw auto;
  max-width: 60vw;
  padding: 1.6vw;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 0.8vw;
  box-shadow: 0px 0px 0.8vw rgba(0, 0, 0, 0.2);
}

form {
  margin: 0;
  padding: 0;
  border: none;
  background-color: transparent;
}

fieldset {
  margin: 0;
  padding: 0;
  border: none;
}

legend {
  font-size: 1.6vw;
  font-weight: bold;
  margin-bottom: 1.6vw;
}

label {
  display: block;
  margin-bottom: 0.8vw;
  font-size: 1.2vw;
}

input[type="text"],
input[type="date"] {
  display: block;
  margin-bottom: 1.6vw;
  width: 88.9%;
  padding: 1.6vw;
  border-radius: 0.8vw;
  border: none;
}

input[type="submit"]{
   display: center;
  margin-bottom: 1.6vw;
  width: 60vw;
  padding: 1.6vw;
  border-radius: 0.8vw;
  border: none;
  
}

input[type="text"],
input[type="date"] {
  background-color: rgba(255, 255, 255, 0.8);
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  font-size: 1.2vw;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

footer {
  text-align: center;
  padding: 0.8vw;
  background-color: rgba(255, 255, 255, 0.8);
  border-top: 0.8px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 0.8vw rgba(0, 0, 0, 0.2);
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <nav>
          <ul>
            <li><a href="index/index.html">Pagina Inicial</a></li>
            <li><a href="registro.php">Registros</a></li>
          </ul>
        </nav>
</head>
<body>
<?php
$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "americalagos"; // Nome do banco de dados

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se ocorreu um erro na conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtém os dados do formulário
  $modelo = $_POST["modelo"];
  $setor = $_POST["setor"];
  $data = date("Y-m-d"); // Obtém a data atual
  $numero = $_POST["numero"];
  $responsavel = $_POST["responsavel"];
  $anotacao = $_POST["anotacao"];
  $id = $_POST["id"]; // Obtém o ID do registro a ser atualizado

  // Prepara uma instrução SQL UPDATE
  $sql = "UPDATE registros SET modelo='$modelo', setor='$setor', data='$data', numero='$numero', responsavel='$responsavel', anotacao='$anotacao' WHERE id=$id";

  // Executa a instrução SQL
  if ($conn->query($sql) === TRUE) {
    echo "Registro atualizado com sucesso.";
  } else {
    echo "Erro ao atualizar registro: " . $conn->error;
  }
}


// Verifica se foi enviado um ID via método GET
if (isset($_GET["id"])) {
  // Obtém o ID e prepara uma instrução SQL SELECT
  $id = $_GET["id"];
  $sql = "SELECT * FROM registros WHERE id=$id";

  // Executa a instrução SQL
  $result = $conn->query($sql);

  // Verifica se há registros retornados
  if ($result->num_rows > 0) {
    // Exibe o formulário de edição com os valores preenchidos
    $row = $result->fetch_assoc();
    echo "<form method='POST'>";
    echo "ID: <input type='text' name='id' value='".$row["id"]."' readonly><br>";
    echo "Modelo: <input type='text' name='modelo' value='".$row["modelo"]."'><br>";
    echo "Setor: <input type='text' name='setor' value='".$row["setor"]."'><br>";
    echo "Número: <input type='text' name='numero' value='".$row["numero"]."'><br>";
    echo "Responsável: <input type='text' name='responsavel' value='".$row["responsavel"]."'><br>";
    echo "anotacao: <input type='text' name='anotacao' value='".$row["anotacao"]."'><br>";
    echo "<input type='submit' value='Atualizar'>";
    echo "</form>";
  } else {
    echo "Registro não encontrado.";
  }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
</body>
</html>
