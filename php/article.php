<?php
session_start();
$bdd = mysqli_connect("localhost", "root", "", "blog");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/article.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
    <title>Document</title>
</head>
<body>
<header>
   <?php require 'header.php' ?>
    </header>
<main>

<?php 
$_SESSION['id'] = 
//$id = $_SESSION['id'];
$start= $_GET['start'];
$req = mysqli_query($bdd, "SELECT articles.id, articles.article, articles.date, categories.nom 
                        AS categorie, utilisateurs.login  FROM articles 
                        INNER JOIN categories 
                        ON articles.id_categorie = categories.id 
                        INNER JOIN utilisateurs 
                        ON articles.id_utilisateur = utilisateurs.id 
                        WHERE articles.id = $start");
$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
$req2 = mysqli_query($bdd, "SELECT commentaires.commentaire, utilisateurs.login, commentaires.date 
                            FROM commentaires INNER JOIN utilisateurs 
                            ON commentaires.id_utilisateur = utilisateurs.id INNER JOIN articles 
                            ON commentaires.id_article = articles.id WHERE id_article = $start");
$res2= mysqli_fetch_all($req2, MYSQLI_ASSOC);

echo '<div class="art">' .$res[0]['article']. '</div>';
//echo '<div class="comm">' .$res2[0]['commentaire']. '</div>';

$log = $_SESSION['id'];
$req3 = mysqli_query($bdd, "SELECT id FROM utilisateurs WHERE login='$log'");
$res3 = mysqli_fetch_all($req3, MYSQLI_ASSOC);

if (isset($_SESSION['login']) && isset($_POST['envoyer'])) {
    $start= $_GET['start'];
    $id= $res3[0]['id'];
    $text = addslashes($_POST['textarea']);
    $req4 = mysqli_query($bdd, "INSERT INTO commentaires(commentaire, id_utilisateur, date) 
                                VALUES ('$text','$id',NOW()) WHERE articles.id = $start");
    header("Refresh:3");
}
?>

<div class="formu">
    <form action="#" method="post">
    <textarea name="textarea"
              rows="5" cols="30"
              maxlength="255" placeholder="Vous pouvez écrire ici"></textarea>
              <br><br>
        <input type="submit" name="envoyer" value="Ajouter un commentaire">
    </form>
</div>
</main>

<footer>
        <?php require 'footer.php' ?>
    </footer>
    
</body>
</html>