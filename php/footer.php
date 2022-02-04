<?php 
$bdd = mysqli_connect("localhost", "root", "", "blog");
?>

<nav class="footer">
    <ul>
        <li><a href = "../index.php">Accueil</a></li>
        <li><a href = "php/profil.php">Profil</a></li>
        <li><a href = "php/articles.php">Articles</a></li>
        <?php 
if(!isset($_SESSION['login'])) {
    echo "<li><a href='inscription.php'>Inscription</a></li>";
    echo "<li><a href='connexion.php'>Connexion</a></li>";
}
?>
    </ul>

</nav>