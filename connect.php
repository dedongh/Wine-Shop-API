<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 6/1/2018
 * Time: 3:05 AM
 */
class DB_Connect
{
    private $con;

    public function connect()
    {
        require_once 'config.php';
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        return $this->con;
    }
}