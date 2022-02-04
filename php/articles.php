<?php
    //ouverture de la session
    session_start();
    if(!isset($_GET['start']) || !isset($_GET['categorie'])){
        header("location:articles.php?start=1&categorie=");
    }
    //connexion à la session
    $bdd = mysqli_connect("localhost", "root", "", "blog");

    //validation de la catégorie
    if(isset($_GET['val'])){
        $categorie = $_GET['filtrecategorie'];
        header("Location: articles.php?categorie=$categorie&start=1");
    }

           $start = $_GET['start'];
            $categorie = $_GET['categorie']; 
            $offset = 5 * ($start - 1);
            if(!empty($_GET['categorie'])){
                $req = mysqli_query($bdd, "SELECT articles.article, articles.date, articles.id FROM articles WHERE id_categorie=$categorie ORDER BY date DESC LIMIT $start,5");
                $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
                
               
            }else{
                $req = mysqli_query($bdd, "SELECT articles.article, articles.date, articles.id FROM articles ORDER BY date DESC LIMIT $start,5");
                $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
            }
            $countpages = mysqli_query($bdd, "SELECT count(*) FROM `articles`");
            $res2 = mysqli_fetch_all($countpages);
            
            //var_dump($res);
            //var_dump($_GET);
        
            //savoir combien de pages on doit afficher
            $pages = $res2[0][0] /5;
            //ceil permet d'arrondir au nombre supérieur
            $pages = ceil($pages);
            
        
        //requête catégorie
        $cat = mysqli_query($bdd, "SELECT `nom`, `id` FROM `categories` ");
        $rescat = mysqli_fetch_all($cat, MYSQLI_ASSOC);

        if(empty($_GET['categorie'])){
            
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
    <main>
        <div id="cnt">
    <div class="bouton">
        <a href="../php/creer-article.php"><button class="boutton">Nouvel article</button></a>
    </div>   
    <form class="form" action="#" method="get">
                    <div class='titrecategorie'><h3>Filtrer les catégories</h3></div>
                        <select name="filtrecategorie">
                            <option></option>
                            <?php
                                //affiche les catégories pour le filtre
                                for($i=0; isset($rescat[$i]); $i++){
                                    echo"<option value=".$rescat[$i]['id'].">".$rescat[$i]['nom']."</option>";
                                }
                            ?>
                        </select>
                        
                        <br> </br>
                    <input class="valid" type="submit" value="Confirmer" name="val">
                </form>
                </div>
    <h1>LES ARTICLES</h1>
                <br>

        <div id="container">
            <div class="boite">
                <?php
                if(empty($res)){
                    echo "<p>Il n'y a rien pour le moment !</p>";
                }
                //if(Isset($_GET['categorie'])){
                    //affiche les articles et les dates
                    for($i=0; isset($res[$i]); $i++){
                        echo"<div class='titre'><a href=./article.php?start=".$res[$i]['id'].">Nom de l'article : ".$res[$i]['article']."</a>";
                        echo"<option class='date' value=".$res[$i]['date'].">Publié le : ".$res[$i]['date']."</option>";
                        echo "<br>";
                        echo"</div>";
                    }
                //  }
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