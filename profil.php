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


    if($_SESSION["nom"]!=null) {

        
        $prop=$_SESSION["nom"];
        $result=$cnx->query("SELECT numprop FROM projet.proprietair WHERE nom='$prop';");
        $rowcount=0;
        while($ligne = $result->fetch(PDO::FETCH_OBJ))
        {
            $rowcount+=1; 
        }
       
        if($rowcount != 0 || $prop =='Daktari') {
            
            echo "<div class='root'>";
            echo "<a href='index.php' class='btn'><img src='photo/accueil 1.png' alt='bouton retour' class='btn'></a>";

            if($prop!='Daktari')
            {
                $result = $cnx->query("SELECT numprop,prenom FROM projet.proprietair WHERE nom='$prop';");
                while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
                {
                    $_SESSION["numprop"]=$ligne->numprop;
                    $prenom=$ligne->prenom; 
                }
            }else
            {
                $prenom='';
                $numprop=0;
            }
            echo "<h1> Bienvenue $prop $prenom </h1>";
?>

        <div class="hBox">
            <div class="vBox">
                <h2>Vos Animaux</h2>
                <ul>
<?php
            $numprop=$_SESSION["numprop"];
            $request="SELECT nom,espece FROM projet.animaux WHERE numprop='$numprop';";
            if($prop=='Daktari')
            {
                $request="SELECT animaux.nom as animal,espece,proprietair.nom as prop FROM projet.animaux,projet.proprietair WHERE animaux.numprop=proprietair.numprop;";
                $_SESSION["numprop"]=1;
            }
            
            $result = $cnx->query($request);
            while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
            {
                if($prop=='Daktari'){
                    echo"<li>$ligne->animal ($ligne->espece) | proprietair : $ligne->prop</li>";
                }else{
                    echo"<li>$ligne->nom ($ligne->espece)</li>";
                }
            }
        
?>
                </ul>
<?php 
                echo "<a href='ajoutAnimal.php?numprop='$numprop>Ajouter un animal</a>";
?>
                
            </div>
            
            <div class="vBox">
                <h2>Vos rendez-vous</h2>
                <ul>
<?php
            $request="SELECT lieu, dateheure, a.nom FROM projet.consultation AS c , projet.consulter AS co , projet.animaux  AS a , projet.proprietair AS pro WHERE c.numCons=co.numCons AND co.numanimal = a.numanimal AND a.numprop=pro.numprop AND pro.nom='$prop';";
            if($prop=='Daktari')
            {
                $request="SELECT lieu, dateheure, a.nom FROM projet.consultation AS c ,projet.consulter AS co , projet.animaux  AS a ,projet.proprietair AS pro WHERE c.numCons=co.numCons AND co.numanimal=a.numanimal AND a.numprop=pro.numprop;";
            }
            $result = $cnx->query($request);
            while( $ligne = $result->fetch(PDO::FETCH_OBJ))
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

