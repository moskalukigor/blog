<?php
 include_once 'index.php';
 header('Content-Type: text/html; charset=utf-8');
 
$userNames = array();


foreach($posts as $i)
{
    $sql = "select UserName from users where UserID=?";
    $query = $connection->prepare($sql);
    $query->execute(array($i['OwnerID']));
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    array_push($userNames,$rows[0]['UserName']);
}
$userNames = array_reverse($userNames);
$count = 0;


 
 ?>

    <div class="AllPost">
        <table style="max-width: 90%; margin-top: -5%">
            <?php
                foreach(array_reverse($posts) as $r)
                {
                    $temp = substr($r['PostText'], 0, 350)."...";
                    echo "<tr><th style='text-align: left'><text style='font-size:30'><br>{$r['PostTitle']}</text><text style='color:blue'> $userNames[$count]</text></th></tr>";
                    echo "<tr><th style='text-align: left;'><text'>$temp</text></th></tr>";
                    
                    if(isset($_SESSION['user_id']))
                    {
                        if($r['OwnerID'] == $_SESSION['user_id'])
                            echo "<form method='POST' action='EditPostForm.php'><input type='hidden' name='PostID' value='".$r['PostID']."'/><tr><th><input style='float:left' id='EditPost' type='submit' value='EditPost'/></th></tr></form>";
                    }
                    if(isset($_SESSION['user_id']))
                    {
                        if($r['OwnerID'] == $_SESSION['user_id'])
                            echo "<form method='POST' action='DeletePostForm.php'><input type='hidden' name='PostID' value='".$r['PostID']."'/><tr><th><input style='float:left' id='DeletePost' type='submit' value='DeletePost'/></th></tr></form>";
                    }
                    echo "<form method='POST' action='OnePostForm.php'><input type='hidden' name='PostID' value='".$r['PostID']."'/>";
                    echo "<tr><th style='border-bottom: 1px solid white'><input style='float:left' id='ShowPost' type='submit' value='Show Post'/></th></tr>";
                    echo "</form>";
                    $count++;
                }
           ?>
        </table>
    </div> 
