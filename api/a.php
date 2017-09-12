<?php

include 'mysql.php';
session_start();
echo query("SELECT COUNT(*) as count FROM articles;")[0]["count"];
?>