<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyle.css">
    <title>DAKTARI</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@600&family=Roboto:wght@100;700&display=swap');
</style>
</head>

<?php
    include 'connexion.inc.php';
    if(isset($_SESSION["numprop"])){
        $numprop=$_SESSION["numprop"];
    }else{
        $numprop="undefined";
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
            echo        "<form method='POST' action=''>
                        
                            <div>
                                <b><label for='date'>Quand ?</label></b>
                                <input type='date' name='date' required='required'>
                            </div>
                            <div>
                                <b><label for='Ou'>Où ?</label></b>
                                <div>
                                <input type='radio' name='Ou' value=' en cabinet' id='Daktari' required='required'>
                                <label for='Daktari'>Chez Daktari</label>
                                </div>
                                <div>
                                <input type='radio' name='Ou' value=' hors cabinet' id='horsCabinet' required='required'>
                                <label for='horsCabinet'>Autre part</label>
                                </div>
                                <br>
                                <b><label for='Type'>Type de RDV ?</label></b>
                                <div>
                                <input type='radio' name='Type' value='Basique' id='basique' required='required'>
                                <label for='basique'>Basique</label>
                                </div>
                                <div>
                                <input type='radio' name='Type' value='Ostéopathique' id='osteo' required='required'>
                                <label for='osteo'>Ostéopathique</label>
                                </div>
                                <br>
                                Animal<select name='animal'>
                                <option value='' selected='selected' required='required'>-- Votre Animal --</option>";
                                
                                $result = $cnx->query("SELECT nom, espece, numanimal FROM projet.animaux WHERE numprop=$numprop");
                                while($ligne = $result->fetch(PDO::FETCH_OBJ))
                                {
                                echo "<option value='.$ligne->numanimal.'>$ligne->nom ($ligne->espece) </option>";
                                }

                            echo "</select></div>
                            <br>
                            <div>
                                <label for='Precision'>Precisez le problème :</label>
                                <textarea name='Precision' id='' cols='30' rows='10'></textarea>
                            </div>
                            <input type='submit' value='Prendre rdv'>
                        </form>";
        } else

        {
            echo "<h3>Connectez-vous pour avoir accès à cette fonctionnalité</h3>";
        }

?>
                        <input type='radio' id='RDVCLOSE' class='Bouton Fermer' name='menu'>
                        <label for='RDVCLOSE'><img src='photo/close.png' alt=''></label>
                    </div>
                </div> 
                
                <?php 
                    if (isset($_POST['date']) && isset($_POST['Ou']) && isset($_POST['Precision']) && isset($_POST['Type'])) {
                        if (empty($_POST['date']) || empty($_POST['Ou']) || empty($_POST['Precision']) || empty($_POST['Type'])) {
                            echo "Veuillez remplir les champs";

                        } else {
                            $date = $_POST['date'];

                            $Ou = $_POST['Ou'];
                            
                            $Precision = $_POST['Precision'];
                            $Animal = $_POST['animal'];

                            $typecons = $_POST['Type'].$_POST['Ou'];
                            $numtarif = $cnx->query("SELECT numtarif FROM projet.tarifConsultation WHERE typeconsultation = '$typecons'")->fetch(PDO::FETCH_OBJ)->numtarif;

                            $result = $cnx->query("INSERT INTO projet.consultation VALUES(default, '$date', NULL, '$Ou', '$Precision', NULL, NULL, '$numtarif', NULL) RETURNING numcons");
                            $numcons = $result->fetch(PDO::FETCH_OBJ)->numcons;
                            $cnx->exec("INSERT INTO projet.consulter VALUES($Animal, $numcons)");
                        }
                    }
                ?>
<?php
    if($numprop!="undefined")
    {
        echo"
                <div class='divJaune'><a href='profil.php'>Mon compte</a></div>
            ";
    } else {

        echo "
                <input type='radio' id='CONNEC' class='Bouton Jaune' name='menu'>
                <label for='CONNEC'>Connexions</label>
                <div class='CONNEC' id='CONNECmenu'>
                    <div class='form'>
                        <form action='profil.php' method='POST'>
                            <div>
                                <h2>Se connecter</h2>
                                <label for='nom'>Votre nom : </label>
                                <input type='text' id='nom' name='nom' required='required'>
                                <label for='mdp'>Mot de passe</label>
                                <input type='password' name='mdp' required='required'>
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
        echo "</div>";


        if($numprop!='undefined')
        {
            echo"<div class='divBlanche'><a href='deconnexion.php'>Deconnexion</a></div>";
        }else
        {
        echo"
                
                <input type='radio' id='INSC' class='Bouton lien' name='menu'>
                <label for='INSC'>Inscription</label>
                <div class='INSC' id='INSCmenu'>
                    <div class='form'>
                        <h2>INSCRIPTION</h2>
                            <form action='' method='POST'>
                                <div>
                                    <label for='nom'>Nom</label>
                                    <input type='text' name='nom' required='required'>
                                    <label for='prenom'>Prenom</label>
                                    <input type='text' name='prenom' required='required'>
                                    <label for='num'>Numero de telephone</label>
                                    <input type='text' name='num' required='required'>
                                    <label for='adresse'>Adresse</label>
                                    <input type='text' name='adresse' required='required'>
                                    <h3>Pour les entreprise</h3>
                                    <label for='IBAN'>IBAN</label>
                                    <input type='text' name='IBAN'>
                                    <label for='SiteWeb'>Site web</label>
                                    <input type='text' name='SiteWeb'>
                                </div>
                                <input type='submit' value='Inscription'>
                            </form>";
        
                            

                                if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['num']) && isset($_POST['adresse'])) {

                                    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['num']) || empty($_POST['adresse'])) {
                                        echo "Veuillez remplir les champs";

                                    } else {

                                        if (isset($_POST['IBAN'])) {
                                            $IBAN = $_POST['IBAN'];
                                        } else {
                                            $IBAN = NULL;
                                        }

                                        if (isset($_POST['SiteWeb'])) {
                                            $SiteWeb = $_POST['SiteWeb'];
                                        } else {
                                            $SiteWeb = NULL;
                                        }

                                        $nom = $_POST['nom'];
                                        $prenom = $_POST['prenom'];
                                        $adresse = $_POST['adresse'];
                                        $num = $_POST['num'];

                                        $cnx->exec("INSERT INTO projet.proprietair VALUES(default, '$nom', '$prenom', '$adresse', '$num', '$IBAN', '$SiteWeb')");

                                    }
                                }
                            echo"
                                <input type='radio' id='INSCCLOSE' class='Bouton Fermer' name='menu'>
                                <label for='INSCCLOSE'><img src='photo/close.png' alt=''></label>";
        }
                            ?>
                        
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
