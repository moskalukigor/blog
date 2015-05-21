<?php
session_start();
require_once '../common.php';

$userName;
    $dbuser = 'root';
    $dbpass = '';
    $connection = new PDO('mysql:dbname=blog;host=localhost',$dbuser,$dbpass);
if(isset($_SESSION['user_id']))
{
    $sql = "select * from users where UserID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($_SESSION['user_id']));
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    $userName = $rows[0]['UserName'];
}   

    $sql = "select * from posts";
    $query = $connection->prepare($sql);
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/textarea.css">
    </head>
<body>
     
        <div class="formIndex">
            <table class="tableHead" align="left" style="margin-left: 7%">
                          <tr>
                              <th><h1 name="Title">Blog.me</h1></th>      
                          </tr>
            </table>
            <?php
                if(!isset($_SESSION['user_id']))
                {
                    ?>
                        <table class="tableHead" align="right">
                          <tr>
                              <th><form action="loginForm.php" method="get"><input type="submit" value="login"/></form></th>
                              <th><form action="registerForm.php" method="get"><input type="submit" value="register"/></form></th>      
                          </tr>
                        </table>
                    <?php
                }
                else
                {
                    ?>
                    <table class="tableHead" align="right">
                          <tr>
                              <th><?php p("<h1>$userName</h1>")?></th>      
                              <th><form action="../pages/logout.php" method="get"><input type="submit" value="logout"/></form></th>
                          </tr>
                    </table>
                        <?php
                }
 
            ?>
        </div>
    <hr class="hr">
    
    
        <div class="newPost">
            <h1>New Post</h1>
        <form action="/pages/addPost.php" method="post">
            <textarea name="titlePost" id="theme" placeholder="Title!"></textarea>
            <textarea name="textPost" id="word" placeholder="Text!"></textarea>
            <input id="btnAdPost" type="submit" value="AddPost"/>
        </div>
        </form>
            
            
        <div class="AllPost">
            <table>
                <?php
                    foreach($posts as $i)
                    {
                        echo "<tr><th><text><h2>{$i['PostTitle']}</h2></text></th></tr>";
                        echo "<tr><th><text>{$i['PostText']}<br><br><br><br></text></th></tr>";
                    }
               ?>
            </table>
        </div> 
            
    

</body>
</html>