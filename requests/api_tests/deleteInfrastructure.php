<?php

// Bootstrap
header("Content-Type: application/json");
require_once "../../Models/Role.php";
session_start();
spl_autoload_register(function ($className) {
    require_once "../../Models/lib/$className.php";
});

if ($succeeded = Authorisation::hasAuth("edit")) {
    // $data = :deleteInfrastructure("5e16014d1c7a63001279fb09");
    $data = "infrastructure data was deleted";
    echo json_encode($data);
} else {
    $data = new stdClass();
    $data->error = "You do not have authorisation for this";
    echo json_encode($data);
}

SessionLog::createLog([
    "endpoint" => "Infrastructure - Delete",
    "succeeded" => $succeeded ? 1 : 0
]);
