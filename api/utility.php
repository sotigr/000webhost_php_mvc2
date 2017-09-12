<?php

function RegMasterPage($masterpage, $page) {
    $final = "";

    $file_path = $_SERVER['DOCUMENT_ROOT'] . "/interface/" . $masterpage . ".php";
    ob_start();
    include($file_path);
    $final = ob_get_contents();
    ob_end_clean();

    $file_path = $_SERVER['DOCUMENT_ROOT'] . "/interface/" . $page . ".php";
    ob_start();
    include($file_path);
    $page = ob_get_contents();
    ob_end_clean();

    $final = str_replace("<pcont></pcont>", $page, $final);

    echo $final;
}

?>