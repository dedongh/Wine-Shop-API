<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 6/1/2018
 * Time: 4:15 AM
 */

require_once 'db_functions.php';
$db = new DB_Functions();
/*
* Endpoint : http://<domain>/Shoppy/register.php
* Method: POST
* Params: phone,name,birthdate,address
* Result: JSON
*/
$response = array();
if (isset($_POST["phone"]) && isset($_POST["name"]) && isset($_POST["birthdate"]) && isset($_POST["address"])) {
    $phone = $_POST["phone"];
    $name = $_POST["name"];
    $birthday = $_POST["birthdate"];
    $address = $_POST["address"];

    if ($db->checkUserExist($phone)) {
        $response["error_msg"] = "User with phone number: " . $phone . " already exists";
        echo json_encode($response);
    } else {
        //create new user
        $user = $db->registerNewUser($phone, $name, $birthday, $address);
        if ($user) {
            $response["phone"] =  $user["Phone"];
            $response["name"] = $user["Name"];
            $response["birthdate"] = $user["Birthdate"];
            $response["address"] = $user["Address"];
            echo json_encode($response);
        } else {
            $response["error_msg"] = "An error occurred during registration please try again later ";
            echo json_encode($response);
        }
    }
} else {
    $response["error_msg"] = "Required parameter (phone, name, birthdate, address) is missing";
    echo json_encode($response);
}