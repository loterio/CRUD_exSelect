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
	  <input type="radio" name='tipo' value='2'> Email
	  <input type="radio" name='tipo' value='3'> Telefone
	</form>
	<?php
	  $text=isset($_POST['busca'])?$_POST['busca']:'';
	  $tipo=isset($_POST['tipo'])?$_POST['tipo']:1;
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=cliente', "root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    if($tipo==0){
	      $consulta = $pdo->query("SELECT * FROM cliente WHERE codigo LIKE'$text%';");
	    }else if($tipo==1){
	      $consulta = $pdo->query("SELECT * FROM cliente WHERE nome LIKE'$text%';");
	    }else if($tipo==2){
	      $consulta = $pdo->query("SELECT * FROM cliente WHERE email LIKE'$text%';");
	    }else{
	      $consulta = $pdo->query("SELECT * FROM cliente WHERE telefone LIKE'$text%';");
	    }

		} catch(PDOException $e) {
			echo '<b>Error:</b> '.$e->getMessage();
	  }
	?>
	<table>
	  <tr>
	    <th>Código</th>
	    <th>Nome</th>
	    <th>Email</th>
	    <th>Telefone</th>
	  </tr>
	  <?php
	    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	      echo "<tr><td>{$linha['codigo']}</td><td>{$linha['nome']}</td><td>{$linha['email']}</td><td>{$linha['telefone']}</td></tr>";
	    }
	  ?>
	</table>
</body>
</html>
