<?php
 
function run() {
    $artval = $_GET["val"];
    $file_path = $_SERVER['DOCUMENT_ROOT'] . "/articles/" . $artval . ".bin";
    $myfile = fopen($file_path, "r");
    echo "[" . fread($myfile, filesize($file_path)) . "]";
    fclose($myfile);
}

run();
?>