<?php
    include "menu.php";
  ?>
<select name='marca' id=''>
  <option value=''></option>
<?php
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=vendas', "root","");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$consulta = $pdo->query("SELECT * FROM marca;");

		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$linha['codigo']}'>{$linha['descricao']}</option>";
    }
	} catch(PDOException $e) {
		echo 'Error: '.$e->getMessage();
	}
?>
</select>