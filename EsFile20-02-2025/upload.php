<?php

require_once("DbConnection.php");
require_once("config.php");


if(!isset($_POST["send"])){
    echo "<form action = {$_SERVER['PHP_SELF']} enctype='multipart/form-data' method='post'>";
    echo "<input type='file' name='file'>";
    echo "<input type='submit' name='upload' value='upluoda'>";
    echo "<input type='submit' name='show' value='showa le immagini'>";
    echo "</form>";
}

if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["show"]))){
    $con = DbConnection::getConnection();
    $query = "SELECT name, route FROM IMMAGINI;";
    $stmt = $con -> prepare($query);
    $stmt -> execute();
    $stmt -> bind_result($name, $route);
    while ($stmt->fetch()){
        echo "<img src='{$route}{$name}' alt='{$name}'>";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["upload"]))){
    $con = DbConnection::getConnection();

    $file = $_FILES;
    $tipo = $file["file"]["type"]; 

    $check = strstr($tipo, '/', true);
    if($check != 'image'){
        die("spiaze, ma il file selezionato non è una immagine");
    }
    if(!(file_exists("images"))){
        mkdir("images", 0777);
    }
    $cartella = "images/";
    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    $allFiles = array_diff(scandir($cartella), array("..", "."));
    $numberFiles = count($allFiles);
    $name = "immagine{$numberFiles}.{$ext}";
    $route = $cartella;

    move_uploaded_file($file["file"]["tmp_name"], $route.$name);

    $query = "INSERT INTO immagini (name, type, route, dateUpload) VALUES (?, ?, ?, ?);";
    $stmt = $con->prepare($query);
    $date = date("Y-m-d-h-i-s");
    $stmt -> bind_param("ssss", $name, $tipo, $route, $date);
    $stmt -> execute();
    $stmt -> close();

    
}

?>