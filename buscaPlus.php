<link rel="stylesheet" href="css/custom.css">
<?php 
  $text=isset($_POST['busca'])?$_POST['busca']:'';
  $tipo=isset($_POST['tipo'])?$_POST['tipo']:'';

 include "menu.php";
?>

<form method="post">
  <input type="text" name='busca' value='<?php echo $text;?>'>
  <input type="submit" value='ok'><br/>
  <input type="radio" name='tipo' value='cod'<?php if($tipo=='cod') echo 'checked'; ?>> Código
  <input type="radio" name='tipo' value='desc'<?php if($tipo=='desc') echo 'checked'; ?>> Descrição
<table>
  <tr>
    <th>Código</th>
    <th>Descrição</th>
    <th>Ação</th>
  </tr>
<?php
  $cod=isset($_POST['ex'])?$_POST['ex']:0;
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=vendas', "root","");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $esc = $pdo->query("DELETE FROM marca WHERE codigo = $cod;");

    if($tipo=='desc'){
      $consulta = $pdo->query("SELECT * FROM marca WHERE descricao LIKE'$text%' ORDER BY descricao;");
    }else if($tipo=='cod'){ 
      $consulta = $pdo->query("SELECT * FROM marca WHERE codigo LIKE'$text%' ORDER BY codigo;");
    }

    if(isset($consulta)){
      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "
        <tr>
          <td>{$linha['codigo']}</td>
          <td>{$linha['descricao']}</td>
          <td><button name='ex' value='{$linha['codigo']}'>x</button></td>
        </tr>";
      }
    }
	} catch(PDOException $e) {
		echo '<b>Error:</b> '.$e->getMessage();
  }  
  // echo $tipo; 
  ?>
</table>
</form>
