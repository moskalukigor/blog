<?php
require_once '../common.php';
session_start();


if(empty($_POST))
{
   p("<a href = '/form/loginForm.php'>Back</a>");
   die("POST is empty");
}
if(empty($_POST['username']) || empty($_POST['password']))
    {
        p("<a href = '/form/loginForm.php'>Back</a>");
        die("Username or Password is invalid");       
        //$error = "User or Password is invalid";
    }
    
$username = $_POST['username'];
$password = $_POST['password'];

$dbuser = 'root';
$dbpass = '';
$connection = new PDO('mysql:dbname=blog;host=localhost',$dbuser,$dbpass);

//hash(sha512+salt)
$salt = "pivo pivo vodochka pivo pivo";
$hash = hash("sha512",$password.$salt);

$sql = "select * from users where hash='$hash' AND UserName='$username'";
$query = $connection->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
if(count($rows) == 0)
{
    p("<a href = '/form/loginForm.php'>Back</a>");
    die("Username or Password is invalid"); 
}
    
$userID = $rows[0]['UserID'];
//SESSION
$_SESSION['user_id'] = $userID;

//cookie
$auth_key = hash("md5",$password.$salt.$username);
setcookie("auth_key",$auth_key);


$sql = "UPDATE users SET auth_key='$auth_key' WHERE username='$username'";
$query = $connection->prepare($sql);
$query->execute();

header("location: http://blog.me:81/form/index.php");




