<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*require 'connectC.php';  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';  require 'lesmenus.php'; require 'lesfunctions.php';
$bloc=4;$actif=$bloc; $pageactif=4;


$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=2; $newp=2;

if($numpagepreced==1 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="programmegen.php";
}
if($numpagepreced==0 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="index.php";
}
if(isset($_POST['envoi'])){
  $_SESSION['genresouh']=$_POST['genresouh'];
  $_SESSION['periodesouh']=$_POST['periodesouh'];
  $_SESSION['classesouh']=$_POST['classe'];
    $_SESSION['ortsouh']=$_POST['lieu'];
    $_SESSION['TELsouh']=$_POST['tel'];
    
  $_SESSION['tabmat']=array();  
  $_SESSION['tabmat']=$_POST['matiere'];
  $_SESSION['total']=count($_SESSION['tabmat']);
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


*/
try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
 $da=date('Y.m.d'); $he=date('H:i');
$reqq=$bdd->prepare('INSERT INTO visiteurlaisse(tel,adrip,date,heure) VALUES( ?,?,?,?)');
  $reqq->execute(array($_SESSION['TELsouh'],$_SERVER['REMOTE_ADDR'], $da,$he)); 

?>





<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emploi de temps - gobuch</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
      <?php  echo "<form action='repetition.php' method='POST'>"; ?>
     <button type="submit" class="btn"  style='color:white';>
      <i class="fas fa-arrow-left text-muted"></i>
    </button>
     </form> 
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
      <a class="btn btn-info" type='button' data-toggle='modal'   data-target='#editnote' data-filter="all"> vos choix</a>
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
            <h1>Prédéfinir un emploi de temps</h1>
          </div>
          <div class="col-sm-6">
             
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
 <div class="row">
  
 <div class="col-12">
 <form action="executereq.php" method="post">
 <?php

for($i=0;$i<$_SESSION['total'];$i++){
  $jourmat1="jourmat1".$i; $hdeb1="hdeb1".$i; $hduree1="hduree1".$i;
  $jourmat2="jourmat2".$i; $hdeb2="hdeb2".$i; $hduree2="hduree2".$i;
  $jourmat3="jourmat3".$i; $hdeb3="hdeb3".$i; $hduree3="hduree3".$i;
  echo "<!--debut pour matiere 1-->
 <div class='callout callout-success'>
<B>".nomatiere($_SESSION['tabmat'][$i])."</B>

</div>
<div class='card-body table-responsive p-0' style='height: 300px;''>
<table class='table table-bordered table-hover'> 
<tr bgcolor='blue'><td><B style='color:white';>Jours</B></td><td><B style='color:white';>Heure de début</B></td><td><B style='color:white';>Durée</B></td>
</tr>
<tr><td><B><div class='select2-purple'>
        <select name='".$jourmat1."'   class='form-control select2' style='width: 100%;'>
        <option value='0'>Choisir un jour</option>
        <option value='1'>Lundi</option><option value='2'>Mardi</option><option value='3'>Mercredi</option>
        <option value='4'>Jeudi</option><option value='5'>Vendredi</option><option value='6'>Samedi</option>
        <option value='7'>Dimanche</option>
        </select>
        </div></B></td>
        <td><B> 
        <div class='select2-purple'>
        <select name='".$hdeb1."'   class='form-control select2' style='width: 100%;'>
       
        <option value='1'>08:00</option><option value='2'>09:00</option><option value='3'>10:00</option>
        <option value='4'>11:00</option><option value='5'>12:00</option><option value='6'>13:00</option>
        <option value='7'>14:00</option><option value='8'>15:00</option><option value='9'>16:00</option>
        <option value='10'>17:00</option><option value='10.5'>17:30</option>
        <option value='11'>18:00</option><option value='11.5'>18:30</option><option value='12'>19:00</option>
        </select>
        </div>
        </B></td>
        
        <td><B> 
        <div class='select2-purple'>
        <select name='".$hduree1."'   class='form-control select2' style='width: 100%;'>
       
        <option value='1'>01:00</option><option value='1.5'>01:30</option>
        <option value='2'>02:00</option><option value='2.5'>02:30</option>
        <option value='3'>03:00</option><option value='3.5'>03:30</option>
        <option value='4'>04:00</option><option value='4.5'>04:30</option>
        <option value='5'>05:00</option><option value='5.5'>05:30</option>
        <option value='6'>06:00</option>
        </select>
        </div>


        </B></td>
</tr>





<tr><td><B><div class='select2-purple'>
        <select name='".$jourmat2."'   class='form-control select2' style='width: 100%;'>
        <option value='0'>Choisir un jour</option>
        <option value='1'>Lundi</option><option value='2'>Mardi</option><option value='3'>Mercredi</option>
        <option value='4'>Jeudi</option><option value='5'>Vendredi</option><option value='6'>Samedi</option>
        <option value='7'>Dimanche</option>
        </select>
        </div></B></td>
        <td><B> 
        <div class='select2-purple'>
        <select name='".$hdeb2."'   class='form-control select2' style='width: 100%;'>
       
        <option value='1'>08:00</option><option value='2'>09:00</option><option value='3'>10:00</option>
        <option value='4'>11:00</option><option value='5'>12:00</option><option value='6'>13:00</option>
        <option value='7'>14:00</option><option value='4'>15:00</option><option value='5'>16:00</option>
        <option value='6'>17:00</option><option value='4'>17:30</option>
        <option value='4'>18:00</option><option value='4'>18:30</option><option value='5'>19:00</option>
        </select>
        </div>
        </B></td>
        
        <td><B> 
        <div class='select2-purple'>
        <select name='".$hduree2."'   class='form-control select2' style='width: 100%;'>
       
        <option value='1'>01:00</option><option value='1'>01:30</option>
        <option value='2'>02:00</option><option value='3'>02:30</option>
        <option value='4'>03:00</option><option value='5'>03:30</option>
        <option value='6'>04:00</option><option value='1'>04:30</option>
        <option value='6'>05:00</option><option value='1'>05:30</option>
        <option value='6'>06:00</option>
        </select>
        </div>


        </B></td>
</tr>





<tr><td><B><div class='select2-purple'>
        <select name='".$jourmat3."'   class='form-control select2' style='width: 100%;'>
        <option value='0'>Choisir un jour</option>
        <option value='1'>Lundi</option><option value='2'>Mardi</option><option value='3'>Mercredi</option>
        <option value='4'>Jeudi</option><option value='5'>Vendredi</option><option value='6'>Samedi</option>
        <option value='7'>Dimanche</option>
        </select>
        </div></B></td>
        <td><B> 
        <div class='select2-purple'>
        <select name='".$hdeb3."'   class='form-control select2' style='width: 100%;'>
       
        <option value='1'>08:00</option><option value='2'>09:00</option><option value='3'>10:00</option>
        <option value='4'>11:00</option><option value='5'>12:00</option><option value='6'>13:00</option>
        <option value='7'>14:00</option><option value='4'>15:00</option><option value='5'>16:00</option>
        <option value='6'>17:00</option><option value='4'>17:30</option>
        <option value='4'>18:00</option><option value='4'>18:30</option><option value='5'>19:00</option>
        </select>
        </div>
        </B></td>
        
        <td><B> 
        <div class='select2-purple'>
        <select name='".$hduree3."'   class='form-control select2' style='width: 100%;'>
       
        <option value='1'>01:00</option><option value='1'>01:30</option>
        <option value='2'>02:00</option><option value='3'>02:30</option>
        <option value='4'>03:00</option><option value='5'>03:30</option>
        <option value='6'>04:00</option><option value='1'>04:30</option>
        <option value='6'>05:00</option><option value='1'>05:30</option>
        <option value='6'>06:00</option>
        </select>
        </div>


        </B></td>
</tr>




</table></div>

<!--fin matiere1--></Br>";
}
?>



 



 

</div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

     
  </div>
  <!-- /.content-wrapper -->

   <!-- Main Footer --></br></br></br></br>
   <footer class="main-footer">
  
    <div class="btn-group w-100 mb-2">
     
    <a class="btn btn-danger" href="repetition.php" data-filter="2"><<  retour</a>
    <button type="submit" name="confirmerdmd" class="btn btn-success" value="send"> suivant >></button>
     
     
    </div>
     



      
   
    


     </footer>

    
     </form>
  





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
            <h4 class="modal-title">Les matières choisies</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <p><div class="form-group">
            <b>   
            <?php
            echo "Classe : ".nomclasse($_SESSION['classesouh'])."</br>";
   for($i=0;$i<$_SESSION['total'];$i++){
    echo nomatiere($_SESSION['tabmat'][$i])."</br>";
   }
   
echo "Lieu souhaité : ".$_SESSION['ortsouh']."</br>";
           echo "Le moment souhaité pour commencer : ".momentsouh($_SESSION['periodesouh'])."<br>
            Genre de préférence : ".genre($_SESSION['genresouh'])."<br>";
            ?>  </b>    </p>
          </div>
          <div class="modal-footer justify-content-between">


             
               
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
            <h4 class="modal-title">Téléchargement du cours</h4>
             
            <form action='executereq.php' method='POST'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<div class="modal-body">
            <p><div class="form-group">
            <i class="far fa-file-pdf"></i><a href="#">Télécharger uniquement cette leçon</a> </br>
            <i class="far fa-file-pdf"></i><a href="#">Télécharger tout ce chapitre </a> </br>
            <i class="far fa-file-pdf"></i><a href="#">Télécharger tous les chapitres</a>  </br> 
                 
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
