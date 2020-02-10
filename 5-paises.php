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
			<option value="1">Nome</option>
      <option value="2">Sigla</option>
      <option value="3">Continentes</option>
      <!-- <optgroup label='Continentes'>
        <option value="4">América</option>
        <option value="4">Europa</option>
        <option value="4">África</option>
        <option value="4">Ásia</option>
        <option value="4">Oceania</option>
      </optgroup> -->
		</select><br>
		<input type="submit" value='pesquisar'><br><br>
	</form>
	<?php
	  $text=isset($_POST['busca'])?$_POST['busca']:'';
		$tipo=isset($_POST['options'])?$_POST['options']:null;

		try {
			$pdo = new PDO('mysql:host=localhost;dbname=paises', "root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    if($tipo==0){
	      $consulta = $pdo->query("SELECT * FROM paises WHERE cod LIKE'$text%' ORDER BY cod;");
	    }else if($tipo==1){
	      $consulta = $pdo->query("SELECT * FROM paises WHERE nome LIKE'$text%' ORDER BY nome;");
	    }else if($tipo==2){
				$consulta = $pdo->query("SELECT * FROM paises WHERE sigla LIKE'$text%' ORDER BY cod;");
			}else{
	      $consulta = $pdo->query("SELECT * FROM paises WHERE continente LIKE'$text%';");
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
	    <th>Continente</th>
	  </tr>
		<?php
			// <td>{$linha['']}</td>
	    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	      echo "<tr><td>{$linha['cod']}</td><td>{$linha['nome']}</td><td>{$linha['sigla']}</td><td>{$linha['continente']}</td></tr>";
	    }
	  ?>
	</table>
</body>
</html>
