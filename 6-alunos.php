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
		
    <label for="busca">Opções de busca </label>
		<input type="text" name='busca' placeholder='Digite sua busca'><br/>
    <input type="radio" value='0' name="options"> Código
    <input type="radio" value='1' name="options"> Nome
    <input type="radio" value='2' name="options"> Data de Nascimento
    <input type="radio" value='3' name="options"> Curso<br/>
		<input type="submit" value='pesquisar'><br><br>
	</form>
	<?php
	  $text=isset($_POST['busca'])?$_POST['busca']:'';
		$tipo=isset($_POST['options'])?$_POST['options']:null;

		try {
			$pdo = new PDO('mysql:host=localhost;dbname=alunos', "root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    if($tipo==0){
	      $consulta = $pdo->query("SELECT * FROM alunos WHERE codigo LIKE'$text%';");
	    }else if($tipo==1){
	      $consulta = $pdo->query("SELECT * FROM alunos WHERE nome LIKE'$text%';");
	    }else if($tipo==2){
				$consulta = $pdo->query("SELECT * FROM alunos WHERE dataNasc LIKE'$text%';");
			}else{
	      $consulta = $pdo->query("SELECT * FROM alunos WHERE curso LIKE'$text%';");
	    }

		} catch(PDOException $e) {
			echo '<b>Error:</b> '.$e->getMessage();
	  }
	?>
	<table>
	  <tr>
			<th>Código</th>
			<th>Nome</th>
	    <th>Data de Nasc.</th>
	    <th>Curso</th>
	  </tr>
		<?php
			// <td>{$linha['']}</td>
	    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	      echo "<tr><td>{$linha['codigo']}</td><td>{$linha['nome']}</td><td>{$linha['dataNasc']}</td><td>{$linha['curso']}</td></tr>";
	    }
	  ?>
	</table>
</body>
</html>
