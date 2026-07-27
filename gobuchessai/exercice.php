<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
require 'connectC.php';   require 'lesmenus.php'; require 'lesfunctions.php'; 
/*$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
 
$bloc=1;$actif=$bloc; $pageactif=1;


$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=3; $newp=3;

if($numpagepreced==2 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="cours.php";
}
if(isset($_GET['idlecon'])){
  $_SESSION['idleconc']=$_GET['idlecon'];
  $_SESSION['nomleconc']=nomlecon($_SESSION['idleconc']);
}
$_SESSION['nomleconc']=nomlecon($_SESSION['idleconc']);

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

 
*/


try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
?>










<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercices</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- overlayScrollbars -->
   <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <script>
    
    let auto=setInterval(temps,15000);
    function temps(str){
         if(str==" "){
             document.getElementById("yes").innerHTML=" ";
             return ;
         }
         else{
             var xmlhttp=new XMLHttpRequest();
             xmlhttp.onreadystatechange=function(){
                 if(this.readyState==4 && this.status==200 ){
                     document.getElementById("yes").innerHTML=this.responseText;
                 }
             };
             xmlhttp.open("POST","acturepet.php",true);
             xmlhttp.send();
         }
     }
     </script>


</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
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
      <li class="nav-item">
        
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
      <a class="btn btn-success" href="repetition.php" data-filter="all"> Aide</a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
       
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exercices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <b><?php echo $_SESSION['nomatierec'];?></b> </li>
              <li class="breadcrumb-item active"><b><?php echo $_SESSION['nomclassec'];?></b></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       

      <?php    
         if( $_SESSION['numrepetok']==0) {
          echo "<div class='alert alert-warning alert-dismissible'>
                   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                   <h5><i class='icon fas fa-check'> Laissez nous votre numéro, pour recevoir un accompagnement dans vos études.</i> 
                 </h5>
                     </div> ";
         
          echo"<form action='executereq.php' method='post'>
          <label for='exampleInputPassword1'>NUMERO DE TELEPHONE</label>
         <div class='btn-group w-100 mb-2'>
         <button type='button'   class='btn btn-secondary'>+237</button>
         <input name='tel' class='form-control' required>
         <button type='submit' name='envoinum' class='btn btn-success' value='send'>OK</button>
         </div>
          
          </form>";
          
             
               ; 
             
        }          
                   ?>

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><a href="#" style="color:blue;"><u>Chapitre <?php echo ordchap($_SESSION['idchapc']);?></u> :</a> <a href="#" style="color:red;"><?php echo $_SESSION['nomchapc'];?></a></h5>
        
        
        <!-- =========================================================== -->


 <!-- Small Box (Stat card) -->
 
 <!--div class="card card-success">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="card mb-2 bg-gradient-dark">
          <img class="card-img-top" src="44.png" alt="Dist Photo 1">
          <div class="card-img-overlay d-flex flex-column justify-content-end">
            <h5 class="card-title text-primary text-white">Card Title</h5>
            <p class="card-text text-white pb-2 pt-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor.</p>
            <a href="#" class="text-white">Last update 2 mins ago</a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="card mb-2">
          <img class="card-img-top" src="45.jpeg" alt="Dist Photo 2">
          <div class="card-img-overlay d-flex flex-column justify-content-center">
            <h5 class="card-title text-white mt-5 pt-2">Card Title</h5>
            <p class="card-text pb-2 pt-1 text-white">
              Lorem ipsum dolor sit amet, <br>
              consectetur adipisicing elit <br>
              sed do eiusmod tempor.
            </p>
            <a href="#" class="text-white">Last update 15 hours ago</a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="card mb-2">
          <img class="card-img-top" src="47.jpeg" alt="Dist Photo 3">
          <div class="card-img-overlay">
            <h5 class="card-title text-primary">Card Title</h5>
            <p class="card-text pb-1 pt-1 text-white">
              Lorem ipsum dolor <br>
              sit amet, consectetur <br>
              adipisicing elit sed <br>
              do eiusmod tempor. </p>
            <a href="#" class="text-primary">Last update 3 days ago</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div -->
 
 <!-- =========================================================== -->








 <div class="row">
  <div class="col-md-3">
     

  <div class="card">
      <div class="card-header">
        <h3 class="card-title" style="color:red";>Les leçons</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
           
          <?php  
           
          $lecon="SELECT * FROM lecon WHERE idchapitre='".$_SESSION['idchapc']."' ORDER BY ordre";
          $replecon = $bdd->query($lecon);
          
          while ($donlecon = $replecon->fetch()){
            $idlecon=$donlecon['idlecon'];
            $nomlecon=$donlecon['nomlecon'];
            $texte=$donlecon['texte'];
            $video=$donlecon['video'];
            $image=$donlecon['image'];
            $order=$donlecon['ordre'];
            echo "
            
            <li class='nav-item'>
            <a href='exercice.php?idlecon=".$idlecon."' class='nav-link'>
               Leçon ".$order." : ".$nomlecon."
            </a>
          </li>
            
            ";  
        
        
        
        } 
          $replecon->closeCursor(); 
          ?>
           
          
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
     
  </div>
  <!-- /.col -->
<div class="col-md-9">
  <div class="card card-primary card-outline">
    <div class="card-header">
    <h3 class="card-title" style="color:blue;">  <?php 
      if($_SESSION['idleconc']!=0){echo "Leçon ".ordlecon($_SESSION['idleconc'])." : ".$_SESSION['nomleconc'];}?> </h3>

    <!--div class="card-tools">
        <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
        <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
      </div-->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="mailbox-read-info">
        <h5> </h5>
        <h6> 
          <span class="mailbox-read-time float-right"> </span></h6>
      </div>
      <!-- /.mailbox-read-info -->
      <div class="mailbox-controls with-border text-center">
        <!--div class="btn-group">
          <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
            <i class="far fa-trash-alt"></i>
          </button>
          <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
            <i class="fas fa-reply"></i>
          </button>
          <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
            <i class="fas fa-share"></i>
          </button>
        </div-->
        <!-- /.btn-group -->
        <!--button type="button" class="btn btn-default btn-sm" title="Print">
          <i class="fas fa-print"></i>
        </button-->
      </div>
      <!-- /.mailbox-controls -->
      <div class="mailbox-read-message">
      <?php  
      $isMob=is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"mobile"));

      
      if($_SESSION['idleconc']!=0 ){
        $v="SELECT * FROM exercice WHERE idlecon='".$_SESSION['idleconc']."' ORDER BY texte";
$reponse = $bdd->query($v);
$i=1;
while ($donnees = $reponse->fetch() )
{
  $idleconimg=$donnees['idexo'];
  $nomorig=" ";
  $nomnew=$donnees['image'];
  if(!$isMob){
  echo "<img class='card-img-top' src='exercice/".$nomnew."' alt='lecon'>";
  }
  if($isMob){
echo " <img src='exercice/".$nomnew."' height='700px' width='380px'> </br>";
  $i++;
  }
} 
$reponse->closeCursor();    
        }?>
      
         
        <p>
           .</p>

           
      </div>  
     
      <!-- /.mailbox-read-message -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer bg-white">
    

      <div class="btn-group w-100 mb-2">
    
                            <a class="btn btn-success" href="repetition.php" data-filter="all"><i class="fas fa-edit"></i> Solliciter un(e) enseignant(e)</a>
       
                         
        </div>



        </Br></Br></Br> 




      <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
        <li>
          <img class="card-img-top" src="i44.jpg" alt="Dist Photo 1">
        </li>
        <li>
          <img class="card-img-top" src="i45.jpg" alt="Dist Photo 1">
        </li>
        <li>
          <img class="card-img-top" src="i47.jpg" alt="Dist Photo 1">
        </li>
         
      </ul>
    </div>



                  
   

   
       
 

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

     
  
  <!-- /.content-wrapper -->

   <!-- Main Footer --></br></br></br></br>
   <footer class="main-footer">
  
    <div class="btn-group w-100 mb-2">
      
     <?php   echo"<a class='btn btn-success' href='cours.php?idlecon=".$_SESSION['idleconc']."' data-filter='2'><span class='nav-icon fas fa-table'></span> Revenir au cours</a>";
 ?>
                       <a class="btn btn-primary" href="tel:+237674494384" data-filter="2"><span class="fas fa-rg fa-phone"></span> Appel</a>
     
    <!--button class="btn btn-warning" type='button' data-toggle='modal'   data-target='#pdf'><i class="far fa-file-pdf"></i> PDF</button-->               
      
    </div>
     



      
   
    


     </footer>

    
    
  





  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
 



  <?php  echo "<div class='modal fade' id='voirvideo'> " ; ?>
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <h4 class="modal-title">Vidéo du cours</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <p><div class="form-group">
            <video width="300" height="240"  controls>

<source src="video1.mkv" type="video/avi">
</video>  
                </p>
          </div>
          <div class="modal-footer justify-content-between">


             
              <button type="submit" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button  type="submit" name="enregnote"   class="btn btn-primary">Enregistrer</button>
     </div>
  </form> </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



  <?php  echo "<div class='modal fade' id='editnote'> " ; ?>
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <h4 class="modal-title">Editer les notes de cours</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <p><div class="form-group">
            <textarea id="compose-textarea" class="form-control" style="height: 300px"></textarea>  
                </p>
          </div>
          <div class="modal-footer justify-content-between">


             
              <button type="submit" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button  type="submit" name="enregnote"   class="btn btn-primary">Enregistrer</button>
     </div>
  </form> </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




     <?php  echo "<div class='modal fade' id='pdf'> " ; ?>
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <h4 class="modal-title">Téléchargement des exercices</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <p><div class="form-group">
            <i class="far fa-file-pdf"></i><?php echo "
            <a href='executereq.php?telechexolecon=".$_SESSION['idleconc']."' 
           >Télécharger l'exercice</a>" ; ?>  </br>
                 
                </p>
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
<!-- AdminLTE for demo purposes -->
 

<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>


</body>
</html>
