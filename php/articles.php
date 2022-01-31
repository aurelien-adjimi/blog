<?php
    //ouverture de la session
    //session_start();
    
    //connexion à la session
    $bdd = mysqli_connect("localhost", "root", "", "blog");

    if(isset($_GET['val'])){
        $categorie = $_GET['categorie2'];
        header("Location: articles.php?categorie=$categorie&start=1");
    }

    if(!isset($_GET['start']) && !isset($_GET['categorie'])){
        $start=$_GET['start'];
        $categorie=$_GET['categorie2'];
        header("Location: articles.php?categorie=$categorie&start=1");
    }

    if (!empty($_GET['start']) && !empty($_GET['categorie']) && !empty($pages)){
        $start = $_GET['start'];
        $categorie = $_GET['categorie'];
        $req = mysqli_query($bdd, "SELECT `articles.article`, `articles.date` FROM `articles` INNER JOIN `categories` ON categories.id=articles.id_categorie LIMIT 5 OFFSET $categorie, $start");
        var_dump($_GET);    
    }
        else{
            $start = $_GET['start'];
            $categorie = $_GET['categorie']; 
            $offset = 5 * ($start - 1);
            $req = mysqli_query($bdd, "SELECT `article`, `date`, id_categorie FROM `articles` INNER JOIN `categories` ON categories.id=articles.id_categorie WHERE id_categorie=$categorie ORDER BY date DESC LIMIT 5 OFFSET $offset");
            $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
            $countpages = mysqli_query($bdd, "SELECT count(*) FROM `articles`");
            $res2 = mysqli_fetch_all($countpages);
            
            //var_dump($res);
            //var_dump($_GET);
        
            //savoir combien de pages on doit afficher
            $pages = $res2[0][0] /5;
            //ceil permet d'arrondir au nombre supérieur
            $pages = ceil($pages);

            $cat = mysqli_query($bdd, "SELECT `nom`, `id` FROM `categories` ");
            $rescat = mysqli_fetch_all($cat, MYSQLI_ASSOC);
        }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/articles.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
<header>
        <?php
            require("header.php");
        ?>
    </header>
    <br>
    
    <div class="bouton">
        <a href="../php/creer-article.php"><button class="boutton">Nouvel article</button></a>
    </div>   

    <h1>LES ARTICLES</h1>

    <form class="form" action="#" method="get">
                    
                        <select name="categorie2">
                            <option>Filtrer les categories</option>
                            <?php
                                //affiche les categories pour le filtre
                                for($i=0; isset($rescat[$i]); $i++){
                                    echo"<option value=".$rescat[$i]['id'].">".$rescat[$i]['nom']."</option>";
                                }
                            ?>
                        </select>
                        
                        <br> </br>
                    <input class="valid" type="submit" value="Confirmer" name="val">
                </form>
                <br>
    
    <main>
        <div id="container">
            <div class="boite">
                <?php
                    //affiche les articles et les dates
                    for($i=0; isset($res[$i]); $i++){
                        echo"<option class='titre' value=".$res[$i]['article'].">Nom de l'article : ".$res[$i]['article']."</option>";
                        echo"<option class='date' value=".$res[$i]['date'].">Publié le : ".$res[$i]['date']."</option>";
                        echo "<br>";
                    }
                    /*foreach($res as $key => $value){
                        echo "<hr>";
                        foreach($value as $value2){
                            echo "article: ".$value2." creer le :";
                        }
                    }*/
                ?>
            </div>
        </div>
    </main>
    <br>

    <?php
        /*permet d'afficher le nombre de pages*/
        for($i=1; $i<=$pages; $i++){
            echo "<a class='pagination' href='articles.php?categorie=$categorie&start=$i'> $i </a>&nbsp";
        } ?>

<footer>
    <?php 
        require("footer.php");
    ?>
</footer> 
    
</body>
</html>