<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';  if(!isset($_SESSION['wegonlinenum'])){ require 'lesmenusgerer.php'; }
 if(isset($_SESSION['wegonlinenum'])){ require 'lesmenus.php'; } 
require 'lesfunctions.php'; 
$bloc=4;$actif=$bloc; $pageactif=4;
 if(isset($_SESSION['wegonlinenum'])){
$bloc=5;$actif=$bloc; $pageactif=6;
 }

$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=1; $newp=1;
$_SESSION['nomprgm']=1;
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
 
if(isset($_GET['numdmd'])){
  $_SESSION['nodembetreuer']=$_GET['numdmd']; 
  
}
if(isset($_GET['jour'])){
    if($_GET['jour']>0){
  $_SESSION['idprogjr']=$_GET['jour']; 
    }
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
$admin=0; 
if(isset($_SESSION['wegonlinenum'])){
  $ensexist=verifensg($_SESSION['wegonlinenum']);
}
if(!isset($_SESSION['wegonlinenum'])){
     $admin=verifadmin($_SESSION['gouser'],$_SESSION['gomot']);
}
     if($admin!=0 OR isset($ensexist)){?>
  
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>gobuch -  emploi du temps</title>

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
  <script>




 function modetuteur(str){
       if(str==" "){
           document.getElementById("tuteur").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("tuteur").innerHTML=this.responseText;
               }
           };
           xmlhttp.open("POST","modetuteur.php?q="+str,true);
           xmlhttp.send();
       }
   }



 function conclure1(){
 document.emploi1.ensb.value=document.emploi1.day.value+"@"+document.emploi1.debut.value
+"@"+document.emploi1.duree.value+"@"+document.emploi1.matie.value;
document.getElementById("tot").value=document.getElementById("tau").value*document.getElementById("dure").value;
document.getElementById("totu").value=document.getElementById("tautu").value*document.getElementById("dure").value;
}


function trituteur(str){
         str= document.emploi1.day.value+"@"+document.emploi1.debut.value
+"@"+document.emploi1.duree.value+"@"+document.emploi1.matie.value
+"@"+document.emploi1.clax.value;  //  
       if(str==" "){
           document.getElementById("triteur").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("triteur").innerHTML=this.responseText;
               }
           };
            
           xmlhttp.open("POST","trituteur.php?q="+str,true);
           xmlhttp.send();
       }
   }





  


 

 function conclur0(){
  
         n=100;
for(j=0;j<n;j++){ 
  tot='tot'+j;  tau='tau'+j; durer='durer'+j;
  totu='totu'+j;  tautu='tautu'+j;
  
  /* ensb='ensb'+j; day='day'+j;    debut='debut'+j;  
    matie='matie'+j; 

 

document.getElementById(ensb).value=document.getElementById(day).value+"@"+document.getElementById(debut).value+"@"+
document.getElementById(durer).value+"@"+document.getElementById(matie).value;
*/

document.getElementById(tot).value=document.getElementById(tau).value*document.getElementById(durer).value;
document.getElementById(totu).value=document.getElementById(tautu).value*document.getElementById(durer).value;
}
}


  </script>

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
       
        <!--li class="nav-item">
      <?php  echo "<form action='mesdemandes.php' method='POST'>"; ?>
     <button type="submit" class="btn"  style='color:white';>
      <i class="fas fa-arrow-left text-muted"></i>
    </button>
     </form> 
    </li-->

     <li class="nav-item">
      <?php if(!isset($_SESSION['wegonlinenum'])){ echo "<form action='demandeacc.php' method='POST'>";}
      if(isset($_SESSION['wegonlinenum'])){ echo "<form action='#' method='POST'>";} ?>
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
      <li class='nav-item'>
      <a class='btn btn-info' href='emploivue.php' data-filter='2'> <b>Actualiser</b></a>
      </li> 
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
            <h1 class="m-0">Emploi du temps</h1>
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







<?php 
        
        
        
      



 
      if(isset($_SESSION['okengdmd'])){   
          if($_SESSION['okengdmd']==0){ 
          echo "<div class='btn-group w-100 mb-2'>
          <a class='btn btn-danger' href='#' data-filter='2'>Demande non enregistrée</a>
    </div>";
           $_SESSION['okengdmd']=2;    }
               if($_SESSION['okengdmd']==1){ 
                echo "<div class='btn-group w-100 mb-2'>
    <button type='submit' class='btn btn-success' value='send'>Votre demande a été enregistrée</button>
    </div>";
               $_SESSION['okengdmd']=2;     }
            } 

            
      ?>
<div class='card card-solid'>
  <div class='card-body pb-0'><b> <?php echo nomjour($_SESSION['idprogjr']);?>
   

  </b></br></br>








         <div class='row'>
  
            <table border='3'  class='table table-head-fixed text-nowrap'> 
        <?php   

       
    //    $lsql="SELECT * FROM estsollicitee  WHERE jourcours='".$_SESSION['idprogjr']."'  ORDER BY horairedeb";
    for($ph=1;$ph<=14;$ph++){
        echo  "<tr><td bgcolor='#70DBDB'><B>".nomheure($ph)."</B></td>";
     
    $lsql="SELECT * FROM estsollicitee INNER JOIN demande ON estsollicitee.idemande=demande.idemande  WHERE horairedeb='".$ph."' AND jourcours='".$_SESSION['idprogjr']."' ";
       if(isset($_SESSION['wegonlinenum'])){
  $lsql="SELECT * FROM estsollicitee INNER JOIN demande ON estsollicitee.idemande=demande.idemande  WHERE idenseign='".$_SESSION['wegonlinenum']."' AND  horairedeb='".$ph."' AND jourcours='".$_SESSION['idprogjr']."' ";
    
}   
    
    $reponse = $bdd->query($lsql);
           $reponse = $bdd->query($lsql);
           $cpt=0;  
          while ($donnees = $reponse->fetch() )
          {

             $mode='#modaal-secondary'.$cpt;
    $mode1='modaal-secondary'.$cpt;
        
            $idestsollicitee=$donnees['idestsollicitee'];
             $idemande=$donnees['idemande'];
            $idenseign=$donnees['idenseign'];
            $idmatiere=$donnees['idmatiere'];
            $duree=$donnees['duree']+0;
            $horairedeb=$donnees['horairedeb'];
              $ijourcours=$donnees['jourcours'];
               $th=$donnees['th']+0;
            $decision=$donnees['decision']; //O POUR ACTIF 1 POUR PASSER
              $montant=$donnees['montant']+0;
               $montantens=$donnees['montantensei']+0;
               $thens=$donnees['tauxensei']+0;
               $decisionsea=lastsean($idestsollicitee); $decsean=" ";
               if($decisionsea==1){  $decsean="<span class='badge bg-warning'>En cours</span>";}    if($decisionsea==2){ $decsean="<span class='badge bg-secondary'>Terminée</span>";}  
// data-target='".$mode."'
     echo "<td>
      <b>
       ".$decsean."  </br> 
      Jour : <span class='badge bg-success'>".nomjour($ijourcours)."</span> <br> 
        Heure prévue : <span class='badge bg-info'>".nomheure($horairedeb)."</span><br> 
        Lieu : ".$donnees['lieusouh']."<br>
 
       Durée prévue : <span class='badge bg-primary'>".nomduree($duree)." heure.s</span><br>
     Tuteur.e : ".completname($idenseign)."<br>  ";
        if(isset($_SESSION['wegonlinenum'])){
echo "Taux horaire : ".$thens." FCFA <br>";
        }
 /*
Matière : ".nomatiere($idmatiere)."<br>
Classe : ".nomclasse($donnees['idclasse'])."<br>

echo "Taux horaire payé par le demandeur : <br>".$th." FCFA <br>
Montant total payé par le demandeur : <br> ".$montant." FCFA <br> 
Taux horaire à recevoir par le tuteur : <br>".$thens." FCFA <br>
Montant total  à recevoir par le tuteur : <br> ".$montantens." FCFA <br>";
*/
echo "Etat de l'emploi du temps : ".actifemploi($decision)."<br>";
echo  "<small>Numéro de l'emploi du temps : ".$idestsollicitee."</small></br>
<small>Numéro de la demande : ".$idemande."</small></br>";
            
  

      echo " </b>"; 
  
    $ensba=$idemande."@".$idestsollicitee;      
            
          echo "</br>";
           if($decisionsea==1){ 
     echo "&nbsp &nbsp   <a href='emploivuech.php?ensb=".$ensba."' style='color:black'; class='btn btn-warning'><i>Suivre</i>&nbsp &nbsp &nbsp</a>"; 
        }
        if($decisionsea==2 OR $decisionsea==0){ 
     echo "&nbsp &nbsp   <a href='emploivuech.php?ensb=".$ensba."' style='color:white'; class='btn btn-secondary'><i>Commencer</i>&nbsp &nbsp &nbsp</a>"; 
        }
      echo "</td>";
$conclur="conclur".$cpt."()";
?>


 


 

 <?php 

           $cpt++;  
          }
          $reponse->closeCursor();
 echo  "  </tr>";
           }
          ?> <!-- ./col -->
 </table>  
</div> 
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

  <!--footer class="main-footer">
  <div class="btn-group w-100 mb-2">
     <a class="btn btn-secondary" href="repetition.php" data-filter="2"><span class="fas fa-users"></span> Demander l'accompagnement d'un expert</a>
     <?php  
     $admin=0;
      
     ?>
                        
    </div>
    <strong> </strong>  
  </footer-->
 
<nav class="main-header navbar navbar-expand navbar-dark">
  <footer class="main-footer">
   <div class="btn-group w-100 mb-2">
    <?php   echo"<a class='btn btn-success' type='button' data-toggle='modal'   data-target='#emploi'><small> Emploi du temps</small></a>

                     
  ";              
     ?>  
    </div>
   </footer>
   </nav>



  <?php   echo "<div class='modal fade' id='emploi'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Afficher l'emploi du temps</h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <form action='#' method='POST'  enctype='multipart/form-data'>
  <?php 
   
       echo " <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=1' class='dropdown-item'>
          <b>Lundi</b></a>
          <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=2' class='dropdown-item'>
          <b>Mardi</b></a>
          <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=3' class='dropdown-item'>
          <b>Mercredi</b></a>
          <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=4' class='dropdown-item'>
          <b>Jeudi</b></a>
          <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=5' class='dropdown-item'>
          <b>Vendredi</b></a>
          <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=6' class='dropdown-item'>
          <b>Samedi</b></a>
          <div class='dropdown-divider'></div>
          <a href='emploivue.php?jour=7' class='dropdown-item'>
          <b>Dimanche</b></a>
          ";  
            
  
 
            ?>
  </br>
      
     
  
  </div>
      <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
       </form></div>
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