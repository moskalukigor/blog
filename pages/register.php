<?php
require_once '../common.php';
session_start();

if(isset($_SESSION['user_id']))
{
    header("location: http://blog.me:81/form/AllPostForm.php");
}

if(empty($_POST))
{
   p("<a href = '/form/registerForm.php'>Back</a>");
   die("POST is empty");
}
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))
    {
        p("<a href = '/form/registerForm.php'>Back</a>");
        die("Username or Password or amail is empty!");       
        //$error = "User or Password is invalid";
    }
    
if($_POST['password'] != $_POST['againPassword'])
{
    p("<a href = '/form/registerForm.php'>Back</a>");
    die("Passwords are not equal!"); 
}
    
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
    die("Incorrect email");
}

$username = $_POST['username'];
$password = $_POST['password'];
$againPassword = $_POST['againPassword'];
$email = $_POST['email'];

$dbuser = 'root';
$dbpass = '';
$connection = new PDO('mysql:dbname=blog;host=localhost',$dbuser,$dbpass);

//hash(sha512+salt)
$salt = "pivo pivo vodochka pivo pivo";
$hash = hash("sha512",$password.$salt);

$sql = "select * from users where UserName='$username' OR UserEmail='$email'";
$query = $connection->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);


$auth_key = hash("md5",$password.$salt.$username);

if(count($rows) != 0)
{
    p("<a href = '/form/registerForm.php'>Back</a>");
    die("User with such login or email already exists"); 
}

$userData = [$username, $email, $hash, $auth_key];

$sql = "INSERT INTO `users`(`UserName`, `UserEmail`, `hash`, `auth_key`) VALUES (?, ?, ?, ?)";
$query = $connection->prepare($sql);
$query->execute($userData);
$userID = $connection->lastInsertId();
    //SESSION
    $_SESSION['user_id'] = $userID;
    
    //cookie
    
    setcookie("auth_key",$auth_key);
    header("location: http://blog.me:81/form/AllPostForm.php");



