<?php

$serverhost = "localhost";
$dbname = "restaurant"; 
$user = "root"; 
$pass = "Mike12klkn34";

try{
    $dataBaseConection = new PDO("mysql:host=$serverhost", $user, $pass);
    $dataBaseConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$sql
    $sql ="
    CREATE DATABASE IF NOT EXISTS $dbname;

    USE $dbname;

    CREATE TABLE IF NOT EXISTS `restaurantTable` 
        (
            `idTable` int(20) NOT NULL AUTO_INCREMENT,
            `numeroTable` int(20) NOT NULL DEFAULT '0',
            `situationExterieur` char(20) NOT NULL DEFAULT 'Interieur',
            `nombreChaise` int(20) NOT NULL DEFAULT '0',
            PRIMARY KEY (`idTable`)
        )
        ENGINE=InnoDB DEFAULT CHARSET=latin1;

	CREATE TABLE IF NOT EXISTS `utilisateur` 
        (
            `idTelephone` int(20) NOT NULL AUTO_INCREMENT,
            `marqueTelephone` char(20) NOT NULL DEFAULT '',
            `langueUtilisateur` char(20) NOT NULL DEFAULT '',
            PRIMARY KEY (`idTelephone`)
        )
        ENGINE=InnoDB DEFAULT CHARSET=latin1;

    CREATE TABLE IF NOT EXISTS `qrCode` 
        (
            `idQrCode` int(20) NOT NULL AUTO_INCREMENT,
            `nomQrCode` varchar(20) NOT NULL DEFAULT '',
            `qrCodeLien` varchar(100) NOT NULL DEFAULT 'https//bonrestaurant.com',
            `qrIdTable` int(20) NOT NULL REFERENCES `restaurantTable`(`idTable`),
            `qrIdTelephone` int(20) NOT NULL REFERENCES `telephone`(`idTelephone`),
            `dateFlash` VARCHAR(30) NOT NULL,
            PRIMARY KEY (`idQrCode`)
        )
        ENGINE=InnoDB DEFAULT CHARSET=latin1;

    ";
    $dataBaseConection->exec($sql);
    
    echo "Base de donné crée <br />";
    

}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?>
