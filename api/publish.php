<?php

include 'mysql.php';
session_start();
try {

    function publish() {


        if ($_POST["type"] == "art") {
            $lastid = md5($_POST["html"]);
            echo query("insert into articles values(' ', " . $_SESSION["userid"] . ", '" . $_POST["title"] . "','" . $_POST["description"] . "','" . $lastid . "', '" . date("Y-m-d H:i:s") . "' ,1)");
            $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/articles/" . $lastid . ".bin", "w");
            fwrite($myfile, $_POST["html"]);
            fclose($myfile);
        } else if ($_POST["type"] == "post") {
            $lastid = md5($_POST["html"]);
            echo query("insert into blog values(' ', " . $_SESSION["userid"] . ", '" . $_POST["title"] . "','" . $_POST["description"] . "','" . $lastid . "', '" . date("Y-m-d H:i:s") . "' ,1)");
            $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/posts/" . $lastid . ".bin", "w");
            fwrite($myfile, $_POST["html"]);
            fclose($myfile);
        }
    }

    if (array_key_exists('userid', $_SESSION)) {
        publish();
    } else {
        echo "Access denied.";
    }
} catch (Exception $e) {
    echo $e;
}
?>