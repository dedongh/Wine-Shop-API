<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 8/30/2018
 * Time: 4:55 PM
 */
require_once 'db_functions.php';
$db = new DB_Functions();

$response = array();
if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];

    $user = $db->fetchUserInfo($phone);
    if ($user) {
        $response["phone"] =  $user["Phone"];
        $response["name"] = $user["Name"];
        $response["birthdate"] = $user["Birthdate"];
        $response["address"] = $user["Address"];
        echo json_encode($response);
    } else {
        $response["error_msg"] = "User does not exist ";
        echo json_encode($response);
    }
}else {
    $response["error_msg"] = "Required parameter (phone) is missing";
    echo json_encode($response);
}