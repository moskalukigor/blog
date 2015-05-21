<?php

    require_once '../common.php';

    $dbuser = 'root';
    $dbpass = '';
    $connection = new PDO('mysql:dbname=blog;host=localhost',$dbuser,$dbpass);
    $sql = "select * from posts";
    $query = $connection->prepare($sql);
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    pr($rows);
    
    
    $html = "<table>";
    foreach ($rows as $k)
    {
        $html .= "<tr><th><text><h2>{$k['PostTitle']}</h2></text></th></tr>";
        $html .= "<tr><th><text>{$k['PostText']}<br><br><br><br></text></th></tr>";
        $html .= "<br>";
    }
    $html .= "</table>";
    
    print($html);