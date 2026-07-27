<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenusgerer.php'; require 'lesfunctions.php'; 
$bloc=1;$actif=$bloc; $pageactif=1;
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=11; $newp=1;

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
 if(isset($_GET['idchapitre'])){
    $_SESSION['idchapitreorg']=$_GET['idchapitre']; 
     
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
  if(isset($_GET['idlecon'])){
    $_SESSION['idleconbild']=$_GET['idlecon']; 
    $_SESSION['nomleconbild']=nomlecon($_SESSION['idleconbild']);  
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
  <title>Organiser les exercices </title>

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
      <?php  echo "<form action='organiser3.php' method='POST'>"; ?>
     <button type="submit" class="btn"  style='color:white';>
      <i class="fas fa-arrow-left text-muted"></i>
    </button>
     </form> 
    </li>
      <li class="nav-item">
        <a href="#" class="nav-link"><B><?php // echo logo();?></B></a>
      </li>
       
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
       
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
   

       

      <li class="nav-item dropdown">
        <a class="btn btn-success"  data-toggle='modal'   data-target='#modajout'>
          + Ajouter
        </a>


        



        <?php  echo "<div class='modal fade' id='moda'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Modification/Suppression  </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <b>  <?php  echo  $_SESSION['nomclasseorg2'] ; ?></b></br>
      <b>  <?php  echo  $_SESSION['nomatiereorg2'] ; ?></b></br>
      <b>  Chapitre <?php  ?></b></br>
      <b>  <?php  echo nomchap($_SESSION['idchapitreorg']);  ?></b>
      <b>  leçon <?php  echo  $order ; ?></b></br>
      <b>  <?php  echo  $nomlecon ; ?></b></br>
      <?php   echo $msgpdf." , ".$msgimg;?>
      </div>        
  </br> 
  <div class="modal-body">
  <form action='executereq.php' method='POST'> 
    <input name='modlec' value="<?php echo $nomlecon; ?>" class='form-control'>
  </br>Ordre </br>
  
  <input name='orlec' value="<?php echo $order; ?>" class='form-control'>
  </br>
  <button type="submit" name="engmodlec" value="<?php echo $idlecon; ?>" class="btn btn-primary">Modifier</button>
      
     
  </br></br>  
  <b>Voulez-vous vraiment supprimer cette leçon ?</b>           
  </br><b>   </b>
  </div>
      <div class="modal-footer justify-content-right">
      
      <form action='executereq.php' method='POST'>
       <button type="submit" name="supleconpdf" value="<?php echo $idlecon; ?>" class="btn btn-danger"><i class="far fa-file-pdf"></i> Supprimer le pdf</button> 
      <button type="submit" name="suplecon" value="<?php echo $idlecon; ?>" class="btn btn-danger">Supprimer tout</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
            <h1 class="m-0">Organiser les exercices</h1>
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
      <?php    

echo "<div class='card card-solid'>
<div class='card-body pb-0'>
<center><b>
Chapitre ".ordchap($_SESSION['idchapitreorg'])."  : ".nomchap($_SESSION['idchapitreorg'])."
<br>
Leçon ".ordlecon($_SESSION['idleconbild'])."  : ".$_SESSION['nomleconbild']."
</b> </center> 
</div> 
</div><form action='executereq.php' method='POST'>";
$v="SELECT * FROM exercice WHERE idlecon='".$_SESSION['idleconbild']."' ORDER BY texte";
$reponse = $bdd->query($v);
$i=1;
while ($donnees = $reponse->fetch() )
{
  $idleconimg=$donnees['idexo'];
  $nomorig=" ";
  $nomnew=$donnees['image'];
  $order=$donnees['texte'];
  $ligne='ligne'.$i;   $chpid='chpid'.$i;
    $modadang1='modaal-danger'.$i;
      echo "<div class='card card-solid'>
        <div class='card-body pb-0'>
        <center> <div style='display:none';><input name='".$chpid."' value='".$idleconimg."'></div>
        <div class='btn-group w-100 mb-2'>
        
        <button class='btn btn-danger' type='submit'  name='deletebildexo' value='".$idleconimg."'>Supprimer</button>
        <button class='btn btn-primary' type='button'>Numéro</button>
        <input name='".$ligne."' value='".$order."'>
       
        </div></br><img src='exercice/".$nomnew."' height='700px' width='380px'> 
      </center> 
        </div> 
      </div>";
     $i++;
    } 
    $reponse->closeCursor();    
      ?> 
       

       
        <!-- Small Box (Stat card) -->
        
          </br>  
         <h5 class='mb-2 mt-4'> </h5> </br> 
  
  
         <div class='card card-solid'>
         <div class='card-body pb-0'>
         <div class='row'>
           
   
</div>
        <!-- /.row -->
        </div></div>
        
        <!-- =========================================================== -->

        <?php 
      
         ?>
 
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
     
      echo "<a class='btn btn-secondary' href='#' data-filter='3'> ".$_SESSION['nomatiereorg2']." en ".$_SESSION['nomclasseorg2']."</a>
      <button class='btn btn-success' name='subimagexo' value='".$i."' type='submit'>Enregistrer les numéros</button>";
     
     ?>
       </form>                 
    </div>
    <strong> </strong>  
  </footer>



  <?php  echo "<div class='modal fade' id='modajout'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Ajouter les images des exercices </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action='executereq.php' method='POST' enctype='multipart/form-data'>
      <b>
      <?php  echo "Chapitre ".ordchap($_SESSION['idchapitreorg'])."  : ".nomchap($_SESSION['idchapitreorg'])."
<br>
Leçon ".ordlecon($_SESSION['idleconbild'])."  : ".$_SESSION['nomleconbild']."<br>
<div class='form-group'>
 Choisir des images</div> <div class='form-group'>
    <input type='file' name='fichimg[]' multiple='multiple'>
    <p class='help-block'>Max. 8MO par image</p>
  </div> 
";
 ?> 
      </b> 
      </div>        
  </br> 
  
      <div class="modal-footer justify-content-right">
      
      
       <button type="submit" name="ajtimgeexo" value=" " class="btn btn-primary"> Ajouter les images</button> 
      
        </div></form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




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
