<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 6/1/2018
 * Time: 3:08 AM
 */
class DB_Functions
{
    private $con;
    function __construct()
    {
        require_once 'connect.php';
        $db = new DB_Connect();
        $this->con = $db->connect();
    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /*
     * check if user exists
     * returns true or false
    */
    function checkUserExist($phone)
    {
        $stmt = $this->con->prepare("select * from users where Phone = ? ");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    /*
     * register new user
     * returns user object if user was created*/
    public function registerNewUser($phone, $name, $birthdate, $address)
    {
        $stmt = $this->con->prepare("insert into users(Phone,Name,Birthdate,Address) values (?,?,?,?)");
        $stmt->bind_param("ssss", $phone,$name, $birthdate,$address);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            $stmt = $this->con->prepare("select * from users where Phone = ?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        }else
            return false;
    }

    /*
     * fetch User Info
     * return user object if user exists
     * */
    public function fetchUserInfo($phone)
    {
        $stmt = $this->con->prepare("select * from users where Phone = ?");
        $stmt->bind_param("s", $phone);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }

    /*
     * Get banner image
     * returns list of banners
     * */

    public function getBanners()
    {
        $result = $this->con->query("Select * from banner order by id desc ");

        $banners = array();
        while ($item = $result->fetch_assoc())
            $banners[] = $item;
        return $banners;
    }

    /*
     * Get Menu
     * returns list of Menus
     * */

    public function getMenu()
    {
        $result = $this->con->query("Select * from menu ");

        $menu = array();
        while ($item = $result->fetch_assoc())
            $menu[] = $item;
        return $menu;
    }
    /*
    * Get item based on Menu ID
    * returns list of drinks
    * */
    public function getDrinkByMenuID($menuID)
    {
        $query = "Select * from drink where MenuId = '" . $menuID . "'";
        $result = $this->con->query($query);

        $drinks = array();
        while ($item = $result->fetch_assoc())
            $drinks[] = $item;
        return $drinks;
    }
}