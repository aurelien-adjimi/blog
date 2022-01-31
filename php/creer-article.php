<?php
    //ouverture de la session
   //session_start();

   //connexion à la session
    $bdd = mysqli_connect("localhost", "root", "", "blog");

    if(isset($_POST['val'])){
        $actuallogin = $_SESSION['login'];
        $article = $_POST['article'];
        
        $IDcategorie = $_POST['id2'];
        $req = mysqli_query($bdd, "INSERT INTO `articles`(article, id_utilisateur, id_categorie, date) VALUES ('$article', 1, '$IDcategorie', NOW())");
        var_dump($_SESSION['login']);    
    }

    $req2 = mysqli_query($bdd, "SELECT * FROM `categories` ");
    $res = mysqli_fetch_all($req2, MYSQLI_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/creer-article.css">
</head>
<body>
    <header>
        <?php
            require("header.php");
        ?>
    </header>
    
    <main>
        <div id="container">
            <div class="gauche">
                <p>CREER DE NOUVEAUX ARTICLES</p>
            </div>

            <div class="droite">
                <form action="#" method="post">
                    <input class="input" type="text" placeholder="Entrer le nom de l'article" name="article">
                        <br> </br>
                        <textarea></textarea>
                        <br><br>
                        <select name="article2">
                            <option>Sélectionner une catégorie</option>
                            <?php
                                for($i=0; isset($res[$i]); $i++){
                                    echo"<option value=".$res[$i]['nom'].">".$res[$i]['nom']."</option>";
                                }
                            ?>
                        </select>
                        <br> </br>
                        <select name="id2">
                            <option>Sélectionner un id</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                        <br> </br>
                    <input class="valid" type="submit" value="Confirmer" name="val">
                </form>
                <?php
                    //message si le comentaire est envoyé
                    if(isset($req)) { ?>
                        <p> Article creer </p> 
                <?php } ?>
            </div>
            
        </div>
        <footer>
        <?php require 'footer.php' ?>
    </footer>
    </main>
    
</body>
</html>