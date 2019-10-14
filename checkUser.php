<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 6/1/2018
 * Time: 3:47 AM
 */

require_once 'db_functions.php';
$db = new DB_Functions();

/*
 * Endpoint : http://<domain>/Shoppy/checkUser.php
 * Method: POST
 * Params: phone
 * Result: JSON
*/
$response = array();
if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
    if ($db->checkUserExist($phone)) {
        $response["exists"] = TRUE;
        echo json_encode($response);
    } else {
        $response["exists"] = FALSE;
        echo json_encode($response);
    }
} else {
    $response["error_msg"] = "Required parameter (phone) is missing";
    echo json_encode($response);
}

