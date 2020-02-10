<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
		<title>Atividades BD com PHP</title>
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
  <?php
    include "menu.php";
  ?>
	<form method="post">
    <input type="text" name='busca'>
    <input type="submit" value='pesquisar'><br/>
    <input type="radio" name='tipo' value='0'> Código
    <input type="radio" name='tipo' value='1'> Nome
    <input type="radio" name='tipo' value='2'> Sigla
  </form>
  <?php
    $text=isset($_POST['busca'])?$_POST['busca']:'';
    $tipo=isset($_POST['tipo'])?$_POST['tipo']:1;
    try {
      $pdo = new PDO('mysql:host=localhost;dbname=estados', "root","");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if($tipo==0){
        $consulta = $pdo->query("SELECT * FROM estados WHERE codigo LIKE'$text%';");
      }else if($tipo==1){
        $consulta = $pdo->query("SELECT * FROM estados WHERE nome LIKE'$text%';");
      }else{
        $consulta = $pdo->query("SELECT * FROM estados WHERE sigla LIKE'$text%';");
      }

    } catch(PDOException $e) {
      echo '<b>Error:</b> '.$e->getMessage();
    }
  ?>
  <table>
    <tr>
      <th>Código</th>
      <th>Nome</th>
      <th>Sigla</th>
    </tr>
    <?php
      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>{$linha['codigo']}</td><td>{$linha['nome']}</td><td>{$linha['sigla']}</td></tr>";
      }
    ?>
  </table>
</body>
</html>
