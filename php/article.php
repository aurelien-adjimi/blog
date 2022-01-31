<?php
$bdd = mysqli_connect("localhost", "root", "", "blog");
$_SESSION['id'] = 
$id = $_SESSION['id'];

if($_SESSION['id']) {
$req = mysqli_query($bdd, "SELECT articles.id, articles.article, articles.titre, articles.date, categories.nom AS categorie, utilisateurs.login  FROM articles INNER JOIN categories ON articles.id_categorie = categories.id INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id WHERE articles.id = $id");
$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
$req2 = mysqli_query($bd, "SELECT commentaire, id_article, login, commentaires.date FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id INNER JOIN articles ON commentaires.id_article = articles.id WHERE id_article=$id");
$res2= mysqli_fetch_all($req2, MYSQLI_ASSOC);
}
var_dump($res);
?>