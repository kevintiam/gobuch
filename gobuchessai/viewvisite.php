<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenusgerer.php'; require 'lesfunctions.php'; 
$bloc=5;$actif=$bloc; $pageactif=5;
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=1; $newp=1;
$_SESSION['numprgm']=1;
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
if(isset($_GET['idclasse'])){
  $_SESSION['classec']=$_GET['idclasse']; 
  $_SESSION['nomclassec']=nomclasse($_SESSION['classec']);  
}

if(isset($_POST['rechclasse'])){
  $_SESSION['classec']=$_POST['choixclasse']; 
  $_SESSION['nomclassec']=nomclasse($_SESSION['classec']);
}

if(!isset($_SESSION['reqbesuch'])){
$_SESSION['datebesuch']=date('Y.m.d');
}

if(!isset($_SESSION['reqpost'])){
$_SESSION['reqpost']=0;
}

if(isset($_POST['envoi'])){
  // $_SESSION['datebesuch']=$_POST['datedeb'];
  $aasd=$_POST['datdeb'];
  $pa=array();
  $pa=explode("-",$aasd);
  $_SESSION['datebesuch']=$pa[0].".".$pa[1].".".$pa[2];
  $_SESSION['reqpost']=0;
}

if(isset($_POST['envoipe'])){
  // $_SESSION['datebesuch']=$_POST['datedeb'];
  $_SESSION['reqpost']=1;
  $aasd=$_POST['datpdeb'];
  $pa=array();
  $pa=explode("-",$aasd);
  $_SESSION['datepbesuchd']=$pa[0].".".$pa[1].".".$pa[2];

  $fasd=$_POST['datpfin'];
  $fa=array();
  $fa=explode("-",$fasd);
  $_SESSION['datepbesuchf']=$fa[0].".".$fa[1].".".$fa[2];
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
<?php  
     $admin=verifadmin($_SESSION['gouser'],$_SESSION['gomot']);
     if($admin!=0){?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>gobuch - consulter les visites</title>

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
        <a href="#" class="nav-link"><B><?php echo logo();?></B></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
       
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
   
      <!--li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="nav-icon fas fa-th"></i>
          Les classes
          <!--span class="badge badge-warning navbar-badge">15</span-->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" style="color:blue;">Choisir une classe</span>
          
          <?php  
           
           $lsql="SELECT * FROM classe  WHERE idtypenseig='1'  ORDER BY ordre";
           $reponse = $bdd->query($lsql);
           $cpt=0; 
          while ($donnees = $reponse->fetch() )
          {
            $idclasse=$donnees['idclasse'];
            $nomclasse=$donnees['nomclasse'];
            $cpt++;
               echo "<div class='dropdown-divider'></div>
               <a href='programmegen.php?idclasse=".$idclasse."' class='dropdown-item'>
                 <i class='fas fa-file mr-2'></i> ".$nomclasse."
                  
               </a>";
          }
          $reponse->closeCursor();
            ?>

           
          
        </div>
      </li-->


       
       
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
            <h1 class="m-0">Les visites</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
             
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
   <section class="content">
      <div class='container-fluid'>
        <div class='card card-solid'>
         <div class='card-body pb-0'>
         <div class='row'>
   <?php
     
      ?>

        <?php   
       /*   */ 
       
      



























if($_SESSION['reqpost']==0){ 
  $effectifsans=nbreverbinden($_SESSION['datebesuch'],0); // SANS MOI
       $effectifavec=nbreverbinden($_SESSION['datebesuch'],1); // SANS MOI
        $pagesans=pagesvisites($_SESSION['datebesuch'],0); // SANS MOI
       $pageavec=pagesvisites($_SESSION['datebesuch'],1); // SANS MOI

       
       echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <a href='infolieu.php' class='nav-link'>
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-success'>
<b>".format($_SESSION['datebesuch'])."  </br>visite.s du jour sans les admins 
</br>hors mis cet appareil</br>".$effectifsans."</b>
</div> 
</div></a></div>";

echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='insertvumoyan.php?vu=0' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-info'>
<b>".format($_SESSION['datebesuch'])."  </br>visite.s du jour sans les admins 
</br>y compris cet appareil</br>".$effectifavec."</b>
</div> 
</div><!--/a--></div>";

echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='insertvumoyan.php?vu=0' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-danger'>
<b>".format($_SESSION['datebesuch'])." </br>page.s visitée.s sans les admins </br>
hors mis cet appareil :  ".$pagesans."
</br>y compris cet appareil : ".$pageavec."</b>
</div> 
</div><!--/a--></div>";
}

if($_SESSION['reqpost']==1){ 
  $effectifgpesans=periodverbinden($_SESSION['datepbesuchd'],$_SESSION['datepbesuchf'],0); // SANS MOI
   $effectifgpeavec=periodverbinden($_SESSION['datepbesuchd'],$_SESSION['datepbesuchf'],1); // SANS MOI
    $pagegpesans=pagesgpevisites($_SESSION['datepbesuchd'],$_SESSION['datepbesuchf'],0); // SANS MOI
      $pagegpeavec=pagesgpevisites($_SESSION['datepbesuchd'],$_SESSION['datepbesuchf'],1); // SANS MOI

       
       echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='infolieu.php' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-success'>
<b>Du ".format($_SESSION['datepbesuchd'])." Au  ".format($_SESSION['datepbesuchf'])."</br>visite.s du jour sans les admins 
</br>hors mis cet appareil</br>".$effectifgpesans."</b>
</div> 
</div><!--/a--></div>";

echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='insertvumoyan.php?vu=0' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-info'>
<b>Du ".format($_SESSION['datepbesuchd'])." Au  ".format($_SESSION['datepbesuchf'])." </br>visite.s du jour sans les admins 
</br>y compris cet appareil</br>".$effectifgpeavec."</b>
</div> 
</div><!--/a--></div>";

echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='insertvumoyan.php?vu=0' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-danger'>
<b>Du ".format($_SESSION['datepbesuchd'])." Au  ".format($_SESSION['datepbesuchf'])."  </br>page.s visitée.s sans les admins </br>
hors mis cet appareil :  ".$pagegpesans."
</br>y compris cet appareil : ".$pagegpeavec."</b>
</div> 
</div><!--/a--></div>";
}



     
          
        echo "</div></div></div></div> </section> " ; 


          echo "<section class='content'>
      <div class='container-fluid'>
 
        <div class='row'>";
$ensb=useronline();
$tab=array();
$tab=explode("-",$ensb); $all=$tab[0];  $nonid=$tab[1]; $kunde=$tab[2]; $webmast=$tab[3];
 
echo " <div class='col-md-3 col-sm-6 col-12'>
            <div class='info-box bg-gradient-warning'>
              <span class='info-box-icon'><i class='far fa-thumbs-up'></i></span>

              <div class='info-box-content'>
                <span class='info-box-text'> En ligne actuellement</span>
                <span class='info-box-number'>Total : ".$all."</span>

                <!--div class='progress'>
                  <div class='progress-bar' style='width: 30%'></div>
                </div-->
                <!--span class='progress-description'>
                  70% Increase in 30 Days
                </span-->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->" ; 

          echo " <div class='col-md-3 col-sm-6 col-12'>
            <div class='info-box bg-gradient-danger'>
              <span class='info-box-icon'><i class='far fa-bookmark'></i></span>

              <div class='info-box-content'>
                <span class='info-box-text'> En ligne actuellement</span>
                <span class='info-box-number'>Non identifiés : ".$nonid."</span>

                <!--div class='progress'>
                  <div class='progress-bar' style='width: 30%'></div>
                </div-->
                <!--span class='progress-description'>
                  70% Increase in 30 Days
                </span-->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->" ; 

          echo " <div class='col-md-3 col-sm-6 col-12'>
            <div class='info-box bg-gradient-info'>
              <span class='info-box-icon'><i class='fas fa-user-plus'></i></span>

              <div class='info-box-content'>
                <span class='info-box-text'> En ligne actuellement</span>
                <span class='info-box-number'>Clients identifiés : ".$kunde."</span>

                <!--div class='progress'>
                  <div class='progress-bar' style='width: 30%'></div>
                </div-->
                <!--span class='progress-description'>
                  70% Increase in 30 Days
                </span-->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->" ; 

          echo " <div class='col-md-3 col-sm-6 col-12'>
            <div class='info-box bg-gradient-primary'>
              <span class='info-box-icon'><i class='far fa-star'></i></span>

              <div class='info-box-content'>
                <span class='info-box-text'> En ligne actuellement</span>
                <span class='info-box-number'>Administrateurs : ".$webmast."</span>

                <!--div class='progress'>
                  <div class='progress-bar' style='width: 30%'></div>
                </div-->
                <!--span class='progress-description'>
                  70% Increase in 30 Days
                </span-->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->" ; 
      
      
          ?> <!-- ./col -->


           
           

          

        
        <!-- =========================================================== -->


 
 <!-- =========================================================== -->



    </br></br></br></br>

       
 
</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    </br></br></br></br></br> 

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
  <div class="btn-group w-100 mb-2">
    <a class="btn btn-success" href='viewvisite.php'   data-filter='2'> <small>Actualiser</small></a>
    <a class="btn btn-secondary" type='button' data-toggle='modal' data-target='#rechercher' data-filter='2'> <small>autre date </small></a>
     <a class="btn btn-info" href='infolieu.php'   data-filter='2'> <small>localisation des pages</small></a>
    
     <?php  
     $admin=0;
      
     ?>
  </div>
 </footer>













<?php  echo "<div class='modal fade' id='rechercher'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Choisir une autre date</h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
   <form action='viewvisite.php' method='POST'>
  <label for='exampleInputPassword1'> Date</label>
    <div class='input-group mb-3'>
    <?php echo "<input name='datdeb'   class='form-control' type='date'></br></br>";
    
    echo "<div class='btn-group w-100 mb-2'>
     <button type='submit' name='envoi' class='btn btn-primary'> <i class='fas fa-search'></i> Valider</button>
   </div>";
    
    ?></div></form>

</br><b>Sur une periode</b></br>
 <form action='viewvisite.php' method='POST'>
   
   <div class='input-group mb-3'><input value='Du' disabled='disabled'  class='form-control'>
  <input value='Au' disabled='disabled'  class='form-control'></div>
    <div class='input-group mb-3'>
       
    <?php echo "<input name='datpdeb'   class='form-control' type='date'></br></br>";
     echo "<input name='datpfin'   class='form-control' type='date'></br></br>";
    echo "<div class='btn-group w-100 mb-2'>
     <button type='submit' name='envoipe' class='btn btn-secondary'> <i class='fas fa-search'></i> Valider</button>
   </div>";
    
    ?></div></form>


     </div>
           
            
  </br>
      
     
  
  </div>
      <div class="modal-footer justify-content-right">
      
       </div>
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
    }?>