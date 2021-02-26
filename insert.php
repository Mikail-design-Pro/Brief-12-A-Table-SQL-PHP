<?php
// Local Date
setlocale(LC_TIME, "fr_FR", "french", "fr_FR.UTF-8");
$dateFlash = strftime("%c");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if
        (
            !empty($_POST['table']) &&
            !empty($_POST['situationExterieur']) &&
            !empty($_POST['chaise']) &&
            !empty($_POST['qrName']) &&
            !empty($_POST['qrIdTable']) &&
            !empty($_POST['qrIdTelephone']) &&
            !empty($_POST['marqueTelephone']) &&
            !empty($_POST['langueUtilisateur'])
        ){
            // We Clean the content
            $regexChar ="/^[a-zA-Z\/()_?!:.,'\s-]+$/";
            $regexInt ="/^[\d]+$/";
            $regexVarchar ="/^[\w]+$/";

            if(preg_match($regexInt, ($_POST['table'])) && strlen(($_POST['table'])) < 20){
                $numeroTable = strip_tags($_POST['table']);
                echo '<p> Numero de la table:   ' .  $numeroTable . '</p>';
            }else{
                echo '<div class="alert-error"> <span>Erreur ! Numero de table invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexChar, ($_POST['situationExterieur'])) && strlen(($_POST['situationExterieur'])) < 20){
                $situationExterieur = strip_tags($_POST['situationExterieur']);
                echo '<p> Emplacement de la table:  ' . $situationExterieur . ' || Exterieur (Soleil) ou Interieur (Ombre) </p>';
            }else{
                echo '<div class="alert-error"><span>Erreur ! Emplacement invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexInt, ($_POST['chaise'])) && strlen(($_POST['chaise'])) < 20){
                $nombreChaise = strip_tags($_POST['chaise']);
                echo '<p> Nombre de chaise a la table:  ' .$nombreChaise . '</p>';
            }else{
                echo '<div class="alert-error"><span>Erreur ! Nombre de chaise invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexChar, ($_POST['qrName'])) && strlen(($_POST['qrName'])) < 20){
                $nomQrCode = strip_tags($_POST['qrName']);
                echo '<p> Nom du Qr Code:   ' . $nomQrCode . '</p>';
            }else{
                echo '<div class="alert-error"><span>Erreur ! Nom du QR Code  invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexInt, ($_POST['qrIdTelephone'])) && strlen(($_POST['qrIdTelephone'])) < 20){
                $qrIdTelephone = strip_tags($_POST['qrIdTelephone']);
                echo '<p> Categorie du telephone ayant flasher ce QR Code:  '. $qrIdTelephone . '</p>';
            }else{
                echo '<div class="alert-error"><span>Erreur ! Categorie du telephone invalide  invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexInt, ($_POST['qrIdTable'])) && strlen(($_POST['qrIdTable'])) < 20){
                $qrIdTable = strip_tags($_POST['qrIdTable']);
                echo '<p> Numero de la table portant ce QR Code:    ' . $qrIdTable . '</p>';
            }else{
                echo '<div class="alert-error"><span>Erreur ! Numero de Table  invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexChar, ($_POST['marqueTelephone'])) && strlen(($_POST['marqueTelephone'])) < 20){
                $marqueTelephone = strip_tags($_POST['marqueTelephone']);
                echo '<p> Marque de telephone:  ' . $marqueTelephone . '</p>';
            }else{
                echo'<div class="alert-error"><span>Erreur ! Marque du telephone invalide. Maximum 20 caractère</span></div>';
            };

            if(preg_match($regexChar, ($_POST['langueUtilisateur'])) && strlen(($_POST['langueUtilisateur'])) < 20){
                $langueUtilisateur = strip_tags($_POST['langueUtilisateur']);
                echo '<p> Langue du client: ' . $langueUtilisateur . '</p>';
            }else{
                echo '<div class="alert-error"><span>Erreur ! Langue invalide. Maximum 20 caractère</span></div>';
            };

            if
            (
                isset($_POST['submit']) &&
                !empty($numeroTable) &&
                !empty($situationExterieur) &&
                !empty($nombreChaise) &&
                !empty($nomQrCode) &&
                !empty($qrIdTable) &&
                !empty($qrIdTelephone) &&
                !empty($langueUtilisateur) && 
                !empty($marqueTelephone)
            ){
                $qrCodeLien = "https://www.restaurantTableCode/" . $nomQrCode ."/.fr";

                try{
                    $dataBaseConection = new PDO("mysql:host=$serverhost;dbname=$dbname", $user, $pass);
                    $dataBaseConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    
                    //$sth appartient à la classe PDOStatement
                    $sth = $dataBaseConection->prepare("
                    INSERT INTO `restaurantTable` (numeroTable, situationExterieur, nombreChaise)
                    VALUES (:numeroTable, :situationExterieur, :nombreChaise);

                    INSERT INTO `qrCode` (nomQrCode, qrCodeLien, qrIdTable, qrIdTelephone, dateFlash)
                    VALUES (:nomQrCode,:qrCodeLien, :qrIdTable, :qrIdTelephone, :dateFlash);


                    INSERT INTO `utilisateur` (marqueTelephone, langueUtilisateur)
                    VALUES (:marqueTelephone, :langueUtilisateur);
                    ");
                    $sth->execute(array(
                        
                        ':numeroTable' => $numeroTable,
                        ':situationExterieur' => $situationExterieur,
                        ':nombreChaise' => $nombreChaise,
                        ':nomQrCode' => $nomQrCode,
                        ':qrCodeLien' => $qrCodeLien,
                        ':qrIdTable' => $qrIdTable,
                        ':qrIdTelephone' => $qrIdTelephone,
                        ':dateFlash' => $dateFlash,
                        ':marqueTelephone' => $marqueTelephone,
                        ':langueUtilisateur' => $langueUtilisateur

                    ));
                    echo "<hr />";
                    echo "<p><b>Entrée ajoutée dans les table</b></p>";
                    
                }
                catch(PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                };
            }else{
                echo "Un champ est vide";
            };

        }else{
            echo "Not Set";

        };
    }else{
        echo "Formulaire non envoyer";
    };


?>
