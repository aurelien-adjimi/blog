<?php
session_start();
 $login = $_SESSION['login'];
 $bdd = mysqli_connect("localhost", "root", "", "blog");
 $dn = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$login'");
 $array = mysqli_fetch_all($dn, MYSQLI_ASSOC);

foreach($array as $key=>$value);

   if(isset($_POST['submit'])) {

      $log = $_POST['login'];
      $mdp = $_POST['password1'];
      $pw = $_POST['password2'];
      $req=mysqli_query($bdd, "UPDATE utilisateurs SET login ='$log', password= '$mdp' WHERE login= '$login'");
      $_SESSION['login'] = $_POST['login'];
      $_SESSION['password1'] = $_POST['password1'];
      header('refresh: 0,');
      if($mdp != $pw) {
         echo 'Mot de passe différents';
      }
   }

   if (isset($_POST['deco'])) {
session_start();
session_destroy();
header('location: ../php/connexion.php');
exit;
   }
   

?>
<html>
   <head>
      <title>Profil</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../asset/css/profil.css">
      <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
   </head>
   <body>
   <header>
        <?php require 'header.php' ?>
    </header>
<main>
   <div id="form">
   <form action="" method="post" align="center">
   <p>Profil de <?php echo $login?></p>
         <br /><br />
      <h2>Nom d'utilisateur</h2>
         <input type="text" name="login" id="login" value='<?php echo $login ?>'>

       <h2>E-mail</h2>
         <input type="text" name="mail" id="mail" value='<?php echo $value['email'] ?>'>

      <h2>Mot de passe</h2>
         <input type="password" name="mdp" id="mdp" value='<?php echo $value['password'] ?>'>

      <h2>Modifier mot de passe</h2>
         <input placeholder="Mot de passe" type="password" name="password1" id="password1">
                <br><br><br>

         <input type="password" placeholder="Confirmation" name="password2" id="password2">
                <br><br><br>
         <input name="submit" id="btnsubmit" type="submit" value="Modifier votre profil">
      </form>
   </div>
</main>   

<footer>
   <?php require 'footer.php' ?>
   </footer>
   </body>
</html>