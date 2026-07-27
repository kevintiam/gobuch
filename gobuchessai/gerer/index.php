<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start(); 
header('location:../auth.php');
?>