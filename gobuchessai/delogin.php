<?php 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
unset($_SESSION['wegonlinenum']);      header('location:index.php');
  ?>