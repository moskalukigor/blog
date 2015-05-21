<?php
    include_once 'index.php';
    header('Content-Type: text/html; charset=utf-8');
    if(!isset($_POST['PostID']))
    {
        header("location: http://blog.me:81/form/AllPostForm.php");
    }
    
    $sql = "DELETE FROM `posts` WHERE PostID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($_POST['PostID']));
    $post = $query->fetchAll(PDO::FETCH_ASSOC);
    
    header("location: http://blog.me:81/form/AllPostForm.php");
?>

