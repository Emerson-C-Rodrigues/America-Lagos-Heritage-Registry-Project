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

// Verifica se um ID foi fornecido
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Consulta o registro correspondente ao ID fornecido
  $sql = "SELECT * FROM registros WHERE id = $id";
  $result = $conn->query($sql);
  
  // Verifica se o registro foi encontrado
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $caminho_arquivo = $row["arquivo"];
    // Verifica se o arquivo existe
    if(file_exists($caminho_arquivo)) {
      // Exibe o arquivo
      header("Content-Type: application/pdf"); // Define o tipo de arquivo a ser exibido
      readfile($caminho_arquivo);
    } else {
      echo "Arquivo não encontrado.";
    }
  } else {
    echo "Registro não encontrado.";
  }
} else {
  echo "ID não fornecido.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>