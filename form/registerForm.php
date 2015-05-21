<?php
    session_start();
    require_once '../common.php';
    if(isset($_SESSION['user_id']))
    {
        header("location: http://blog.me:81/form/AllPostForm.php");
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/register.css">
    </head>
<body>
    <form action="/pages/Register.php" method="post"> 
        <div class="form">
              
          <div class="username">
            <input name="username" type="text" placeholder="Username"/>
          </div>
              
          <div class="password">
            <input name="password" type="password" placeholder="Password"/>
          </div>
          <div class="password">
            <input name="againPassword" type="password" placeholder="Again Password"/>
          </div>
            
          <div class="email">
            <input name="email" type="text" placeholder="Email"/>
          </div>
              
          <div class="Register">
              <input type="submit" value="Register"/>
          </div>  
        </div>
    </form>     
</body>
</html>