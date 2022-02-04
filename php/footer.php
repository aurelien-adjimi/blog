<?php 
$bdd = mysqli_connect("localhost", "root", "", "blog");
?>

<nav class="footer">
    <ul>
        <li><a href = "../index.php">Accueil</a></li>
        <li><a href = "profil.php">Profil</a></li>
        <li><a href = "articles.php">Articles</a></li>
        <li><a href = "https://github.com/aurelien-adjimi/blog">Github</a></li>
        <?php 
if(!isset($_SESSION['login'])) {
    echo "<li><a href='inscription.php'>Inscription</a></li>";
    echo "<li><a href='connexion.php'>Connexion</a></li>";
}
?>
    </ul>

</nav>