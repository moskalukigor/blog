<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
session_destroy();
header("location: http://blog.me:81/form/AllPostForm.php");