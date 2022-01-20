<?php
session_start();
$bdd = mysqli_connect("localhost", "root", "", "blog");

if(isset($_POST['formconnexion'])) {

   $loginconnect = ($_POST['loginconnect']);
   $mdpconnect = ($_POST['mdpconnect']);
   $res = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$loginconnect'");
   $array= mysqli_fetch_all($res,MYSQLI_ASSOC);

   foreach($array as $key =>$value)

if ($mdpconnect == $value['password'] && $loginconnect == $value['login']) {
      $_SESSION['login'] = $loginconnect;
      $_SESSION['id'] = $value['id'];
      header ('Location: index.php');
   }

   if($mdpconnect!=$value['password']) {
      echo '<p>Mauvais mot de passe</p>';
   }
}

?>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../asset/css/header.css">
      <link rel="stylesheet" href="../asset/css/footer.css">
   </head>
   <body>
   <header>
   <?php require 'header.php' ?>
    </header>
<main>
   <div id="formulaire" align=center>
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