<?php

session_start();
if (array_key_exists('userid', $_SESSION)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/api/utility.php';
    RegMasterPage("masterpage", "profile_settings");
} else {
    echo "You do not have permition to access this page";
}
?>