  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <nav>
            <ul>
              <li><a href="index/index.html">Pagina Inicial</a></li>
              <li><a href="registro.php">Registros</a></li>
            </ul>
          </nav>

          <script>
  function searchTable() {
    // Declara as variáveis que serão usadas na pesquisa
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementsByTagName("table")[0];
    tr = table.getElementsByTagName("tr");

    // Loop por todas as linhas da tabela e oculta aquelas que não correspondem à pesquisa
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td");
      for (j = 0; j < td.length; j++) {
        if (td[j]) {
          txtValue = td[j].textContent || td[j].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
            break;
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  }
  </script>

  </head>


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
  main {
    margin: 1.6vw auto;
    max-width: 80vw;
    padding: 1.6vw;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 0.8vw;
    box-shadow: 0px 0px 0.8vw rgba(0, 0, 0, 0.2);
  }

  .input-container{
    display: flex;
    border: none;
    appearance: none;
    padding: 10px;
    margin: 0px 10px 10px 10px;
    width: 97%;
    color: rgb(0, 0, 0);
    background-color: #ffffff;
    font-size: 15px;
    border-radius:0.8vw;
  }

  tbody {
    background-color:   #f1f1f1;
  }


  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  th {
    background-color: #4CAF50;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  .editar {
    background-color: #d0c040;
    color: black;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border-radius: 4px;
  }

  .visualizar {
    background-color: #98FB98;
    color: black;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border-radius: 4px;
  }

  .anotacao {
    background-color: #0000CD;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border-radius: 4px;
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

    table {
      font-size: 1.6vw;
    }
  }
  </style>

  <div>
  <input class="input-container" type="text" id="myInput" onkeyup="searchTable()" placeholder="Pesquisar...">
  </div>

  <?php

  date_default_timezone_set('America/Sao_Paulo');

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
    // Verifica se um arquivo foi enviado
    if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['name'])) {
      // Define as configurações do upload
      $diretorio = "uploads/"; // Diretório onde o arquivo será armazenado
      $nome_arquivo = $_FILES['arquivo']['name']; // Nome do arquivo
      $caminho_arquivo = $diretorio . $nome_arquivo; // Caminho completo onde o arquivo será armazenado

      // Move o arquivo para o diretório especificado
      if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
        // Prepara uma instrução SQL INSERT
        $stmt = $conn->prepare("INSERT INTO registros (modelo, setor, data, numero, responsavel, anotacao, arquivo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $modelo, $setor, $data, $numero, $responsavel, $anotacao, $caminho_arquivo);
        // Executa a instrução SQL
        if ($stmt->execute()) {
          $last_id = $stmt->insert_id;
          echo "Registro salvo com sucesso. ID do registro: " . $last_id;
        } else {
          echo "Erro ao salvar registro: " . $stmt->error;
        }
      } else {
        echo "Erro ao fazer upload do arquivo.";
      }
    } else {
// Prepara uma instrução SQL INSERT
      $stmt = $conn->prepare("INSERT INTO registros (modelo, setor, data, numero, responsavel) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $modelo, $setor, $data, $numero, $responsavel);

      // Executa a instrução SQL
      if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        echo "Registro salvo com sucesso. ID do registro: " . $last_id;
      } else {
        echo "Erro ao salvar registro: " . $stmt->error;
      }
    }
  }

  // Consulta os registros na tabela 'registros'
  $sql = "SELECT * FROM registros";
  $result = $conn->query($sql);

  // Verifica se há registros retornados
  if ($result->num_rows > 0) {
    // Exibe os registros em uma tabela
    echo "<table><tr><th>ID</th><th>Modelo</th><th>Setor</th><th>Data</th><th>Número</th><th>Responsável</th><th>Visualizar</th><th>Editar</th><th>Excluir</th></tr>";
    while($row = $result->fetch_assoc()) {
      // Modifica o formato da data
      $data = date("d/m/Y", strtotime($row["data"]));
      // Exibe os valores separados por "|"
      echo "<tr><td>".$row["id"]."</td><td>".$row["modelo"]."</td><td>".$row["setor"]."</td><td>".$data."</td><td>".$row["numero"]."</td><td>".$row["responsavel"]."</td><td><a class='visualizar' href='visualizar.php?id=".$row["id"]."'>Visualizar</a></td><td><a class='editar' href='editar.php?id=".$row["id"]."'>Editar</a></td><td><a class='excluir' href='excluir.php?id=".$row["id"]."'>Excluir</a></td></tr>";
    }
    echo "</table>";
  } else {
    echo "Não há registros.";
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
  ?>
  </html>