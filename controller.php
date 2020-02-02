<?php
include ("function.php");
$action = htmlspecialchars($_REQUEST["action"], ENT_QUOTES);
switch ($action) {
    case "init":
        header('Content-Type: application/json');
        die(json_encode($main->read_db()));
        break;
    case "search":
        $data = htmlspecialchars($_POST["search_terms"], ENT_QUOTES);
        die(json_encode($main->search_db($data)));
    default:
        break;
}