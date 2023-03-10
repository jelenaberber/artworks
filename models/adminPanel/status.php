<?php
include "../functions.php";
include_once "../../config/connection.php";
if (!isset($_GET["id"]) || !isset($_GET["status"])) {
    header("Location: index.php?page=home");
    die();
}

$table = $_GET["table"];
$id = intval($_GET["id"]);
$status = $_GET["status"] == "0" ? 0 : 1;

if (changeActiveStatusForUser($table, $id, $status)) {
    header("Location: ../../index.php?page=admin&userMessage=Uspesno#admin-user");
    //http_response_code(200);
}
else {
    header("Location: ../../index.php?page=admin&userError=greska#admin-user");
    //http_response_code(200);
}