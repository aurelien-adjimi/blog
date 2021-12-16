<?php 
$bdd = mysqli_connect("localhost", "root", "", "blog");
session_start()
?>

<nav class="footer">
    <ul>
        <li><a href = "../index.php">Accueil</a></li>
        <li><a href = "./php/articles.php">Articles</a></li>
        <li><a href = "./php/inscription.php">Inscription</a></li>
    </ul>
    <ul>
        <li>
            <ul>
                <li><?php
                if (isset($_SESSION['login'])) {
                    echo "<ul>
               <li> Mes informations
                    <ul>
                       <li><a href='./php/profil.php'>Modifier mon profil</a></li>
                    </ul>
                </li>
              </ul>";
                    if ($_SESSION['login'] == 'admin') {
                        echo "<a href='./php/admin.php'>Administrateur</a>";
                    }
                    ?></li>
                    <?php 
                    if ($_SESSION['login'] == 'modérateur') {
                    echo '<li><a href="creer-article.php">Publier un article</a></li>'; }
                }
                ?>
            </ul>
        </li>
    </ul>
</nav>