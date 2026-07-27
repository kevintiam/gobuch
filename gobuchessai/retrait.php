

<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
require 'connectC.php';   require 'lesmenus.php'; require 'lesfunctions.php'; 
 $_SESSION['classec']=$_POST['retour'];  

 $_SESSION['nomclassec']=nomclasse($_SESSION['classec']);
  header('location:programmegen.php');

 

?>