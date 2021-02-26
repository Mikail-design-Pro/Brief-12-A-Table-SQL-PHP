<?php
try{
    $dataBaseConection = new PDO("mysql:host=$serverhost;dbname=$dbname", $user, $pass);
    $dataBaseConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$sth appartient à la classe PDOStatement
    $sth = $dataBaseConection->prepare(
        "SELECT `restaurantTable`.`numeroTable`,`restaurantTable`.`situationExterieur`, COUNT(*) AS nbrFlasher
        FROM `qrCode`
        JOIN `restaurantTable`
        ON `qrCode`.`qrIdTable` = `restaurantTable`.`idTable`
        WHERE `qrCode`.`dateFlash` LIKE (\"%févr%\")
        GROUP BY `restaurantTable`.`numeroTable`,`restaurantTable`.`situationExterieur`  
        ORDER BY `nbrFlasher`  DESC"
    );
    $sth->execute();

    $resultatFevrier = $sth->fetchAll(PDO::FETCH_ASSOC);

    //$sth appartient à la classe PDOStatement
    $sth = $dataBaseConection->prepare(
        "SELECT `restaurantTable`.`numeroTable`,`restaurantTable`.`situationExterieur`, COUNT(*) AS nbrFlasher
        FROM `qrCode`
        JOIN `restaurantTable`
        ON `qrCode`.`qrIdTable` = `restaurantTable`.`idTable`
        WHERE `qrCode`.`dateFlash` LIKE (\"%dece%\") 
        OR `qrCode`.`dateFlash` LIKE (\"%janv%\")
        OR `qrCode`.`dateFlash` LIKE (\"%févr%\")
        GROUP BY `restaurantTable`.`numeroTable`,`restaurantTable`.`situationExterieur`  
        ORDER BY `nbrFlasher`  DESC"
    );
    $sth->execute();

    $resultatTrimestre = $sth->fetchAll(PDO::FETCH_ASSOC);


}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?>
