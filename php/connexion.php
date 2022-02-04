<?php
session_start();

$bdd = mysqli_connect("localhost", "root", "", "blog");
if(isset($_POST['formconnexion'])) {
   $loginconnect =$_POST['loginconnect'];
   $mdpconnect = $_POST['mdpconnect'];
   echo"SELECT * FROM utilisateurs WHERE login = $loginconnect";
   $res = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE `login` = '$loginconnect'");
   $array= mysqli_fetch_all($res, MYSQLI_ASSOC);
   var_dump($array);


if ($mdpconnect == $array[0]['password'] && $loginconnect == $array[0]['login']) {
      $_SESSION['login'] = $loginconnect;
      $_SESSION['droits']= $array[0]['id_droits'];
      header("location: profil.php");
   }

   if($mdpconnect!=$array[0]['password']) {
      echo '<p>Mauvais mot de passe</p>';
   }
}


?>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../asset/css/connexion.css">
      <link rel="stylesheet" href="../asset/css/header.css">
      <link rel="stylesheet" href="../asset/css/footer.css">
   </head>
   <body>
   <header>
   <?php require 'header.php' ?>
    </header>
<main>
   <div id="formulaire">
      <div class="ima">
         <img src="../asset/images/connexion.png"/>
      </div>
         <form method="POST" action="">
            <div class="inp">
            <input  type="text" name="loginconnect" placeholder="Entrez votre login" />
            <input  type="password" name="mdpconnect" placeholder="Mot de passe" />
            </div>
            <br /><br />
            <div class="inp2">
               <input type="submit" name="formconnexion" value = "Se connecter !" />
            </div>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
</main>

<footer>
        <?php require 'footer.php' ?>
    </footer>
</div>
      </div>
   </body>
</html>