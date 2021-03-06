<?php

header("Content-Type: application/json");
require_once "../../Models/User.php";
session_start();
spl_autoload_register(function ($className) {
    require_once "../../Models/lib/$className.php";
});

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputJSON = file_get_contents("php://input");
    $input = json_decode($inputJSON, TRUE);

    $accept = $input["acceptance"];
    $userID = $input["id"];
    $msg = "hello";

    if ($accept) {
        User::approveAdminRequest($userID);
        $msg = "Admin request approved";
    } else {
        User::denyAdminRequest($userID);
        $msg = "Admin request denied";
    }

    echo json_encode($msg);
}
