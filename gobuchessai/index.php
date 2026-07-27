<?php

session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*require 'connectC.php';  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'lesmenus.php'; require 'connectC.php';
 
$bloc=0;$actif=$bloc; $pageactif=0;
$_SESSION['numpage']=0; $_SESSION['numrepetok']=0;
$_SESSION['cid']=0;  $_SESSION['respenvoi']=0;
$_SESSION['classec']=0; $_SESSION['idleconc']=0; $_SESSION['nomleconc']=0;
$_SESSION['idschool']=0;$_SESSION['temps']=0;$_SESSION['choixevalv']=0; $_SESSION['idevalv']=0;
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
/*
Si l'adresse ip est déjà enregistrée ds la bd et 
parametrer comme se souvenir de moi, on recherche les infos de cette adresse ip
on redirige l'utilisateur vers la page espace.php

*/
/*
$_SESSION['modeafficheoffr']=0; $_SESSION['ordreoffr']=0; $_SESSION['idqtieroff']=0;
$_SESSION['modeafficheoffrvil']='a';  $_SESSION['modeafficheoffrdom']='a'; $_SESSION['reqidqtieroff']=" ";
$_SESSION['oksuppdmd']=0; $_SESSION['listaboreq']="SELECT * FROM benutzer  WHERE sup='0' ORDER BY nomb";
$souvenir=souvenirip($_SESSION['addrIp']);
try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
  } 
catch(Exception $e) 
 {       
    die('Erreur : '.$e->getMessage());
 }
 if($souvenir==1){ 
  $_SESSION['yd']=$souvenir;
  $_SESSION['yuser']=userb($_SESSION['yd']);
  $_SESSION['ymtp']=mtpb($_SESSION['yd']);
  $_SESSION['ynom']=nomb($_SESSION['yd']);
  $_SESSION['yemail']=emailb($_SESSION['yd']);
  $_SESSION['yidville']=idvilleb($_SESSION['yd']);
  $_SESSION['yqtier']=qtierb($_SESSION['yd']);
  $_SESSION['yimage']=imageb($_SESSION['yd']);
  $_SESSION['yentrep']=entrepb($_SESSION['yd']);
  $_SESSION['mesdomaines']=array();$_SESSION['mesdomainesous']=array();
  header('location:espace.php'); 
  }

  try 
      {
       $bdd = new PDO(host(),UTIL(),mtp());  
       } 
       catch(Exception $e) 
       {       
       die('Erreur : '.$e->getMessage());
       }
*/
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Accueil - gobuch</title>
  <link rel="shortcut icon" type="image/png" href="client/profil.png"/>
   
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
   

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link"><B><?php echo logo();?></B></a>
      </li>
       
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
       
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
   
      <?php
      // $_SESSION['wegonlinenum']=4;
        // unset($_SESSION['wegonlinenum']);  // pour detruire
      if(!isset($_SESSION['wegonlinenum'])){
      echo "<li class='nav-item'>
      <a class='btn btn-info' href='login.php' data-filter='2'> <b>Se connecter</b></a>
      </li>";
        }
        if(isset($_SESSION['wegonlinenum'])){
          if($_SESSION['wegonlinenum']==0){ 
          echo "<li class='nav-item'>
          <a class='btn btn-info' href='login.php' data-filter='2'> <b>Se connecter</b></a>
          </li>";
               }
               if($_SESSION['wegonlinenum']!=0){ 
                echo "<li class='nav-item'>
                <a class='btn btn-danger' href='delogin.php' data-filter='2'> <b>Se deconnecter</b></a>
                </li>";
                     }
            }
      ?>
    </ul>
  </nav>
  <!-- /.navbar -->


 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php

menuhautappli();

?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
       
      <?php

menuhautnom("_SESSION['ynom']","_SESSION['yimage']");

?>
       

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php

tableaubord($bloc,$actif,$pageactif);

?>





           
          
          
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Accueil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
             
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><a href="#" class="text-black">Cours</a>-<a href="#" class="text-black">Exercices</a>-<a href="#" class="text-black">Examens</a></h5>
        <div class="row">
          
          
   
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Physique</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=3&idcours=2&idchap=54" class="small-box-footer">
                Première C <i class="fas fa-arrow-circle-right"> </i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Mathématiques</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=7&idcours=1&idchap=22" class="small-box-footer">
                Terminale D <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Cours</h3>
                
                <p><b>Informatique</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-user-plus"></i-->
              </div>
              <a href="lecon.php?idclasse=5&idcours=4&idchap=33" class="small-box-footer">
                Terminale A4 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Informatique</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-chart-pie"></i-->
              </div>
              <a href="lecon.php?idclasse=7&idcours=4&idchap=6" class="small-box-footer">
                Terminale D <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Mathématiques</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-chart-pie"></i-->
              </div>
              <a href="lecon.php?idclasse=5&idcours=1&idchap=41" class="small-box-footer">
                Terminale A4 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>SVTEEHB</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-chart-pie"></i-->
              </div>
              <a href="lecon.php?idclasse=7&idcours=6&idchap=110" class="small-box-footer">
                Terminale D <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Histoire</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=5&idcours=10&idchap=101&see=6" class="small-box-footer">
                Terminale C <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Informatique</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=4&idcours=4&idchap=68" class="small-box-footer">
                Première D<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Geographie</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=5&idcours=12&idchap=95&see=7" class="small-box-footer">
                Terminale D <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>ECM</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=6&idcours=11&idchap=77" class="small-box-footer">
                Terminale C <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Mathématiques</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=2&idcours=1&idchap=83" class="small-box-footer">
                Première A4 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>Cours</h3>

                <p><b>Physique</b></p>
              </div>
              <div class="icon">
                <!--i class="fas fa-shopping-cart"></i-->
              </div>
              <a href="lecon.php?idclasse=6&idcours=2&idchap=17" class="small-box-footer">
                Terminale C <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

         </div>
        <!-- /.row -->

        
        <!-- =========================================================== -->


 <!-- Small Box (Stat card) -->
 <h5 class="mb-2 mt-4"><a href="repetition.php" class="text-black">Accompagnement par un(e) enseignant(e)</a></h5>
 <div class="card card-success">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="card mb-2 bg-gradient-dark">
          <img class="card-img-top" src="i44.jpg" alt="Dist Photo 1">
          <div class="card-img-overlay d-flex flex-column justify-content-end">
            <h5 class="card-title text-primary text-white"></h5>
            <p class="card-text text-white pb-2 pt-1"><b> </b></p>
            <a href="#" class="text-white"><b>  </b></a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="card mb-2">
          <img class="card-img-top" src="i45.jpg" alt="Dist Photo 2">
          <div class="card-img-overlay d-flex flex-column justify-content-center">
            <h5 class="card-title text-white mt-5 pt-2"> </h5>
            <p class="card-text pb-2 pt-1 text-white">
            <b> </b>
            </p>
            <a href="#" class="text-white"><b> </b></a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="card mb-2">
          <img class="card-img-top" src="i47.jpg" alt="Dist Photo 3">
          <div class="card-img-overlay d-flex flex-column justify-content-center">
            <h5 class="card-title text-white"> </h5>
            <p class="card-text pb-2 pt-1 text-white">
            <b> </b></p>
            <a href="#" class="text-white"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></br></br></br></br>
 
 <!-- =========================================================== -->





       
 

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

     
  </div>
  <!-- /.content-wrapper -->

          <!--footer class="main-footer">
    <strong><a href="https://gobuch.com" style='color:black';>gobuch.com</a>  
   &nbsp &nbsp &nbsp &nbsp <a href="#" style='color:black';>Nous contacter</a>
   &nbsp &nbsp &nbsp &nbsp <a href="#" style='color:black';>Les avis</a></strong>
     <div class="float-right d-none d-sm-inline-block">
      <b><?php echo date('Y');?></b> 
    </div>
  </footer-->

   <footer class="main-footer">
  <div class="btn-group w-100 mb-2">
   <!--a class="btn btn-primary" href="tel:+237674494384" data-filter="2"><span class="fas fa-rg fa-phone"></span> Appel</a-->
      <button class="btn btn-info" type='button' data-toggle='modal'   data-target='#contact'><small><i class="far fa-comments"></i> Nous contacter</small></button> 
    <button class="btn btn-primary" type='button' data-toggle='modal'   data-target='#editnote'><small><i class="fas fa-edit"></i> Donnez votre avis</small></button>
                  
    </div> </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->



 <?php  echo "<div class='modal fade' id='editnote'> " ; ?>
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <h4 class="modal-title">Donnez votre avis</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <p><div class="form-group">
            <textarea id="compose-textarea" name="avis" class="form-control" style="height: 300px"> </textarea>  
                </p>
          </div>
          <div class="modal-footer justify-content-between">

 <button type='submit' class='btn btn-default' data-dismiss='modal'>Fermer</button>
      <button  type='submit' name='enregavis' class='btn btn-primary'>Enregistrer</button>
   
     </div>
  </form> </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<?php  echo "<div class='modal fade' id='contact'> " ; ?>
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <h4 class="modal-title">Nous contacter</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <div class="form-group"> 
              
            
              <?php 
             $v="SELECT * FROM acontact";
	 $reponse = $bdd->query($v);
	 $op=0; $true=0;
	while ($donnees = $reponse->fetch())
	{
		 $nomel=$donnees['nom']; 
      $numsimple=$donnees['numsimple'];  $numwh=$donnees['numwh'];
      $nomcontact=$donnees['nom'];
      echo "<div class='card card-solid'><div class='card-body pb-0'><div class='row'>
        <b>";
        if($numsimple!=''){ 
        echo"<a href='tel:".$numsimple."' style='color:black';>".$numsimple." &nbsp &nbsp &nbsp <span class='fas fa-rg fa-phone' style='color:blue';></span></a></br></br>";
}
        echo "<a href='https://wa.me/".$numwh."' style='color:black';>".$numwh." &nbsp &nbsp &nbsp <span class='fab fa-whatsapp' style='color:green';></span></a></br>
        </b>
        </div></div></div> </br>";

		 
	} 
	$reponse->closeCursOR(); 
   ?>

 </br> <b>==== Ou nous laisser un message ===</b></br> </br> 
  <p><div class="form-group">
            <textarea id="compose-textarea" name="avis" class="form-control" style="height: 100px"> </textarea>  
                </p>
          </div>
          <div class="modal-footer justify-content-between">

 <button type='submit' class='btn btn-default' data-dismiss='modal'>Fermer</button>
      <button  type='submit' name='enregms' class='btn btn-primary'>Envoyer</button>
   
     </div>  

           </div>
         
  </form> </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
 
</body>
</html>
