<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/index.css">
    <link rel="stylesheet" href="asset/css/header.css">
    <link rel="stylesheet" href="asset/css/footer.css">
    <title>Accueil</title>
</head>
<body>
    <header>
        <?php require './php/header.php' ?>
    </header>
    <main>
<?php 

$bdd = mysqli_connect("localhost", "root", "", "blog");
$req = mysqli_query($bdd, "SELECT * FROM articles ORDER BY article DESC LIMIT 3");
$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
for ($i = 0; isset($res[$i]); $i++) {
    echo "<option value=".$res[$i]['article'].">".$res[$i]['article']."</option>";
}

?>

<form action="" method="POST">
    <input type="submit" name="art" id="art" value="Tous les articles">
</form>

<?php 
if(isset($_POST['art'])) {
    header('Location: ./php/articles.php');
}
?>
    </main>

    <footer>
        <?php require './php/footer.php' ?>
    </footer>
</body>
</html>