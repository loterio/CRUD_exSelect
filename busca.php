<link rel="stylesheet" href="css/custom.css">
<?php
    include "menu.php";
  ?>
<form method="post">
  <input type="text" name='busca'>
  <input type="submit">
</form>
<?php
  $text=isset($_POST['busca'])?$_POST['busca']:'';
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=vendas', "root","");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$consulta = $pdo->query("SELECT * FROM marca WHERE descricao LIKE'$text%' ORDER BY descricao;");

		
	} catch(PDOException $e) {
		echo '<b>Error:</b> '.$e->getMessage();
  }
?>
<table>
  <tr>
    <th>Código</th>
    <th>Descrição</th>
  </tr>
  <?php
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr><td>{$linha['codigo']}</td><td>{$linha['descricao']}</td></tr>";
    }
  ?>
</table>