<?php 
$bdd = mysqli_connect("localhost", "root", "", "blog");
if(isset($_POST['deco'])) {
    session_destroy();
    header('Location: ../php/connexion.php');
}
// Connexion //

if(isset($_POST['formconnexion'])) {

$loginconnect = ($_POST['loginconnect']);
$mdpconnect = ($_POST['mdpconnect']);
$res = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE `login` = '$loginconnect'");
$array= mysqli_fetch_all($res,MYSQLI_ASSOC);


if ($mdpconnect == $array[0]['password'] && $loginconnect == $array[0]['login']) {
   $_SESSION['login'] = $loginconnect;
   $_SESSION['droits']= $array[0]['id_droits'];

   header ('Location: ./php/profil.php');
}

if($mdpconnect!=$array[0]['password']) {
   echo 'Mauvais mot de passe';
}
}

// Header //

?>
<nav class="header">

    <ul id="drop">
<!-- Si pas connecté -->
        <?php
        if (!isset($_SESSION['login'])) {
            echo "<li><a href='../index.php'>Accueil</a></li>";
            echo "<li><a href='inscription.php'>Inscription</a></li>";
            echo "<li><a href='connexion.php'>Connexion</a></li>";
            echo "<li class='menu1'><a href='#'>Catégories</a>";
            echo "<ul class='menuhide'>";
            echo    "<li><a href='articles.php?start=0&categorie=5'>Apéritifs</a></li>";
            echo    "<li><a href='articles.php?start=0&categorie=6'>Entrées</a></li>";
            echo    "<li><a href='articles.php?start=0&categorie=7'>Plats</a></li>";
            echo    "<li><a href='articles.php?start=0&categorie=8'>Desserts</a></li>";
            echo  "</ul></li>";
        }
        ?>
<!-- Si connecté -->        
        <?php

        if (isset($_SESSION['login'])) {
        echo "<li><a href='../index.php'>Accueil</a></li>";
        echo "<li><a href='php/profil.php'>Mon profil</a></li>";
        echo "<li class='menu1'><a href='#'>Catégories</a>";
        echo "<ul class='menuhide'>";
        echo    "<li><a href='articles.php?start=0&categorie=5'>Apéritifs</a></li>";
        echo    "<li><a href='articles.php?start=0&categorie=6'>Entrées</a></li>";
        echo    "<li><a href='articles.php?start=0&categorie=7'>Plats</a></li>";
        echo    "<li><a href='articles.php?start=0&categorie=8'>Desserts</a></li>";
    echo  "</ul></li>";
    echo '<form method="POST" action="">
    <input type="submit" name="deco" value="Deconnexion"/> 
</form>';
        } else {    
            echo "";
        }
        if(isset($_SESSION['droits'])){
// Si modérateur //

        if($_SESSION['droits'] == 42 || $_SESSION['droits']==1337) {
        echo "<li><a href='php/creer-article.php'>Créer article</a></li>";
        }
// Si admin //
        if($_SESSION['droits'] == 1337) {
            echo "<li><a href='php/admin.php'>Admin</a></li>";
            }
        }
        ?>
        </ul>
<!-- Connexion header -->        
        <?php
        if (!isset($_SESSION['login'])) {
        echo '<div id="form">
            <form method="POST" action="">
                <div class="inp">
                    <input  type="text" name="loginconnect" placeholder="Pseudo"/>
                    <input  type="password" name="mdpconnect" placeholder="Mot de passe"/>
                </div>
                <div class="inp2">
                    <input type="submit" name="formconnexion" value="Se connecter !"/>
                </div>
            </form>
    <p>Pas encore <a href="php/inscription.php">inscrit</a> ?</p>
                </div>';
            }
                ?>
</nav>