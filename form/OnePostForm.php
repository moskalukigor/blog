<?php
    include_once 'index.php';
    
    if(!isset($_POST['PostID']))
    {
        header("location: http://blog.me:81/form/AllPostForm.php");
    }
    
    $sql = "SELECT * FROM `posts` WHERE PostID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($_POST['PostID']));
    $post = $query->fetchAll(PDO::FETCH_ASSOC);

    
    $sql = "select UserName from users where UserID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($post[0]['OwnerID']));
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    $userName = $rows[0]['UserName'];
    


 ?>
    <div class="AllPost">
        <table style="max-width: 90%">
            <?php
                echo "<tr><th style='text-align: left'><text style='font-size:30'>{$post[0]['PostTitle']}</text><text style='color:blue'> $userName</text></th></tr>";
                echo "<tr><th style='text-align: left;border-bottom: 1px solid white'><text style='max-width:200px; word-wrap:break-word;'>{$post[0]['PostText']}</text></th></tr>";
                echo "<tr><th style='text-align: left;border-bottom: 1px solid white'><text style='max-width:200px; word-wrap:break-word;'>Created date: {$post[0]['PostDate']}</text></th></tr>";
           ?>
        </table>
    </div> 
