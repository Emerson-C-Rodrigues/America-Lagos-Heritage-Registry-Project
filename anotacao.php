<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Especificações</title>
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
  list-style: none;
  margin: 0;
  padding: 0;
}

nav li {
  display: inline-block;
  margin-right: 20px;
}

nav a {
  color: #000;
  text-decoration: none;
}
    .anotacao{
      border: none;
  text-align: center;
  font-weight: bold;
  appearance: none;
  margin: 10px 10px 10px 10px;
  width: auto;
  font-size: 20px;
  background-color: #ffffff;
}


    .container {
      display: block;
  border: none;
  appearance: none;
  padding: 10px;
  margin: 20px 10px 10px 10px;
  width: auto;
  color: rgb(0, 0, 0);
  font-size: 15px;
  border-radius:0.8vw;
  background-color: rgba(255, 255, 255, 0.8);
    }

    header {
  text-align: center;
  padding: 1.6vw;
  background-color: rgba(255, 255, 255, 0.8);
  border-bottom: 0.8px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 0.8vw rgba(0, 0, 0, 0.2);
}

    .anotacao {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<header> 
          
<h1>Especificações</h1>
          <nav>
            <ul>
              <li><a href="index/index.html">Pagina Inicial</a></li>
              <li><a href="registro.php">Registros</a></li>
            </ul>
          </nav>
</header>
<body>
  <div class="container">
    

    <?php
      // Verifica se o ID foi passado como parâmetro
      if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "americalagos";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta a anotação para o ID especificado
        $sql = "SELECT anotacao FROM registros WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Exibe a anotação encontrada
            echo '<div class="anotacao">' . $row["anotacao"] . '</div>';
          }
        } else {
          echo "Nenhuma anotação encontrada para o ID especificado.";
        }

        $conn->close();
      } else {
        echo "Nenhum ID especificado.";
      }
    ?>
  </div>
</body>
</html>