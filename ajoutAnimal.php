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
    <link rel="stylesheet" href="styleAjout.css">
    <title>Ajouter un animal</title>
</head>
<body>
    
    <?php
        include 'connexion.inc.php';      
    ?>

    <div class="cont-form">
        <form action="" method="get">
            <h2>Qui est notre nouvel ami ?</h2>

            <div>
                <div>
                    <label for="nom">Son nom : </label>
                    <input type="text" name="nom">
                </div>

                <div>
                    <label for="espece">Son espece :</label>
                    <input type="text" name="espece">
                </div>

                <div>
                    <label for="race">Sa race :</label>
                    <input type="text" name="race">
                </div>

                <div>
                    <label for="taille">Sa taille : </label>
                    <input type="number" name="taille">
                </div>

                <div>
                    <label for="poids">Son poids : </label>
                    <input type="number" name="poids">
                </div>

                <div>
                    <label for="genre">Son genre : </label>
                    <select name="genre">
                        <option value="0">male</option>
                        <option value="1">femele</option>
                    </select>
                </div>

                <div>
                    <label for="cast">Castration : </label>
                    <select name="cast">
                        <option value="0">pas castrer</option>
                        <option value="1">castrer</option>
                    </select>
                </div>

                <div>
                    <label for="vac">Vaccins : </label>
                    <input type="text" name="vac">
                </div>
            </div>

            <input type="submit" value="Valider">

        </form>

            <?php 
                if (isset($_GET['nom']) && isset($_GET['espece']) && isset($_GET['race']) && isset($_GET['taille']) && isset($_GET['poids']) && isset($_GET['genre']) && isset($_GET['cast']) && isset($_GET['vac'])) {
                
                    $nom = $_GET['nom'];
                    $espece = $_GET['espece'];
                    $race = $_GET['race'];
                    $taille = $_GET['taille'];
                    $poids = $_GET['poids'];
                    $genre = $_GET['genre'];
                    $cast = $_GET['cast'];
                    $vac = $_GET['vac'];

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
    </div>
    
</body>
</html>