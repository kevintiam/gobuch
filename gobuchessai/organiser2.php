<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenusgerer.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenusgerer.php'; require 'lesfunctions.php'; 
$bloc=1;$actif=$bloc; $pageactif=1;
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=10; $newp=1;

if($numpagepreced==0 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="index.php";
}

try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
 if(isset($_GET['idklasse'])){
    $_SESSION['idclasorg2']=$_GET['idklasse']; 
    $_SESSION['nomclasseorg2']=nomclasse($_SESSION['idclasorg2']);  
  }

if(isset($_GET['idmatorg'])){
  $_SESSION['idmatorg2']=$_GET['idmatorg']; 
  $_SESSION['nomatiereorg2']=nomatiere($_SESSION['idmatorg2']);
}

if(isset($_GET['rechidmatorg'])){
    $_SESSION['idmatorg2']=$_GET['rechidmatorg']; 
    $_SESSION['nomatiereorg2']=nomatiere($_SESSION['idmatorg2']);
  }

if(isset($_GET['idclas'])){
    $_SESSION['idclasorg2']=$_GET['idclas']; 
    $_SESSION['nomclasseorg2']=nomclasse($_SESSION['idclasorg2']);  
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

if($_SESSION['numorg']==8){
    $idtypenseig=1;
  }


?>    
    <?php  
    $admin=verifadmin($_SESSION['gouser'],$_SESSION['gomot']);
    if($admin!=0){?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Organiser les chapitres </title>

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
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
      <?php  echo "<form action='organiser.php' method='POST'>"; ?>
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
       
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
   

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
           
          Les matières
          <!--span class="badge badge-warning navbar-badge">15</span-->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" style="color:blue;">Choisir une matière</span>
          
          <?php  
           
           $lsql="SELECT * FROM estenseigne WHERE idclasse='".$_SESSION['idclasorg2']."'";
           $reponse = $bdd->query($lsql);
           $cpt=0; 
          while ($donnees = $reponse->fetch() )
          {
            $idm=$donnees['idmatiere'];
            $noma=nomatiere($idm);
            $cpt++;
               echo "<div class='dropdown-divider'></div>
               <a href='organiser2.php?rechidmatorg=".$idm."' class='dropdown-item'>
                 <i class='fas fa-file mr-2'></i> ".$noma."
                  
               </a>";
          }
          $reponse->closeCursor();
            ?>

           
          
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          
          Les classes
          <!--span class="badge badge-warning navbar-badge">15</span-->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" style="color:blue;">Choisir une classe</span>
          
          <?php  
           
           $lsql="SELECT * FROM classe  WHERE idtypenseig='".$idtypenseig."'  ORDER BY ordre";
           $reponse = $bdd->query($lsql);
           $cpt=0; 
          while ($donnees = $reponse->fetch() )
          {
            $idclasse=$donnees['idclasse'];
            $nomclasse=$donnees['nomclasse'];
            $cpt++;
               echo "<div class='dropdown-divider'></div>
               <a href='organiser2.php?idclas=".$idclasse."' class='dropdown-item'>
                 <i class='fas fa-file mr-2'></i> ".$nomclasse."
                  
               </a>";
          }
          $reponse->closeCursor();
            ?>

           
          
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Organiser les chapitres</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><b><?php echo $_SESSION['nomclasseorg2']; ?></b></li>
                <li class="breadcrumb-item"><b><?php echo $_SESSION['nomatiereorg2']; ?></b></li>
            </ol>
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      <div class="card card-solid">
        <div class="card-body pb-0">
        <center>
        <form action='executereq.php' method='POST'>  
          
         
      
       <b>Nouveau chapitre</b>
    <input name="newchap" class="form-control"></br>
    <b>Ordre</b>
    <input name="ordr" class="form-control"></br> 

        <div class='btn-group w-100 mb-2' >
      
      <button type='submit' name='ajnewchap' style='width: 100%; height: 5%;' class='btn btn-info active'>Ajouter</button>                  
                 
     </div></form> </center> 
        </div> 
      </div>
        <!-- Small Box (Stat card) -->
        
        <?php 
        
        $aller=existestenseigne($_SESSION['idclasorg2'],$_SESSION['idmatorg2']);
        
        echo "   </br>  
         <h5 class='mb-2 mt-4'>Les chapitres | ".$_SESSION['nomatiereorg2']." en ".$_SESSION['nomclasseorg2']."</h5> </br> 
  
  
         <div class='card card-solid'>
         <div class='card-body pb-0'>
         <div class='row'>
           
  
         ";
  $v="SELECT * FROM chapitre WHERE idestenseigne='".$aller."' ORDER BY ordre";

  $reponse = $bdd->query($v);
  $i=1;
  while ($donnees = $reponse->fetch() )
  {
    $idchapitre=$donnees['idchapitre'];
    $nomchap=$donnees['nomchapitre'];
    $order=$donnees['ordre'];
   
    $modo='#modaal-secondary'.$i;
    $modo1='modaal-secondary'.$i;

    $moda='#modaal-success'.$i;
    $moda1='modaal-success'.$i;

    $modadang='#modaal-danger'.$i;
    $modadang1='modaal-danger'.$i;

    $name="name".$i;

    echo " 
    <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='depensedetail.php?ID=63' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='card-header text-muted border-bottom-0'>
                     <h2 class='lead'><b>".$order." . ".$nomchap."</b></h2>
                 </div>
                 <div class='card-body pt-0'>
                   <div class='row'>         
                     <div class='col-7'>
                       <h2 class='lead' style='color:green';><b>".nbrelecon($idchapitre)." leçon(s) </b></h2>
                       <p class='text-muted text-sm'>";
                        
                      echo "
                      <h2 class='lead'>
                      <form action='executereq.php' method='POST'>
                      <div class='btn-group w-100 mb-2'>
                     <input name='orname' class='form-control' value='".$order."'>
                      <button class='btn btn-secondary' name='valider' value='".$idchapitre."' type='submit'>valider</button>
                      
                      </div></form></h2> 
                      
                      ";
                      
                       
                       echo " 
                       
                        </p>
                       <ul class='ml-4 mb-0 fa-ul text-muted'>
                         <li class='small'><span class='fa-li'>
                            </ul>
                     </div>
                     <div class='col-5 text-center'>
                        
                     </div>
                   </div>
                 </div>
                 <div class='card-footer'>
                 <div class='btn-group w-100 mb-2'>";
                 
                      echo " 
                      <button class='btn btn-success' type='button' data-toggle='modal'   data-target='".$modadang."'><i class='fas fa-pencil-alt'></i></button> ";
                  
                   echo  "<a class='btn btn-primary' href='organiser3.php?idchapitre=".$idchapitre."' data-filter='2'>Les leçons <i class='fas fa-arrow-circle-right'></i></a>
                                    
                </div>
                 </div>
               </div>
               <!--/a-->
             </div>
    
    ";
 




       ?>


 


<?php  echo "<div class='modal fade' id='".$modadang1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Suppression  </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <b>  <?php  echo  $_SESSION['nomclasseorg2'] ; ?></b></br>
      <b>  <?php  echo  $_SESSION['nomatiereorg2'] ; ?></b></br>
      <b>  Chapitre <?php  echo  $order ; ?></b></br>
      <b>  <?php  echo  $nomchap ; ?></b>
      </div>        
  </br> 
  <div class="modal-body">
  <form action='executereq.php' method='POST'> <input name='modchap' value="<?php echo $nomchap; ?>" class='form-control'>
  </br>Ordre </br>
  <input name='orchap' value="<?php echo $order; ?>" class='form-control'>
  </br><button type="submit" name="engmodchap" value="<?php echo $idchapitre; ?>" class="btn btn-primary">Modifier</button>
      
     
  </br></br>  
  <b>Voulez-vous vraiment supprimer ce chapitre ?</b>           
  </br><b>  Si vous le faites, toutes les leçons de ce chapitre seront supprimées</b>
  </div>
      <div class="modal-footer justify-content-right">
      
      
        <button type="submit" name="supchap" value="<?php echo $idchapitre; ?>" class="btn btn-danger">Supprimer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->





 







       
<?php 
      $i++;
  } 
  $reponse->closeCursor(); 
 
  ?>


   
 
  



           

         </div>
        <!-- /.row -->
        </div></div>
        
        <!-- =========================================================== -->


 
 <!-- =========================================================== -->



    </br></br></br></br>

       
 

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    </br></br></br></br></br> 

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
  <div class="btn-group w-100 mb-2">
       <?php  
     
      echo "<a class='btn btn-secondary' href='#' data-filter='3'> ".$_SESSION['nomatiereorg2']." en ".$_SESSION['nomclasseorg2']."</a>";
     
     ?>
                        
    </div>
    <strong> </strong>  
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
 
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
<?php  
     }
 if($admin==1){
   //  header('location:programmegen.php');
   }
     ?>
