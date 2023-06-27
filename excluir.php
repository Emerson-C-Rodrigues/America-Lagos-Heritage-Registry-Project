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

label{
  display: block;
  color: red;
  margin-bottom: 0.8vw;
  font-size: 1.2vw;
}

input[type="number"] {
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
.title{
  color:red;
}
</style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "americalagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $sql = "DELETE FROM registros WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    echo "Registro excluído com sucesso.";
  } else {
    echo "Erro ao excluir registro: " . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title >Excluir Registro</title>
  <nav>
          <ul>
            <li><a href="index/index.html">Pagina Inicial</a></li>
            <li><a href="registro.php">Registros</a></li>
          </ul>
        </nav>
</head>
<body>  
  <h2 class="title" >Excluir Registro</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="id">ID do Registro:</label>
    <input type="number" name="id">
    <input type="submit" value="Excluir">
  </form>
</body>
</html>