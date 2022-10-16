<?php

if($_SERVER["REQUEST_METHOD"]  == "POST"){
    
    //http://192.168.0.14/camera/upload/imagen.jpg
    $cantidad = intval($_POST["length"]);
    $res = "";
    $res = $cantidad . "<br>";

    
    for($i = 0; $i < $cantidad; $i++){
        saveImage($_POST["path".$i]);
        $res .= "Path: <br>" . $_POST["path$i"] . "<br>";
    }
    
    echo $res;

}

function saveImage($path){
    require("db.php");

    $imageData = $path;//$_POST["path"];
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