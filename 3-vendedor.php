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
		
		<label for="select">Opções de busca </label>
		<input type="text" name='busca' placeholder='Digite sua busca'>
		<select name="options" id="select">
			<option value="">Nenhum</option>
			<option value="0">Código</option>
			<option value="1">Login</option>
			<option value="2">Nome</option>
			<option value="3">E-mail</option>
			<option value="4">Telefone</option>
		</select>
		<input type="submit" value='pesquisar'><br><br>
	</form>
	<?php
	  $text=isset($_POST['busca'])?$_POST['busca']:'';
		$tipo=isset($_POST['options'])?$_POST['options']:null;

		try {
			$pdo = new PDO('mysql:host=localhost;dbname=vendedor', "root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    if($tipo==0){
	      $consulta = $pdo->query("SELECT * FROM vendedor WHERE codigo LIKE'$text%';");
	    }else if($tipo==1){
	      $consulta = $pdo->query("SELECT * FROM vendedor WHERE nomeDeUsuario LIKE'$text%';");
	    }else if($tipo==2){
				$consulta = $pdo->query("SELECT * FROM vendedor WHERE nome LIKE'$text%';");
			}else if($tipo==3){
				$consulta = $pdo->query("SELECT * FROM vendedor WHERE email LIKE'$text%';");
	    }else{
	      $consulta = $pdo->query("SELECT * FROM vendedor WHERE telefone LIKE'$text%';");
	    }

		} catch(PDOException $e) {
			echo '<b>Error:</b> '.$e->getMessage();
	  }
	?>
	<table>
	  <tr>
			<th>Código</th>
			<th>Login</th>
	    <th>Nome</th>
	    <th>Email</th>
	    <th>Telefone</th>
	  </tr>
		<?php
			// <td>{$linha['']}</td>
	    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	      echo "<tr><td>{$linha['codigo']}</td><td>{$linha['nomeDeUsuario']}</td><td>{$linha['nome']}</td><td>{$linha['email']}</td><td>{$linha['telefone']}</td></tr>";
	    }
	  ?>
	</table>
</body>
</html>
