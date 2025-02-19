<?php

if(!isset($_POST["send"])){
    echo "<form action = {$_SERVER['PHP_SELF']} enctype='multipart/form-data' method='post'>";
}