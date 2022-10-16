<?php

if($_SERVER["REQUEST_METHOD"]  == "POST"){
    
    require_once("db.php");
    //http://192.168.0.14/camera/upload/imagen.jpg
    $imageData = $_POST["path"];
    $query = "SELECT id FROM photos ORDER BY id ASC";

    $result = $mysql->query($query);
    $defaultId = 0;

    while($row = $result->fetch_array()){
        $defaultId = intval($row["id"]) + 1;
    }

    $imagePath = "upload/" . $defaultId . ".jpg";

    $SERVER_URL = "http://192.168.0.14/camera/" . $imagePath;
    $queryInsert = "INSERT INTO photos (path) values ('$SERVER_URL')";

    $resultInsert = $mysql->query($queryInsert);

    if($resultInsert){
        file_put_contents($imagePath, base64_decode($imageData));
        echo "Guardado";
    }else{
        echo "ERROR";
    }

    $mysql->close();



}



?>