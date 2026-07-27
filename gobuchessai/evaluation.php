<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenus.php'; require 'lesfunctions.php'; 
$bloc=3;$actif=$bloc; $pageactif=3;
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=6; $newp=1;

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
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Enseignement général evaluations</title>

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
    function modepaye(str){
       if(str==" "){
           document.getElementById("modepaye").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("modepaye").innerHTML=this.responseText;
               }
           };
           xmlhttp.open("POST","modepaye.php?q="+str,true);
           xmlhttp.send();
       }
   }


   function modetab(str){
       if(str==" "){
           document.getElementById("modetab").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("modetab").innerHTML=this.responseText;
               }
           };
           xmlhttp.open("POST","modetab.php?q="+str,true);
           xmlhttp.send();
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
        <a class="nav-link"  href="#">
        <i class='nav-icon fas fa-chart-pie'></i>
          Evaluations
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
               <a href='examensgen.php?idclasse=".$idclasse."' class='dropdown-item'>
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
            <h1 class="m-0">Evaluations</h1>
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
      <?php if($_SESSION['respenvoi']==1){echo "  
      <div class='card card-solid'>
        <div class='card-body pb-0'>
        <center>

       
          
            <div class='alert alert-success alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h5><i class='icon fas fa-check'>Enregistré avec succès</i> 
                             </h5>
              </div>
          
          

          </center> 
        </div> 
      </div>"; $_SESSION['respenvoi']=0;}?>
     
        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><a href="evaluation.php" class="text-black">Enseignement général</a></h5>
        <div class="row">
          




        <?php $j=0;   $p=0;
        
        
        
        $v="SELECT * FROM classe  WHERE idtypenseig='1'  ORDER BY ordre";
        $reponse = $bdd->query($v);
        
        while ($donnees = $reponse->fetch()){
          $idclasse=$donnees['idclasse'];
          $nomclasse=$donnees['nomclasse'];
          $moda='#modaal-success'.$p;
          $moda1='modaal-success'.$p;
$j++;
if($j>=1){ 

    if($j%12==1){
        $color='small-box bg-info';
    }
    if($j%12==2){
        $color='small-box bg-success';
    }
    if($j%12==3){
        $color='small-box bg-warning';
    }
    if($j%12==4){
        $color='small-box bg-danger';
    }
    if($j%12==5){
        $color='small-box bg-primary';
    }
    if($j%12==6){
        $color='small-box bg-secondary';
    }
    if($j%12==7){
        $color='small-box bg-info';
    }
    if($j%12==8){
        $color='small-box bg-success';
    }
    if($j%12==9){
        $color='small-box bg-danger';
    }
    if($j%12==10){
        $color='small-box bg-warning';
    }
    if($j%12==11){
        $color='small-box bg-success';
    }
    if($j%12==0){
        $color='small-box bg-secondary';
    }
        echo "<div class='col-lg-3 col-6'>
            <!-- small card -->
            <div class='".$color."'>
            <a href='#' class='small-box-footer' type='button' data-toggle='modal'   data-target='".$moda."'>         <div class='inner'>
                   <h5>&nbsp".$nomclasse."</h5>

                <p><b> &nbsp&nbsp </b></p>
                  </div>   </a>
              <div class='icon'>
                 
              </div> 
              <a href='#' class='small-box-footer' type='button' data-toggle='modal'   data-target='".$moda."'>
              Choisir une matière <i class='fas fa-arrow-circle-right'></i>
              </a> 
               ";


          
          
           
        echo " 


            </div>
          </div>";

          echo "<div class='modal fade' id='".$moda1."'> 
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h4 class='modal-title'>Choisir les évaluations en ".$nomclasse."</h4>
                 
                
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>
          
    <div class='modal-body'>";
    
    $chap="SELECT * FROM estenseigne WHERE idclasse='".$idclasse."'";
    $rep = $bdd->query($chap);
    
    while ($don = $rep->fetch()){

      $idestenseigne=$don['idestenseigne'];
      $idmatiere=$don['idmatiere'];
      $nomatiere=nomatiere($idmatiere);

     
    
      
         echo "<div class='dropdown-divider'></div>
    <a href='evaluation2.php?idclassev=".$idclasse."&idcours=".$idmatiere."' class='dropdown-item'>
    <b>".couperchap($nomatiere)."</b>
       
    </a>
   
    
    ";  
       
  
  
  } 
    $rep->closeCursor();  
                
                
            
              
            echo "</div></br>";
            
              
                
                       echo  " 
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->";



        }$p++;} 
        $reponse->closeCursor();   ?>
          <!-- ./col -->


           
           

         </div>
        <!-- /.row -->

        
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
     <a class="btn btn-secondary" href="repetition.php" data-filter="2"><span class="fas fa-users"></span> Demander l'accompagnement d'un expert</a>
     <?php  
     $admin=0;
     
     // echo "<button class='btn btn-success' type='button' data-toggle='modal'   data-target='#ajoutexam'> + Ajouter un sujet d'evaluation</button> ";
    
     ?>
                        
    </div>
    <strong> </strong>  
  </footer>
  <?php
  echo "<div class='modal fade' id='ajoutexam'>
   <div class='modal-dialog'>
     <div class='modal-content '>
     <div class='modal-header'>
         <h4 class='modal-title'>ajouter un sujet d'evaluation</h4>
          
        
         <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
         </button>
       </div>
       <div class='modal-body'>
       
       <form action='executereq.php' enctype='multipart/form-data' method='POST'>

       <div class='form-group'>
       <label for='inputSpentBudget'>  
       Classe</label>
           
       <div class='select2-purple'>
       <select name='ajtclas' onChange='modepaye(this.value)'  id='modepay'   class='select2' data-placeholder='Choisir une classe' class='select2'   data-dropdown-css-class='select2-purple' style='width: 100%;'>
       "; 
       echo " <option value='0'>Choisir une classe</option>";

       $matl="SELECT * FROM classe  WHERE idtypenseig='1'  ORDER BY ordre";
       $repmatl = $bdd->query($matl);
       $c=0;
       while ($donmatl = $repmatl->fetch()){
        $idclasse=$donmatl['idclasse'];
            $nomclasse=$donmatl['nomclasse'];


          $c++;
             echo " <option value='".$idclasse."'>".$nomclasse."</option>";
        }
        $repmatl->closeCursor();
           

        echo "</select>  </div>
     </div>

      
        <div id='modepaye' class='form-group'>
            
          </div>


          <div class='form-group'>
          <label for='inputSpentBudget'>  
          Type</label>
              
          <div class='select2-purple'>
          <select name='ajtype'   class='select2' data-placeholder='Choisir une session' class='select2'   data-dropdown-css-class='select2-purple' style='width: 100%;'>
         
 
          <option value='1'>".nomevaluation(1)."</option> <option value='2'>".nomevaluation(2)."</option>
          <option value='3'>".nomevaluation(3)."</option><option value='4'>".nomevaluation(4)."</option>
          <option value='5'>".nomevaluation(5)."</option><option value='6'>".nomevaluation(6)."</option>
          <option value='7'>".nomevaluation(7)."</option><option value='8'>".nomevaluation(8)."</option>
          <option value='9'>".nomevaluation(9)."</option>
          </select>  </div>
          </div> 
<label for='exampleInputPassword1'>Description du sujet</label>
           <input name='description'   class='form-control'></br>
          <div class='form-group'>
          <label for='inputSpentBudget'>  
          Etablissement</label>
              
          <div class='select2-purple'>
          <select name='choixetab' onChange='modetab(this.value)'      class='select2' data-placeholder='Choisir un établissement' class='select2'   data-dropdown-css-class='select2-purple' style='width: 100%;'>
          "; 
          echo " <option value='a'>Choisir un établissement</option>";
          echo " <option value='0'>Saisir un autre établissement</option>";
          $matl="SELECT DISTINCT etab FROM estevalue WHERE etab!=' '";
          $repmatl = $bdd->query($matl);
          $c=0;
          while ($donmatl = $repmatl->fetch()){
           
             $c++;
                echo " <option value='".$donmatl['etab']."'>".$donmatl['etab']."</option>";
           }
           $repmatl->closeCursor();
              
   
           echo "</select>  </div>
        </div>

        <div id='modetab' class='form-group'>
            
        </div>

          
          
          <div class='form-group'>
    
      <i class='fas fa-paperclip'></i> Cliquer pour choisir un fichier &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <input type='file' name='ficheval'>
 
    <p class='help-block'>Max. 8MO</p>
  </div>

       </div>
       <div class='modal-footer justify-content-between'>
               <button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>";
                echo "<button type='submit' name='ajteval1' class='btn btn-primary'>Ajouter</button>
          </div></form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 <!-- /.modal modif -->";

 ?>

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
