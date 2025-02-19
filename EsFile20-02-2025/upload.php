<?php

if(!isset($_POST["send"])){
    echo "<form action = {$_SERVER['PHP_SELF']} enctype='multipart/form-data' method='post'>";
    echo "<input type='file' name='file'>";
    echo "<input type='submit' name='upload' value='upluoda'>";
    echo "</form>";
}

if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["upload"]))){
    $file = $_FILES;
    echo mime_content_type($file["file"]["type"]);
    //if($file["type"])
}

?>