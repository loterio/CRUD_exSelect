<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS 
    https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    -->
    <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
    <style>
      .red {
        color: red;
      } 
      .blue {
        color: blue;
      }
    </style>
    <title>ATV PDO - Alunos</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Alunos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <?php
    include "menu.php";
  ?>
    </div>
  </nav>  
  <br>


  <?php 
    $grade=isset($_POST['trechoBusca'])?$_POST['trechoBusca']:'';
    $searchMode=isset($_POST['srch'])?$_POST['srch']:null;
  ?>

<div class="container">
  <form method="post">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-lg">Nota</span>
      </div>
      <input type="text" name='trechoBusca' class="form-control" placeholder='Digite a nota pela qual deseja buscar' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value='<?php echo $grade; ?>'>
    </div>
    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModalCenter">
          Ajuda
        </button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ajuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Ela será realizada com base no valor digitado no campo de texto e 
                irá retornar todas as notas menores ou iguais ao valor digitado.<br><br>
                Caso nenhuma nota seja marcada, a busca será realizada em relação 
                a todas as notas
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <input type="radio" name='srch' value='0' <?php if($searchMode=='0') echo 'checked';?>> Nota 1
      </div>
      <div class="col-2">
        <input type="radio" name='srch' value='1' <?php if($searchMode=='1') echo 'checked';?>> Nota 2
      </div>
      <div class="col-2">
        <input type="radio" name='srch' value='2' <?php if($searchMode=='2') echo 'checked';?>> Nota 3<br><br>
      </div>
    </div>
      <input type="submit" class="btn btn-primary btn-lg btn-block" value='buscar' type="button"><br> 
  </form>

  <table class="table table-striped table-borderless">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Nota 1</th>
        <th scope="col">Nota 2</th>
        <th scope="col">Nota 3</th>
        <th scope='col'>Média</th>
      </tr> 
    </thead>
    <tbody>
      <?php
        function coloreNota($nota) {
          if($nota<7){
            return "red";
          }else if($nota>=7 && $nota <= 10){
            return "blue";
          }
        }

        try {
          $pdo = new PDO('mysql:host=localhost;dbname=alunos', "root","");
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
          if($searchMode==0){
            $consulta = $pdo->query("SELECT * FROM aluno WHERE nota1 <= '$grade';");
          }else if($searchMode==1){
            $consulta = $pdo->query("SELECT * FROM aluno WHERE nota2 <= '$grade';");
          }else if($searchMode==1){
            $consulta = $pdo->query("SELECT * FROM aluno WHERE nota3 <= '$grade';");
          }else{
            $consulta = $pdo->query("SELECT * FROM aluno WHERE nota1 <= '$grade' OR  nota2 <= '$grade' OR nota3 <= '$grade';");
          }
                      
        } catch(PDOException $e) {
          echo '<b>Error:</b> '.$e->getMessage();
        }

        $med=0;
        $medDasMedias=0;
        $m1=0;
        $m2=0;
        $m3=0;
        $qtd=0;

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

          $med=($linha['nota1']+$linha['nota2']+$linha['nota3'])/3;
          $medDasMedias+=$med;
          $m1+=$linha['nota1'];
          $m2+=$linha['nota2'];
          $m3+=$linha['nota3'];

          echo "
          <tr>
            <th scope='row'>{$linha['matricula']}</th>
            <td>{$linha['nome']}</td>
            <th class='".coloreNota($linha['nota1'])."'>{$linha['nota1']}</th>
            <th class='".coloreNota($linha['nota2'])."'>{$linha['nota2']}</th>
            <th class='".coloreNota($linha['nota3'])."'>{$linha['nota3']}</th>
            <th class='".coloreNota($med)."'>".number_format($med, 1)."</th>
          </tr>";
          $qtd++;
        }
        
        if($qtd<>null){
          $m1/=$qtd;
          $m2/=$qtd;
          $m3/=$qtd;
          $medDasMedias/=$qtd;
        }
        
          echo "
            <tr>
              <th scope='row'></th>
              <td></td>
              <th class='".coloreNota($m1)."'>".number_format($m1, 1)."</th>
              <th class='".coloreNota($m2)."'>".number_format($m2, 1)."</th>
              <th class='".coloreNota($m3)."'>".number_format($m3, 1)."</th>
              <th class='".coloreNota($medDasMedias)."'>".number_format($medDasMedias, 1)."</th>
            </tr>"; 
      ?>
    </tbody>
  </table>
</div>            


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js" crossorigin="anonymous">
      $('#myModal').modal(options)
    </script>
  </body>
</html>

