<?php
session_start();
require_once '../common.php';

$userName;
if(isset($_SESSION['user_id']))
{
    $dbuser = 'root';
    $dbpass = '';
    $connection = new PDO('mysql:dbname=blog;host=localhost',$dbuser,$dbpass);
    $sql = "select * from users where UserID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($_SESSION['user_id']));
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    $userName = $rows[0]['UserName'];
}   
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/textarea.css">
    </head>
<body>
     
        <div class="formIndex">  
            
            <div class="Title">
                <h1 name="Title">Blog.MY</h1>
            </div> 
            
            <?php
                if(!isset($_SESSION['user_id']))
                {
                    ?>
                        <form action="loginForm.php" method="get">
                            <div class="LoginButton">
                                <input type="submit" value="login"/>
                            </div>
                        </form>
                        <form action="registerForm.php" method="get">
                            <div class="RegisterButton">
                                <input type="submit" value="register"/>
                            </div>
                        </form>
                    <?php
                }
                else
                {
                    ?>
                    <?php p("<div><h1 class='nameUser'>$userName</h1></div>")?>
                    <form action="../pages/logout.php" method="get">
                            <div class="LogOutButton">
                                <input type="submit" value="logout"/>
                            </div>
                    </form>
                        <?php
                }
 
            ?>
        </div>
    <hr class="hr">
    
    <h1>Custom Placeholder</h1>
    <input type="text" placeholder="Placeholder customized!" class="inputArea" />
    <textarea placeholder="Placeholder customized!"></textarea>

</body>
</html>