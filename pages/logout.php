<?php

session_start();
session_destroy();
header("location: http://blog.me:80/form/index.php");