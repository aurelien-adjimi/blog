<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/index.css">
    <link rel="stylesheet" href="asset/css/header.css">
    <link rel="stylesheet" href="asset/css/footer.css">
    <title>Accueil</title>
</head>
<body>
    <header>
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
            echo "<li><a href='php/inscription.php'>Inscription</a></li>";
            echo "<li><a href='php/connexion.php'>Connexion</a></li>";
            echo "<li class='menu1'><a href='#'>Catégories</a>";
            echo "<ul class='menuhide'>";
            echo    "<li><a href='php/articles.php?start=0&categorie=5'>Apéritifs</a></li>";
            echo    "<li><a href='php/articles.php?start=0&categorie=6'>Entrées</a></li>";
            echo    "<li><a href='php/articles.php?start=0&categorie=7'>Plats</a></li>";
            echo    "<li><a href='php/articles.php?start=0&categorie=8'>Desserts</a></li>";
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
        echo    "<li><a href='php/articles.php?start=0&categorie=5'>Apéritifs</a></li>";
        echo    "<li><a href='php/articles.php?start=0&categorie=6'>Entrées</a></li>";
        echo    "<li><a href='php/articles.php?start=0&categorie=7'>Plats</a></li>";
        echo    "<li><a href='php/articles.php?start=0&categorie=8'>Desserts</a></li>";
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
    </header>
    <main>
<?php 
session_start();
$bdd = mysqli_connect("localhost", "root", "", "blog");
$req = mysqli_query($bdd, "SELECT articles.*, utilisateurs.login 
                        FROM articles INNER JOIN utilisateurs 
                        on articles.id_utilisateur=utilisateurs.id 
                        ORDER BY date DESC LIMIT 3");
$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
echo"<div id='boxarticle'>";
for ($i = 0; isset($res[$i]); $i++) {
    echo '<div class= "article"><a href=php/article.php?start='.$res[$i]['id'].'>'.$res[$i]['article'].'</a>';
    echo 'Ecrit par : ' . $res[$i]["login"];
    echo 'Le : ' . $res[$i]['date'];
    echo"</div>";
}
echo"</div>";
?>

<form action="" method="POST">
    <input type="submit" name="art" id="art" value="Tous les articles">
</form>

<?php 
if(isset($_POST['art'])) {
    header('Location: ./php/articles.php');
}
?>
    </main>

    <footer>

<nav class="footer">
    <ul>
        <li><a href = "../index.php">Accueil</a></li>
        <li><a href = "php/profil.php">Profil</a></li>
        <li><a href = "php/articles.php">Articles</a></li>
        <?php 
if(!isset($_SESSION['login'])) {
    echo "<li><a href='php/inscription.php'>Inscription</a></li>";
    echo "<li><a href='php/connexion.php'>Connexion</a></li>";
}
?>
    </ul>

</nav>
    </footer>
</body>
</html>