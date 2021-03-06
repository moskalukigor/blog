<?php
require_once '../common.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    p("<a href = '/form/AllPostForm.php'>Back</a>");
    die("Invalid session");
}

if(empty($_POST))
{
   p("<a href = '/form/AllPostForm.php'>Back</a>");
   die("POST is empty");
}
if(empty($_POST['titlePost']) || empty($_POST['textPost']))
    {
        p("<a href = '/form/AllPostForm.php'>Back</a>");
        die("Title or text is empty");       
    }
    
$themePost = $_POST['titlePost'];
$textPost = $_POST['textPost'];

$dbuser = 'root';
$dbpass = '';
$connection = new PDO('mysql:dbname=blog;host=localhost',$dbuser,$dbpass);


$postsData = [$themePost, $textPost, $_SESSION['user_id']];

$sql = "INSERT INTO `posts`(`PostTitle`, `PostText`, `OwnerID`) VALUES (?, ?, ?)";
$query = $connection->prepare($sql);
$query->execute($postsData);


header("location: http://blog.me:81/form/AllPostForm.php");