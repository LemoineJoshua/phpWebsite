<?php 
    session_start();
    $numprop = $_SESSION['numprop']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="animal.css">
    <link rel="stylesheet" href="styleProfil.css">
    <title>Un nouvel ami ...</title>
</head>
<body>
    <?php
        include 'connexion.inc.php';      
    ?>
    <div class="border">
        <a href='index.php' class='btn'><img src='photo/accueil 1.png' alt='bouton retour' class='btn'></a>
        <div class="cont">
            <form action="" method="post">
                <h2>Qui est notre nouvel ami ?</h2>

                <div class="hbox">
                    <div class="vbox">
                        <div>
                            <label for="nom">Son nom : </label>
                            <input type="text" name="nom" required='required'>
                        </div>

                        <div>
                            <label for="espece">Son espece :</label>
                            <input type="text" name="espece" required='required'>
                        </div>

                        <div>
                            <label for="genre">Son genre : </label>
                            <select name="genre" required='required'>
                                <option value="0">male</option>
                                <option value="1">femele</option>
                            </select>
                        </div>
                    </div>
                    <div class="vbox">
                        <div>
                            <label for="race">Sa race :</label>
                            <input type="text" name="race" required='required'>
                        </div>
        
                        <div>
                            <label for="taille">Sa taille : </label>
                            <input type="number" name="taille" required='required' >
                        </div>

                        <div>
                            <label for="poids">Son poids : </label>
                            <input type="number" name="poids" required='required'>
                        </div>
                    </div>
                </div>
                <div class="vbox">
                    <div>
                        <label for="cast">Castration : </label>
                        <select name="cast" required='required'>
                            <option value="0">pas castré</option>
                            <option value="1">castré</option>
                        </select>
                    </div>

                    <div>
                        <label for="vac">Vaccins : </label>
                        <input type="text" name="vac">
                    </div>

                    <input type="submit" value="Valider">
                </div>

                <?php 
                    if (isset($_POST['nom']) && isset($_POST['espece']) && isset($_POST['race']) && isset($_POST['taille']) && isset($_POST['poids']) && isset($_POST['genre']) && isset($_POST['cast']) && isset($_POST['vac'])) {
                    
                        $nom = $_POST['nom'];
                        $espece = $_POST['espece'];
                        $race = $_POST['race'];
                        $taille = $_POST['taille'];
                        $poids = $_POST['poids'];
                        $genre = $_POST['genre'];
                        $cast = $_POST['cast'];
                        $vac = $_POST['vac'];

                        $req = "INSERT INTO projet.animaux 
                                (nom, race, taille, genre, vaccinations, poids, numprop, espece, castration) 
                                VALUES
                                ('$nom', '$race', $taille, $genre, '$vac', $poids, $numprop, '$espece', $cast)";

                        if (!($cnx->query($req))) {
                            echo $req;
                        } else {
                            header("location : profil.php");
                        }
                    }         
                ?>
            </form>
        </div>
    </div>
</body>
</html>