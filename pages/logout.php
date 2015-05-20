<?php

session_start();
session_destroy();
header("location: http://blog.me:81/form/index.php");