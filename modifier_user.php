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

  $mail=isset($_GET['mail']) ? $_GET['mail']: '';
  $sql = "select * utilisateur WHERE email_util = :email_util"; // requete sql
  $dsn = 'mysql:host=localhost;dbname=fredi;charset=UTF8'; 
  $user = 'root';
  $password = '';
  try {
  $dbh = new PDO($dsn, $user, $password);
  //$sql = "select id_faq, pseudo, question, reponse from faq F, user U where F.id_user=U.id_user ORDER BY pseudo";
  $sth = $dbh->prepare($sql);
              $sth->execute(array( 
                ':email_util' => $mail , ));
              $row = $sth->fetch(PDO::FETCH_ASSOC);
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
?>
 <form  method='post'>
 <textarea name="nom" rows="1" cols="25"><?php echo $row['mail'];?></textarea> <!-- mettre la question dans le champ par défaut ---> 

</body>
</html>