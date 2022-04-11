<?php
session_start();
$_SESSION['numprop']="undefined";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleProfil.css">

    <title>Document</title>
</head>
<body>
    
    
<?php

    include 'connexion.inc.php';

    if(isset($_GET["nom"])){
        $_SESSION["nom"]=$_GET["nom"];
    }


    if($_SESSION["nom"]!=null){

        
        $prop=$_SESSION["nom"];
        $result=$cnx->query("SELECT numprop FROM projet.proprietaire WHERE nom='$prop';");
        $rowcount=0;
        while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
        {
            $rowcount+=1; 
        }
       
        if($rowcount!=0){
            
            echo "<div class='root'>";

            echo "<a href='index.php' class='btn'><img src='photo/accueil 1.png' alt='bouton retour' class='btn'></a>";

            $result = $cnx->query("SELECT numprop,prenom FROM projet.proprietaire WHERE nom='$prop';");
            while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
            {
                $_SESSION["numprop"]=$ligne->numprop;
                $prenom=$ligne->prenom; 
            }
            
            echo "<h1> Bienvenue $prop $prenom </h1>";
?>

        <div class="hBox">
            <div class="vBox">
                <h2>Vos Animaux</h2>
                <ul>
<?php
            $numprop=$_SESSION["numprop"];
            $result = $cnx->query("SELECT nom,espece FROM projet.animaux WHERE numprop='$numprop';");
            while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
            {
                echo "<li>$ligne->nom ($ligne->espece)</li>"; 
            }
        
?>
                </ul>
            </div>
            
            <div class="vBox">
                <h2>Vos rendez-vous</h2>
                <ul>
<?php
            $result = $cnx->query("SELECT lieu, dateheure, a.nom FROM projet.consultation AS c ,projet.consulter AS co , projet.animaux  AS a ,projet.proprietaire AS pro WHERE c.numCons=co.numCons AND co.numanimal=a.numanimal AND a.numprop=pro.numprop AND pro.nom='$prop';");
            while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
            {
                echo "<li> DATE : $ligne->dateheure | LIEU : $ligne->lieu | AVEC : $ligne->nom</li>"; 
            }
    
        }
        else
        {
            echo "<div class='root'>";
            echo "<a href='index.php' class='btn'><img src='photo/accueil 1.png' alt='bouton retour' class='btn'></a>";
            echo "votre compte n'existe pas";
        } 
    }
    else
    {
        echo "<div class='root'>";
        echo "<a href='index.php' class='btn'><img src='photo/accueil 1.png' alt='bouton retour' class='btn'></a>";
        echo "passez par la page d'acceuil pour vous connecter!";
    } 
?>
                </ul>
            </div>
        </div>

    </div>

</body>
</html>

