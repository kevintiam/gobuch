<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*require 'connectC.php';  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';  require 'lesmenusgerer.php'; require 'lesfunctions.php';
$bloc=3;$actif=$bloc; $pageactif=3;
if(isset($_GET['idcours'])){
  $_SESSION['idmatierex']=$_GET['idcours'];
  $_SESSION['nomatierex']=nomatiere($_SESSION['idmatierex']);
}
 
if(isset($_GET['idcoursmat'])){
  $_SESSION['idmatierex']=$_GET['idcoursmat'];
  $_SESSION['nomatierex']=nomatiere($_SESSION['idmatierex']);
}

if(isset($_GET['idsession'])){
  $_SESSION['idsessionx']=$_GET['idsession'];
  $_SESSION['nomsessionx']=nomsession($_SESSION['idsessionx']);
  
}
 
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=5; $newp=2;

if($numpagepreced==1 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="programmegen.php";
}
if($numpagepreced==0 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="index.php";
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
?>




<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo "Examens ".$_SESSION['nomatierex']." ".$_SESSION['nomclassec'];?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
      <?php  echo "<form action='examensgenadm.php' method='POST'>"; ?>
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
    

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-search"></i> Choisir une autre matière
           
          <!--span class="badge badge-warning navbar-badge">15</span-->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" style="color:blue;">Choisir une autre matière</span>
          <?php  
        $v="SELECT * FROM estenseigne WHERE idclasse='".$_SESSION['classec']."'";
        $reponse = $bdd->query($v);
        
        while ($donnees = $reponse->fetch()){
          $idestenseigne=$donnees['idestenseigne'];
          $idmatiere=$donnees['idmatiere'];
          $nomatiere=nomatiere($idmatiere);
            
            
            echo "<div class='dropdown-divider'></div>
            <a href='examensgen2adm.php?idcoursmat=".$idmatiere."' class='dropdown-item'>
            <b> ".couperchap($nomatiere)."</b>
               
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
    <section class="content"><h2><B>Sujets d'examens</B></h2></Br>
       <!-- Default box -->
       <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
  
          <?php
 
 $i=1; $total=0;


 $lecon="SELECT * FROM session  ORDER BY ordre DESC";
 $replecon = $bdd->query($lecon);
 
 while ($donlecon = $replecon->fetch()){
   $idsession=$donlecon['idsession'];
   $nomsession=$donlecon['nomsession'];
    
    
   $order=$donlecon['ordre'];
   $nom="examenpdf/exampdf".$_SESSION['idmatierex']."-".$_SESSION['classec']."-".$idsession.".pdf";
  
   if(file_exists($nom)!=0){ 
    $supexam="#supexam".$i;
    $supexam2="supexam".$i;
   echo " 
   <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
           <!--a href='depensedetail.php?ID=63' class='nav-link'-->
            <div class='card bg-light d-flex flex-fill'>
                <div class='card-header text-muted border-bottom-0'>
                    <h2 class='lead'><b>". $_SESSION['nomatierex']."</b></h2>
                </div>
                <div class='card-body pt-0'>
                  <div class='row'>         
                    <div class='col-7'>
                      <h2 class='lead' style='color:green';><b>".$_SESSION['nomclassec']." </b></h2>
                      <p class='text-muted text-sm'>";
                       
                     echo "
                     <h2 class='lead'><i class='far fa-calendar-alt'></i><b> Session : ".$nomsession."</b></h2> 
                     
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
                $admin=0;
                if($admin==0){
                     echo " 
                     <button class='btn btn-danger' type='button' data-toggle='modal'   data-target='".$supexam."'><i class='fas fa-trash'></i> Supprimer</button> ";
                }
                  echo  "<a class='btn btn-success' href='executereq.php?idsessiongp=".$idsession."' data-filter='2'><span class='fas fa-download'></span> Télécharger</a>
                                   
               </div>
                </div>
              </div>
              <!--/a-->
            </div>
   
   ";







   echo "<div class='modal fade' id='".$supexam2."'>
   <div class='modal-dialog'>
     <div class='modal-content '>
     <div class='modal-header'>
         <h4 class='modal-title'>Supprimer cette épreuve</h4>
          
         <form action='executereq.php' method='POST'>
         <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
         </button>
       </div>
       <div class='modal-body'>
       
        <div class='form-group'>
            <label for='inputSpentBudget'>  
            ".$_SESSION['nomatierex']."-".$_SESSION['nomclassec']."- session ".$nomsession.".pdf</br>
             Voulez-vous vraiment supprimer cette épreuve ?</label>
                 
               </div>
 
   
              
       </div>
       <div class='modal-footer justify-content-between'>
               <button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>";
                echo "<button type='submit' name='supexamadm' class='btn btn-danger' value='".$idsession."'>Supprimer</button>
          </div>
     </div></form>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 <!-- /.modal modif -->";








  }
$i++;

  }
  $replecon->closeCursor(); 
  ?>


          
 
          </div>
        </div>
         
      </div>
      <!-- /.card -->
      </br></br></br></br>



      
      
     




      


</br></br></br></br>
    </section>
    <!-- /.content -->
    </br></br></br></br></br></br></br>

     
  </div>
  <!-- /.content-wrapper -->

   <!-- Main Footer --></br></br></br></br></br></br></br>

   <footer class="main-footer">
  
    <div class="btn-group w-100 mb-2">
     
     <a class="btn btn-secondary" href="repetition.php" data-filter="2"><span class="fas fa-users"></span> Demander l'accompagnement d'un expert</a>
 
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
            <textarea id="compose-textarea" name="note" class="form-control" style="height: 300px"><?php echo note($_SESSION['idleconc'],1);?></textarea>  
                </p>
          </div>
          <div class="modal-footer justify-content-between">


             
              <button type="submit" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button  type="submit" name="enregnote"  value="<?php echo idnote($_SESSION['idleconc'],1);?>" class="btn btn-primary">Enregistrer</button>
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
            <i class="far fa-file-pdf"></i><?php echo "
            <a href='executereq.php?telechlecon=".$_SESSION['idleconc']."' 
           >Télécharger uniquement cette leçon</a>" ; ?> </br>
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
