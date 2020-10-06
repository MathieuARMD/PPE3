<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
<?php include 'top.php';?>
<?php include 'menu.php'; ?> 

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
      <li><a href="ajouter.php">Ajouter</a></li>
      <li><a href="modifier.php">Modifier</a></li>
      <li><a href="desactiver.php">Desactiver</a></li>
      <li><a href="supprimer.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">  
<?php

$order ='';
  $tri = isset($_GET['tri']) ? $_GET['tri']: 0; // recupere le tri, envoyé avec les icones du tableau
  switch ($tri){ // switch, completera le order by de la requete sql
    case 0:
      $order = "email_util";
    break;
    case 1:
      $order = "password_util";
    break;
    case 2:
      $order = "nom_util";
    break;
    case 3:
      $order = "prenom_util";
    break;
    case 4:
      $order = "statut_util";
    break;
    case 5:
      $order = "matricule_cont";
    break;
    case 6:
      $order = "id_type_util";
    break;
    default:
    break;
  }

  //pour filtrer les questions sans réponse
  if (isset($_POST['vide'])){ // si $post[vide] existe
    $is_vide = $_POST['vide'];
  }
  else {
      $is_vide =0; // sinon booléen à 0
  } 
  if ($is_vide==1){ // regarde le booleen est vrai
    $filtre_vide="AND reponse IS NULL"; //rajoute la condition en sql si vrai
  }
  else {$filtre_vide="";} //sinon ne rajoute rien dans la requete
  
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

  $sql = "select email_util, password_util, nom_util, prenom_util,statut_util,matricule_cont,id_type_util from utilisateur WHERE is_disabled = '0'"; // requete sql
  $dsn = 'mysql:host=localhost;dbname=fredi;charset=UTF8'; 
  $user = 'root';
  $password = '';
  try {
  $dbh = new PDO($dsn, $user, $password);
  //$sql = "select id_faq, pseudo, question, reponse from faq F, user U where F.id_user=U.id_user ORDER BY pseudo";
  $sth = $dbh->prepare($sql);
  $sth->execute(); 
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : ".$ex->getMessage());
  }


  $modif = isset($_GET['modif']) ? $_GET['modif']: 0;  //Reception  numero erreur
switch ($modif) { //si pas de session -> echo erreur
  case 1 :
  echo"<p class='centre'>1 enregistrement ajouté.</p>";
  break;
  case 2:
  echo"<p class='centre'>1 enregistrement modifié.</p>"; 
  break;
  case 3:
  echo"<p class='centre'>1 enregistrement supprimé.</p>"; 
  break;
  default:
  break;
 }


  // Affichage de la liste des colonnes
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo "<tr><th>E-mail</th>";
  echo "<th>Mot de passe</th>";
  echo "<th>Nom</th>";
  echo "<th>Prenom</th>";
  echo "<th>Statut</th>";
  echo "<th>Matricule</th>";
  echo "<th>Type utilisateur</th>";
  if (isset($_SESSION['session_libtype'])) { // si connecté
        echo "<th>Action</th>"; 
      }
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['email_util']."</td>"; 
  echo "<td><p>Confidentiel</p></td>"; 
  echo "<td>".$row['nom_util']."</td>"; 
  echo "<td>".$row['prenom_util']."</td>"; 
  echo "<td>".$row['statut_util']."</td>"; 
  echo "<td>".$row['matricule_cont']."</td>"; 
  echo "<td>".$row['id_type_util']."</td>"; 
  if (isset($_SESSION['session_libtype'])) { // si connecté 
      echo "<td><a href='modifier_user.php?mail=".$row['email_util']."'><img src='img/tableau/edit.png' width='50' height='50'></a></td>"; 
  }
  }
  echo "</tr>"; 
echo "</table>";

?>
</body>
</html>