<?php

$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "camera"
);


if($mysql->connect_error){
    die("Fallo al conectar: ".$mysql->connect_error);
}