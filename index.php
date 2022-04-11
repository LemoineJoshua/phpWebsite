<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyle.css">
    <title>DAKTARI</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@600&family=Roboto:wght@100;700&display=swap');
</style>

<?php
    include 'connexion.inc.php';
    $numprop="undefined";
    
    if(isset($_GET["nom"]))
    {

        $prop=$_GET['nom'];
        $result=$cnx->query("SELECT numprop FROM projet.proprietaire WHERE nom='$prop';");
        while( $ligne = $result->fetch(PDO::FETCH_OBJ) )
        {
            $numprop = $ligne->numprop; 
        }
    }
?>

<body>
    <div class="background">
        </div>
        <h1>DAKTARI</h1>
        <div class="titleAndButton"> 

            <div Class="containerButtonAndUnder">

                <input type="radio" id="RDV" class="Bouton Jaune" name="menu">
                <label for="RDV">Prendre rendez-vous</label>
                <div class="RDV" id="RDVmenu">
                    <div class="form">
                    <h2>Prendre rendez-vous</h2>
<?php
        if ($numprop!="undefined")
        {
            echo        "<form method='get' action=''>
                        
                            <div>
                                <label for='date'>Quand ?</label>
                                <input type='date' name='date'>
                            </div>
                            <div>
                                <label for='Ou'>Où ?</label></b>
                                <input type='radio' name='Ou'>
                                <label for='Ou'>Chez Daktari</label>
                                <input type='radio' name='Ou'>
                                <label for='Ou'>Autre part</label>
                                <input type='text'>
                            </div>
                            <div>
                                <label for='Precision'>Precisez le problème :</label>
                                <textarea name='Precision' id='' cols='30' rows='10'></textarea>
                            </div>
                            <input type='submit' value='Prendre rdv'>
                        </form>";
        } else

        {
            echo"<h3>Connectez-vous pour avoir accès à cette fonctionnalité</h3>";
        }

?>
                        <input type='radio' id='RDVCLOSE' class='Bouton Fermer' name='menu'>
                        <label for='RDVCLOSE'><img src='photo/close.png' alt=''></label>
                    </div>
                </div> 
                
                <?php 
                    if (isset($_GET['date']) && isset($_GET['Ou']) && isset($_GET['Precision'])) {
                        if (empty($_GET['date']) || empty($_GET['Ou']) || empty($_GET['Precision'])) {
                            echo "Veuillez remplir les champs";

                        } else {
                            $numRDV;

                            $result = $cnx->query("SELECT max(numcons) FROM projet.proprietaire");
                            while($ligne = $result->fetch(PDO::FETCH_OBJ))
                            {
                                $numRDV = $ligne->numcons; 
                            }
                            $numRDV++;

                            $date = $_GET['date'];
                            $Ou = $_GET['Ou'];
                            $Precision = $_GET['Precision'];
                            $cnx->exec("INSERT INTO projet.consultation VALUES('$numRDV', '$date', NULL, $Ou, $Precision, NULL, NULL, NULL, NULL)");
                            $cnx->exec("INSERT INTO projet.consulter VALUES('$numRDV', '$date', NULL, $Ou, $Precision, NULL, NULL, NULL, NULL)");
                        }
                    }
                ?>
<?php
    if($numprop!="undefined")
    {
        echo"
                <div class='divJaune'><a href='profil.php?nom=$prop'>Mon compte</a></div>
            ";
    }else{
        echo "
                <input type='radio' id='CONNEC' class='Bouton Jaune' name='menu'>
                <label for='CONNEC'>Connexions</label>
                <div class='CONNEC' id='CONNECmenu'>
                    <div class='form'>
                        <form action='profil.php' method='get'>
                            <div>
                                <h2>Se connecter</h2>
                                <label for='nom'>Votre nom : </label>
                                <input type='text' id='nom' name='nom'>
                                <label for='mdp'>Mot de passe</label>
                                <input type='text'>
                            </div>
                                <input type='submit' value='Connexion'>
                        </form>
                            <input type='radio' id='CONNECCLOSE' class='Bouton Fermer' name='menu'>
                            <label for='CONNECCLOSE'><img src='photo/close.png' alt=''></label>
                    </div>
                </div>";
    }


?>         
        </div>

            <div class="containerButtonAndUnder">

                <input type="radio" id="TARIF" class="Bouton lien" name="menu">
                <label for="TARIF">Tarif</label>
                <div class="TARIF" id="TARIFmenu">
                    <input type="radio" id="TARIFCLOSE" class="Bouton Fermer" name="menu">
                    <label for="TARIFCLOSE"><img src="photo/close.png" alt=""></label>
                    <h2>Tarifs</h2>
<?php
        $result = $cnx->query("SELECT typeconsultation,prixactuel FROM projet.tarifconsultation;");
        while( $ligne = $result->fetch(PDO::FETCH_OBJ))
        {
            echo "<h3> $ligne->typeconsultation - prix : $ligne->prixactuel </h3> <div class='trait'> </div> ";
        }
?>

                </div>

                <input type="radio" id="INSC" class="Bouton lien" name="menu">
                <label for="INSC">Inscription</label>
                <div class="INSC" id="INSCmenu">
                    <div class="form">
                        <h2>INSCRIPTION</h2>
                            <form action="" method='get'>
                                <div>
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" name="prenom">
                                    <label for="num">Numero de telephone</label>
                                    <input type="text" name="num">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse">
                                    <h3>Pour les entreprise</h3>
                                    <label for="IBAN">IBAN</label>
                                    <input type="text" name="IBAN">
                                    <label for="SiteWeb">Site web</label>
                                    <input type="text" name="SiteWeb">
                                </div>
                                <input type="submit" value="Inscription">
                            </form>

                            <?php

                                if (isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['num']) && isset($_GET['adresse'])) {

                                    if (empty($_GET['nom']) || empty($_GET['prenom']) || empty($_GET['num']) || empty($_GET['adresse'])) {
                                        echo "Veuillez remplir les champs";

                                    } else {

                                        if (isset($_GET['IBAN'])) {
                                            $IBAN = $_GET['IBAN'];
                                        } else {
                                            $IBAN = "NULL";
                                        }

                                        if (isset($_GET['SiteWeb'])) {
                                            $SiteWeb = $_GET['SiteWeb'];
                                        } else {
                                            $SiteWeb = "NULL";
                                        }
                                
                                        $numInsert;

                                        $result = $cnx->query("SELECT max(numprop) FROM projet.proprietaire");
                                        while($ligne = $result->fetch(PDO::FETCH_OBJ) )
                                        {
                                            $numInsert = $ligne->numprop; 
                                        }
                                        $numInsert++;

                                        $nom = $_GET['nom'];
                                        $prenom = $_GET['prenom'];
                                        $adresse = $_GET['adresse'];
                                        $num = $_GET['num'];

                                        $cnx->exec("INSERT INTO projet.proprietaire VALUES('$myRandomString', '$nom', '$prenom', '$adresse', '$num', '$IBAN', '$SiteWeb')");

                                    }
                                }

                            ?>
                        <input type="radio" id="INSCCLOSE" class="Bouton Fermer" name="menu">
                        <label for="INSCCLOSE"><img src="photo/close.png" alt=""></label>
                    </div>
                </div>
            </div>   
        </div>
        <p><b>
            Daktari est un vétérinaire reconnu par ses pairs. Il à soigné les animaux les plus impréssionant comme ce lion que vous pouvez voir en arrière plan. C'est le propriétaire, un prince du Kenya, qui lui à offert la photo quand il à vu à quel point son lion Dimitri était en bonne santé après le passage de Daktari.
            </b>
        </p>
</body>
</html>