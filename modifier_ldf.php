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
<?php

  //pour filtrer par utilisateur
  if (isset($_POST['utilisateur'])){ // si $post[utilisateur] existe
    if ($_POST['utilisateur'] != '0') { // si ce n'est pas tous les utilisateurs
        $utilisateur = " AND pseudo='".$_POST['utilisateur']."'"; // complete la requete pour filtrer avec son nom
    }
    else {
      $utilisateur=""; // sinon requete inchangée
  }
  }
  else {
      $utilisateur=""; // sinon requete inchangée
  }

  $LdfDAO = new LdfDAO();
  $rows = $LdfDAO->findAll();

    // Affichage de la liste des colonnes
  echo "<br><br>";
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo '<tr align="center" ><th>ID</th>';
  echo '<th align="center" >Date</th>';
  echo '<th align="center" >Libellé</th>';
  echo '<th align="center" >Coût péage</th>';
  echo '<th align="center" >Coût repas</th>';
  echo '<th align="center" >Coût hébergement</th>';
  echo '<th align="center" >Nb KM</th>';
  echo '<th align="center" >Total KM</th>';
  echo '<th align="center" >Total LDF</th>';
  echo '<th align="center" >MDF</th>';
  echo '<th align="center" >Année per</th>';
  echo '<th align="center" >Utilisateur</th>';
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{
  $id = $row['id_ldf'];
  echo "<tr>";
  echo "<td><a href='modifier_ldf.php?id_ldf=".$id."'>".$id."</a></td>";
  echo "<td>".$row['lib']."</td>";
  echo "<td>".$row['cpeage']."</td>";
  echo "<td>".$row['crepas']."</td>";
  echo "<td>".$row['cheberge']."</td>";
  echo "<td>".$row['nbkm']."</td>";
    echo "<td>".$row['motiff']."</td>";
    echo "<td>".$row['tnbkm']."</td>";
    echo "<td>".$row['tldf']."</td>";
    echo "<td>".$row['motiff']."</td>";
    echo "<td>".$row['anneeper']."</td>";
    echo "<td>".$row['emailutil']."</td>";
  }
  echo "</tr>";
echo "</table>";
?>
<?php
$raws = $LdfDAO->get_anneeper();
$rawz = $LdfDAO->findmail();
if (isset($_GET['id_url_ligue'])){ // si $post[id_url_ligue] existe
  $Liguerempl = new LigueDAO();
  $id_rempl = $_GET['id_url_ligue'];
  $rempl = $LdfDAO->find($id_rempl);
  $remid = $rempl['lib_ligue'];
  $remurl = $rempl['URL_ligue'];
  $remcont = $rempl['contact_ligue'];
  $remtel = $rempl['telephone_ligue'];

    $ldf = $LdfDAO->find($id_ldf);
    $date = date('y.m.d');
    $lib = $_POST['lib'];
    $cpeage = $_POST['cpeage'];
    $crepas = $_POST['crepas'];
    $cheberge = $_POST['cheberge'];
    $nbkm = $_POST['nbkm'];
    $tnbkm = ($nbkm * $forfaitkm);
    $tldf = ($cheberge + $crepas + $cpeage);
    $motiff = $MotifDao->findtheID($_POST['motiff']);
    $periode = $_POST['anneeperr'];
    $util = $_POST['emailutil'];

}else{
  $Liguerempl = new LigueDAO();
  $id_rempl = 0;
  $remid = "&nbsp";
  $remurl = "&nbsp";
  $remcont = "&nbsp";
  $remtel = "&nbsp";
}


?>
<br>
 <form action="modifier_ligue.php" method="post">
 <label for="id_ligue">ID :</label><br>
  <select name="id_ligue" id="id_ligue" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }
  ?>
  </select><br><br>
<label for="lib">Libellé :</label><br>
<input type="text" id="lib" name="lib" value="<?php echo($remid)?>" required><br><br>
<label for="url">URL :</label><br>
<input type="text" id="url" name="url" value="<?php echo($remurl)?>" required><br><br>
<label for="contact">Contact :</label><br>
<input type="text" id="contact" name="contact" value="<?php echo($remcont)?>"><br><br>
<label for="tel">Telephone :</label><br>
<input type="number" id="tel" name="tel" value="<?php echo($remtel)?>"><br><br>
<label for="mail">Email du controleur :</label><br>
<select name="mail" id="mail" required>
  <?php
    foreach($rawz as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }
  ?>

</select><br><br>
<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
        if(isset($_POST['enregistrement'])){
            $id_ligue = $_POST['id_ligue'];
            $lib      = $_POST['lib'];
            $url      = $_POST['url'];
            $contact  = $_POST['contact'];
            $tel      = $_POST['tel'];
            $email    = $_POST['mail'];
            $Ligue = new Ligue(array(
              'id'  => $id_ligue,
              'lib'       => $lib,
              'url'       => $url,
              'contact'   => $contact,
              'telephone' => $tel,
              'mail'     => $email
            ));
            $nb = $LigueDAO->update($Ligue);
            if($nb == 1){
              echo "<br>$lib a bien été modifié(e)";
            }else{
              echo "<br>$lib n'a pas été modifié(e)";
            }
        }
  ?>
</form>
<button onclick="myFunction()">Reload page</button>
<script>
function myFunction() {
    document.location.reload();
}
</script>
</body>
</html>