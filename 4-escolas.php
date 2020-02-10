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
			<option value="1">Nome da escola</option>
			<option value="2">Cidade</option>
			<option value="3">Número de alunos</option>
			<option value="4">Nome da diretora</option>
		</select>
		<input type="submit" value='pesquisar'><br/><br/>
	</form>
	<?php
	  $text=isset($_POST['busca'])?$_POST['busca']:'';
		$tipo=isset($_POST['options'])?$_POST['options']:null;

		try {
			$pdo = new PDO('mysql:host=localhost;dbname=escola', "root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    if($tipo==0){
	      $consulta = $pdo->query("SELECT * FROM escola WHERE cod LIKE'$text%';");
	    }else if($tipo==1){
	      $consulta = $pdo->query("SELECT * FROM escola WHERE nomeEscola LIKE'$text%';");
	    }else if($tipo==2){
				$consulta = $pdo->query("SELECT * FROM escola WHERE cidade LIKE'$text%';");
			}else if($tipo==3){
				$consulta = $pdo->query("SELECT * FROM escola WHERE numAlunos LIKE'$text%';");
	    }else{
	      $consulta = $pdo->query("SELECT * FROM escola WHERE nomeDiretora LIKE'$text%';");
	    }

		} catch(PDOException $e) {
			echo '<b>Error:</b> '.$e->getMessage();
	  }
	?>
	<table>
	  <tr>
			<th>Código</th>
			<th>Nome da Escola</th>
	    <th>Cidade</th>
	    <th>Nº de Alunos</th>
	    <th>Nome Diretor(a)</th>
	  </tr>
		<?php
			// <td>{$linha['']}</td>
	    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	      echo "<tr><td>{$linha['cod']}</td><td>{$linha['nomeEscola']}</td><td>{$linha['cidade']}</td><td>{$linha['numAlunos']}</td><td>{$linha['nomeDiretora']}</td></tr>";
	    }
	  ?>
	</table>
</body>
</html>
