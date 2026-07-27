   
  <?php
  session_cache_limiter('private_no_expire,must-revalidate');session_start();
   if(isset($_GET['ensb'])){
    $val=$_GET['ensb'];
      $arrayrec=array(); 
              $arrayrec=explode("@",$val);  
               $a=$arrayrec[0];$b=$arrayrec[1];
    if($a>0 AND $b>0){
        $_SESSION['nodembetreuer']=$a;
 $_SESSION['idprogempl']=$b;     $_SESSION['backemp']=1;  
  header('location:seance.php');
    }
    else{
         header('location:emploivue.php');
    }
}


   

                  
  
 
            ?>