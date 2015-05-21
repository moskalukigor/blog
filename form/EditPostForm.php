<?php

include_once 'index.php';
header('Content-Type: text/html; charset=utf-8');
    if(!isset($_POST['PostID']))
    {
        header("location: http://blog.me:81/form/AllPostForm.php");
    }
    
    $sql = "SELECT * FROM `posts` WHERE PostID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($_POST['PostID']));
    $post = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="newPost">
            <h1>Edit Post</h1>
        <form action="/pages/EditPost.php" method="post">
            <input type='hidden' name='PostID' value="<?php echo $_POST['PostID'] ?>"/>
            <textarea style="overflow:hidden" name="titlePost" id="title" placeholder="Title! Max 80 chars."  maxlength="90"><?php echo $post[0]['PostTitle']?></textarea>
            <textarea name="textPost" id="word" placeholder="Text!"><?php echo $post[0]['PostText']?></textarea>
            <input id="btnEditPost" class="indexButton" type="submit" value="Edit"/>
        </form>
</div>
