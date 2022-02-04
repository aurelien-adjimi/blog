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

foreach($res as $value) {
echo '<div id="cont">';
echo '<div class="art"><p class="art">' .$value['article']. '</p></div>';
foreach($res2 as $key) {
    echo '<div class="comm">' .$key['login'];
    echo '<div class="comm">' .$key['commentaire'];
    echo '<div class="comm">' .$key['date'];
}
echo '</div>';
}



$log = $_SESSION['id'];
$req3 = mysqli_query($bdd, "SELECT id FROM utilisateurs WHERE login='$log'");
$res3 = mysqli_fetch_all($req3, MYSQLI_ASSOC);

if (isset($_POST['envoyer'])) {
    $actuallogin = $_SESSION['login'];
    $start= $_GET['start'];
    $log = $_SESSION['id'];
    //$id= $res3[0]['id'];
    $text = addslashes($_POST['textarea']);
    $req4 = mysqli_query($bdd, "INSERT INTO commentaires(commentaire, id_article, id_utilisateur, date) 
                                VALUES ('$text','$start', $log,NOW())");
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