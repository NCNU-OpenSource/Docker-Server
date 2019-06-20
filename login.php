<?php
include 'mysqlCon.php';
$userAccount = (isset($_REQUEST['account']) && !empty($_REQUEST['account'])) ? $_REQUEST['account'] : NULL;
$userPassword = (isset($_REQUEST['password']) && !empty($_REQUEST['password'])) ? $_REQUEST['password'] : NULL;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `users` WHERE account = '$userAccount'";
    // use exec() because no results are returned
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_OBJ);
    if(!empty($userAccount) && $userAccount == $row->account){
        if($userPassword == $row->password){
            session_start();
            $_SESSION["account"] = $row->account;
            $_SESSION["password"] = $row->password;
            echo "<script>location.href = '.';</script>";
        }
        else
            echo "<script>alert('密碼有誤'); location.href = '.';</script>";
    }else{
        echo "<script>alert('密碼/帳號有誤'); location.href = '.';</script>";
    }
} catch (PDOException $e) {
    echo $sql.'<br>'.$e->getMessage();
}

$conn = null;