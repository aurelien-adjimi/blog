<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>

<body>
    <header>
        <?php require 'header.php' ?>
    </header>

    <main>
        <form method="POST" action="">
            <label for="modif">Modifications</label>
            <select name="modif" id="modif">
                <option value="">--Choisir quoi modifier--</option>
                <option value="user">Utilisateurs & Droits</option>
                <option value="articles">Articles</option>
                <option value="commentaires">Commentaires</option>
                <option value="catégories">Catégories</option>
            </select>
            <input type="submit" name="submit" id="btnsubmit" value="Sélectionner">
        </form>

<?php
session_start();

$bdd = mysqli_connect("localhost", "root", "", "blog"); //Connexion BDD
$req = mysqli_query($bdd, "SELECT * FROM utilisateurs"); // Requête sélection des utilisateurs
$res = mysqli_fetch_all($req, MYSQLI_ASSOC); // Résultat requête
$req2 = mysqli_query($bdd, "SELECT * FROM articles"); // Requête sélection des articles
$res2 = mysqli_fetch_all($req2, MYSQLI_ASSOC); // Résultat requête
$req3 = mysqli_query($bdd, "SELECT * FROM categories"); // Requête sélection des catégories
$res3 = mysqli_fetch_all($req3, MYSQLI_ASSOC); // Résultat requête
$req4 = mysqli_query($bdd, "SELECT * FROM commentaires"); // Requête sélection des catégories
$res4 = mysqli_fetch_all($req4, MYSQLI_ASSOC); // Résultat requête


// Actions sur user//

if(isset($_POST['sub'])) {
    $login = $_SESSION['login'];
    $log = $_POST['login'];
    $mdp = $_POST['password'];
    $mail = $_POST['email'];
    $droits = $_POST['id_droits'];
    $req6 = mysqli_query($bdd, "UPDATE utilisateurs SET login ='$log', password= '$mdp', email='$mail', id_droits='$droits' WHERE login= '$login'");
    $_SESSION['login'] = $_POST['login'];
    header('refresh: 0,');
}

if(isset($_POST['submit'])) {


    if($_POST['modif'] == 'user') {
        foreach($res as $value) {
            ?>
            <table>
                <ul>
                    <li>ID:<?= $value['id'] ?></li>
                    <li>Login:<?= $value['login'] ?></li>
                    <li>Password:<?= $value['password'] ?></li>
                    <li>Mail:<?= $value['email'] ?></li>
                    <li>Droits:<?= $value['id_droits'] ?></li>
                </ul>
            </table>
            <?php
        }
            echo '<form method="post"><select name="GetIdUser">';
            foreach($res as $value) {
            echo '<option value="'.$value['id'].'">'.$value['id'].'</option>';
            }
            echo '</select>';
            echo '<input type="submit" name="subUser" value="Choisir"></form>';
    }
} 
if(isset($_POST['subUser'])) {

     $req5 = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id = $_POST[GetIdUser]"); // Requête sélection des utilisateurs
     $res5 = mysqli_fetch_all($req5, MYSQLI_ASSOC); // Résultat requête
    
     foreach($res5 as $value5) {
         echo '<h2>Login</h2>';
         echo '<input type="text" name="login" value="'.$value5['login'].'">';
         echo '<br><br>';
         echo '<h2>Mail</h2>';
         echo '<input type="text" name="mail" value="'.$value5['email'].'">';
         echo '<br><br>';
         echo '<h2>Mot de passe</h2>';
         echo '<input type="password" name="mdp" value="'.$value5['password'].'">';
         echo '<br><br>';
         echo '<h2>Droits</h2>';
         echo '<input type="text" name="droits" value="'.$value5['id_droits'].'">';
         echo '<br><br>';
         echo '<input type="submit" name"sub" value="Modifier">';
        }    
}
?>

<?php 

// Actions sur articles//


if(isset($_POST['sub'])) {
    $login = $_SESSION['login'];
    $art = $_POST['article'];
    $iduser = $_POST['id_utilisateur'];
    $idcat = $_POST['id_categorie'];
    $req6 = mysqli_query($bdd, "UPDATE articles SET article ='$art', id_categorie= '$idcat', id_utilisateur='$iduser', WHERE login= '$login'");
    $_SESSION['login'] = $_POST['login'];
    header('refresh: 0,');
}

if(isset($_POST['submit'])) {


    if($_POST['modif'] == 'articles') {
        foreach($res2 as $value2) {
            ?>
            <table>
                <ul>
                    <li>ID:<?= $value2['id'] ?></li>
                    <li>Article:<?= $value2['article'] ?></li>
                    <li>Id_user:<?= $value2['id_utilisateur'] ?></li>
                    <li>Id_cat:<?= $value2['id_categorie'] ?></li>
                </ul>
            </table>
            <?php
        }
            echo '<form method="post"><select name="GetIdArt">';
            foreach($res2 as $value2) {
            echo '<option value="'.$value2['id'].'">'.$value2['id'].'</option>';
            }
            echo '</select>';
            echo '<input type="submit" name="subArt" value="Choisir"></form>';
    }
} 
if(isset($_POST['subArt'])) {

     $req6 = mysqli_query($bdd, "SELECT * FROM articles WHERE id = $_POST[GetIdArt]"); // Requête sélection des articles
     $res6 = mysqli_fetch_all($req6, MYSQLI_ASSOC); // Résultat requête
    
     foreach($res6 as $value6) {
         echo '<h2>Articles</h2>';
         echo '<input type="text" name="article" value="'.$value6['article'].'">';
         echo '<br><br>';
         echo '<h2>ID User</h2>';
         echo '<input type="text" name="iduser" value="'.$value6['id_utilisateur'].'">';
         echo '<br><br>';
         echo '<h2>ID Catégories</h2>';
         echo '<input type="text" name="idcat" value="'.$value6['id_categorie'].'">';
         echo '<br><br>';
         echo '<input type="submit" name"sub" value="Modifier">';
        }    
}

    ?>

<?php 

// Actions sur commentaires//


if(isset($_POST['sub'])) {
    $login = $_SESSION['login'];
    $req8 = mysqli_query($bdd, "DELETE FROM commentaires WHERE $_POST[GetIdComm]");
    $_SESSION['login'] = $_POST['login'];
    header('refresh: 0,');
}

if(isset($_POST['submit'])) {


    if($_POST['modif'] == 'commentaires') {
        foreach($res4 as $value4) {
            ?>
            <table>
                <ul>
                    <li>Commentaires:<?= $value4['commentaire'] ?></li>
                    <li>ID Article:<?= $value4['id_article'] ?></li>
                    <li>ID Utilisateurs:<?= $value4['id_utilisateur'] ?></li>
                </ul>
            </table>
            <?php
        }
            echo '<form method="post"><select name="GetIdComm">';
            foreach($res4 as $value4) {
            echo '<option value="'.$value4['id'].'">'.$value4['id'].'</option>';
            }
            echo '</select>';
            echo '<input type="submit" name="subComm" value="Choisir"></form>';
    }
} 
if(isset($_POST['subComm'])) {

     $req7 = mysqli_query($bdd, "SELECT * FROM commentaires WHERE id = $_POST[GetIdComm]"); // Requête sélection des articles
     $res7 = mysqli_fetch_all($req7, MYSQLI_ASSOC); // Résultat requête
    
     foreach($res7 as $value7) {
        echo '<h2>Commentaire</h2>';
        echo '<input type="text" name="comm" value="'.$value7['commentaire'].'">';
        echo '<br><br>';
        echo '<h2>ID Article</h2>';
        echo '<input type="text" name="arti" value="'.$value7['id_article'].'">';
        echo '<br><br>';
        echo '<h2>ID Utilisateur</h2>';
        echo '<input type="text" name="uti" value="'.$value7['id_utilisateur'].'">';
        echo '<br><br>';
        echo '<input type="submit" name"sub" value="Supprimer">';
        }    
}

    ?>

<?php 

// Actions sur catégories//


if(isset($_POST['sub'])) {
    $login = $_SESSION['login'];
    $nom = $_POST['nom'];
    $req8 = mysqli_query($bdd, "UPDATE categories SET nom ='$nom', WHERE login= '$login'");
    $_SESSION['login'] = $_POST['login'];
    header('refresh: 0,');
}


if(isset($_POST['submit'])) {


    if($_POST['modif'] == 'catégories') {
        foreach($res3 as $value3) {
            ?>
            <table>
                <ul>
                    <li>ID:<?= $value3['id'] ?></li>
                    <li>Nom Catégorie:<?= $value3['nom'] ?></li>
                </ul>
            </table>
            <?php
        }
            echo '<form method="post"><select name="GetIdCat">';
            foreach($res3 as $value3) {
            echo '<option value="'.$value3['id'].'">'.$value3['id'].'</option>';
            }
            echo '</select>';
            echo '<input type="submit" name="subCat" value="Choisir"></form>';
    }
} 
if(isset($_POST['subCat'])) {

     $req9 = mysqli_query($bdd, "SELECT * FROM categories WHERE id = $_POST[GetIdCat]"); // Requête sélection des articles
     $res9 = mysqli_fetch_all($req9, MYSQLI_ASSOC); // Résultat requête
    
     foreach($res9 as $value9) {
        echo '<h2>ID</h2>';
        echo '<input type="text" name="comm" value="'.$value9['id'].'">';
        echo '<br><br>';
        echo '<h2>Nom</h2>';
        echo '<input type="text" name="arti" value="'.$value9['nom'].'">';
        echo '<br><br>';
        echo '<input type="submit" name"sub" value="Modifier">';
        }    
}

    ?>
    </main>
    <footer>
   <?php require 'footer.php' ?>
   </footer>
</body>
</html>