<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligne de frais</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
<?php include 'top.php';?>
<?php include 'menu.php'; ?>
<?php require_once "init.php";?>

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>'.$_SESSION['session_libtype'].'</h2>'; 
  }else {
    echo'<center><h3 style="color:red"> Il semblerai qu&apos;il y ai une erreur, veuillez r&eacute;essayer.</h3></center>';
  }?>
  
<br><br><br>

<hr color="black">
<nav>
  <ul>
      <li><a href="ajouter_ldf.php">Ajouter</a></li>
      <li><a href="modifier_ldf.php">Modifier</a></li>
      <li><a href="supprimer_ldf.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br><br>
<?php $LdfDAO = new LdfDAO();
      $raws = $LdfDAO->get_lib();
?>
<form action="ajouter_ldf.php" method="post">
<label for="lib">Libellé :</label><br>
<input type="text" id="lib" name="lib" required><br><br>
<label for="cpeage">Coût péage :</label><br>
<input type="text" id="cpeage" name="cpeage" required><br><br>
<label for="crepas">Coût repas :</label><br>
<input type="text" id="crepas" name="crepas" ><br><br>
<label for="cheberge">Coût Hébergement:</label><br>
<input type="text" id="cheberge" name="cheberge" ><br><br>
<label for="nbkm">Nombre de KM :</label><br>
<input type="text" id="nbkm" name="nbkm" ><br><br>
<select name="motiff" id="motiff" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
</select><br><br>
<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
    $LdfDao = new LdfDAO();
  if(isset($_POST['enregistrement'])){
          $LdfDao = new LdfDao();
          $lib = $_POST['lib'];
          $cpeage = $_POST['cpeage'];
          $crepas = $_POST['crepas'];
          $cheberge = $_POST['cheberge'];
          $nbkm = $_POST['nbkm'];
          $motiff = $_POST['motiff'];

          $Ldfdao = new LdfDAO();
          $id_ldf = $Ldfdao->findid($lib);

          $Ldf = new Ldf(array(
            'lib'         => $lib,
            'cpeage'      => $cpeage,
            'crepas'      => $crepas,
            'cheberge'    => $cheberge,
            'nbkm'        => $nbkm,
            'motiff'      => $motiff
          ));
          
          $count = $LdfDao->insert($Ldf);
          if(isset($_POST['enregistrement'])){    
            if($count == 1){
              echo "<br><br>"; 
              echo "<p> ".$lib." a bien été ajouté dans la base FREDI</p>";
            }else{
              echo "<br><br>"; 
              echo "<p>".$lib." n'a pas été ajouté dans la base FREDI</p>";
            } 
          }
        }       
?>
</form>
</body>
</html>