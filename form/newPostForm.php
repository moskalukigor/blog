<?php
 include_once 'index.php';
 
 ?>

<div class="newPost">
            <h1>New Post</h1>
        <form action="/pages/addPost.php" method="post">
            <textarea style="overflow:hidden" name="titlePost" id="title" placeholder="Title! Max 80 chars."  maxlength="90"></textarea>
            <textarea name="textPost" id="word" placeholder="Text!"></textarea>
            <input id="btnAdPost" class="indexButton" type="submit" value="AddPost"/>
        </form>
</div>