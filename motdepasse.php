<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\style.css">
    <title>Login</title>
</head>
<body>
    <?php include 'top.php';?>
    <?php include 'menu.php'; ?> 
    <h2>Mot de Passe oublié</h2><br>

    <?php
        $newmail = "";
        $_POST['newemail'] = $newmail;
        ?>
        <form class="mdp", action="<?php echo $_SERVER['PHP_SELF']; ?>", method="post">
            Mail utilisateur :<br>
            <input type="email" name="newmail"><br>
            <input type="submit" name="submit" value="Send">            
        </form>
<?php  
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;
 
        if (isset($_POST['newemail'])){
            $mail = htmlentities(strtolower(trim($mail))); // On récupère le mail afin d envoyer le mail pour la récupèration du mot de passe 
 
            // Si le mail est vide alors on ne traite pas
            if(empty($mail)){
                $valid = false;
                $er_mail = "Votre identifiant est inconnu.";
            }
 
            if($valid){
                $verification_mail = $DB->query("SELECT nom_util, prenom_util, email_util, n_mdp 
                    FROM utilisateur WHERE email_util = ?",
                    array($mail));
                $verification_mail = $verification_mail->fetch();
 
                if(isset($verification_mail['email_util'])){
                        // On génère un mot de passe à l'aide de la fonction RAND de PHP
                        $new_pass = rand();
 
                        // Le mieux serait de générer un nombre aléatoire entre 7 et 10 caractères (Lettres et chiffres)
                        password_hash($new_pass, PASSWORD_DEFAULT);

                        $objet = 'Nouveau mot de passe';
                        $to = $verification_mail['email_util'];
 
                        //===== Création du header du mail.
                        $header = "From: NOM_DE_LA_PERSONNE <no-reply@test.com> \n";
                        $header .= "Reply-To: ".$to."\n";
                        $header .= "MIME-version: 1.0\n";
                        $header .= "Content-type: text/html; charset=utf-8\n";
                        $header .= "Content-Transfer-Encoding: 8bit";
 
                        //===== Contenu de votre message
                        $contenu =  "<html>".
                            "<body>".
                            "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme".$verification_mail['nom_util']."</b>,</p><br/>".
                            "<p style='text-align: justify'><i><b>Votre nouveau mot de passe : </b></i>".$new_pass."</p><br/>".
                            "</body>".
                            "</html>";
                        //===== Envoi du mail
                        mail($to, $objet, $contenu, $header);
                        $DB->insert("UPDATE utilisateur SET password_util = ? WHERE email_util = ?", 
                            array($new_pass, $verification_mail['email_util']));
                       
                }       
                header('Location: login.php');
                exit; 
            }
        }
    }
?>
</body>
</html>

--
