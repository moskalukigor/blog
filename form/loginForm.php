<?php
    session_start();
    require_once '../common.php';
    if(isset($_SESSION['user_id']))
    {
        header("location: http://blog.me:80/form/index.php");
    }

?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
<body>
    <form action="/pages/login.php" method="post"> 
        <div class="form">
              
          <div class="username">
            <input name="username" type="text" placeholder="username"/>
          </div>
              
          <div class="password">
            <input name="password" type="password" placeholder="password"/>
          </div>
              
          <div class="login">
              <input type="submit" value="login"/>
          </div>  
        </div>
    </form>     
</body>
</html>