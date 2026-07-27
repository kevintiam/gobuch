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
$_SESSION['numpage']=8; $newp=1;
$_SESSION['numorg']=8;
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
  <title>Enseignement général</title>

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
            <h1 class="m-0">Organisation des cours</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><b>Enseignement général</b></li>
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
          
        <b>Nouvelle classe</b> </br>
         <input name='newclasse' class='form-control'>
         <b>Ordre d'affichage</b> </br>
         <input name='ordre' class='form-control'>
      
    <?php 
    echo "     <b>Choisir les matières</b>
             <div class='select2-purple'>
             <select name='matiere[]' class='select2' multiple='multiple' data-placeholder='Choisir les matières' data-dropdown-css-class='select2-purple' style='width: 100%;'>
             ";   
           $vy="SELECT * FROM matiere  ORDER BY nomatiere";
            $reponsey = $bdd->query($vy); 
             
              while ($donneesy = $reponsey->fetch() )
             {  $iDmat=$donneesy['idmatiere'];
               $nomatier=$donneesy['nomatiere'];
               
              echo "<option value='".$iDmat."'>".$nomatier."</option>";
               
             } 
             $reponsey->closeCursor(); 
         echo "</select></div></br>"
         ?>

        <div class='btn-group w-100 mb-2' >
      
      <button type='submit' name='ajoutercl' style='width: 100%; height: 5%;' class='btn btn-info active'>Ajouter</button>                  
                 
     </div></form> </center> 
        </div> 
      </div>
        <!-- Small Box (Stat card) -->
         
        <div class="row">
          
        <?php   echo "   </br>  
         <h5 class='mb-2 mt-4'>Les classes</h5>  
<div class='card-body table-responsive p-0' style='height: 300px;''>  
            <table border='3'  class='table table-head-fixed text-nowrap'> 
        
            <tr bgcolor='#70DBDB'><td><B>#</B></td><td><B>Classes</B></td> 
            <td colspan='4'><B>Actions</B></td> </tr> ";
  $v="SELECT * FROM classe  WHERE idtypenseig='1'  ORDER BY ordre";

  $reponse = $bdd->query($v);
  $i=1;
  while ($donnees = $reponse->fetch() )
  {
    $idklasse=$donnees['idclasse'];
    $nomklasse=$donnees['nomclasse'];
    $ordr=$donnees['ordre'];
    $modo='#modaal-secondary'.$i;
    $modo1='modaal-secondary'.$i;

    $moda='#modaal-success'.$i;
    $moda1='modaal-success'.$i;

    $modadang='#modaal-danger'.$i;
    $modadang1='modaal-danger'.$i;
      
      echo "  <tr> <td bgcolor='#8FBC8F'><B>".$ordr."</B></td>
      <td><B>".$nomklasse."
      
        </B>
      </td> 



      <td><B><form action=' ' method='POST'> <button value='".$idklasse."' 
      type='button'  class='btn btn-primary' data-toggle='modal'  data-target='".$modo."'
      title='Organiser les cours' >
      
      <i class='nav-icon fas fa-book'>
    </i>
    </button>  </form></B></td>

      <td><B><form action='organiser1.php' method='POST'> <button value='".$idklasse."' 
      type='submit' name='attribuer' class='btn btn-secondary' data-toggle='modal'  
      title='Attribuer les matières' >
      
      <i class='far fa-circle nav-icon'>
    </i>
    </button>  </form></B></td>
    

      <td><B> <form action=' ' method='POST'> <button value='".$idklasse."' 
    name='modif'  type='button'  class='btn btn-success' data-toggle='modal' data-target='".$moda."'
       title='modifier'>
      
      <i class='fas fa-pencil-alt'>
    </i>
    </button>  </form></B></td>
    
  
  </tr> ";?>



<?php  echo "<div class='modal fade' id='".$modo1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Organiser les cours en <?php  echo $nomklasse; ?></h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <?php  
           
           $lsql="SELECT * FROM estenseigne WHERE idclasse='".$idklasse."'";
           $repl = $bdd->query($lsql);
           $cpt=0; 
          while ($don = $repl->fetch() )
          {
            $idestenseigne=$don['idestenseigne'];
            $idmatiere=$don['idmatiere'];
            $nomatiere=nomatiere($idmatiere);
            $cpt++;
               echo "<div class='dropdown-divider'></div>
               <a href='organiser2.php?idmatorg=".$idmatiere."&idklasse=".$idklasse."' class='dropdown-item'>
                 <i class='fas fa-file mr-2'></i><b> ".$nomatiere."</b>
                  
               </a>";
          }
          $repl->closeCursor();
            ?>
         
               
  


        
      </div>
       </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<?php  echo "<div class='modal fade' id='".$moda1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Modifier <?php  echo "- ".$nomklasse; ?> </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action='executereq.php' method='POST'>
      
      <?php  echo "Nom de la classe</br><input name='modifclasse' class='form-control' value='".$nomklasse."'>"; ?>
      <?php  echo "</br>Ordre d'affichage </br><input name='ordre' class='form-control' value='".$ordr."'>"; ?>
    </br><button type="submit" name="engmclasse" value="<?php echo $idklasse; ?>" class="btn btn-primary">Modifier</button>
               
  


        
      </div>
      <div class="modal-footer justify-content-between">
      <b>Voulez-vous vraiment supprimer cette classe ?   </b>
      
        <button type="submit" name="supklasse" value="<?php echo $idklasse; ?>" class="btn btn-danger">Supprimer</button>
</div></form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->







<?php  echo "<div class='modal fade' id='".$modadang1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Associer  aux produits</h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      
               
  


        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" name="enregassoc0" value="<?php echo $cu; ?>" class="btn btn-primary">Enregistrer</button>
</div></form>
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
  $i=$i-1;
  echo "  </table></br></br></div></br><B>Total :  ".$i."</B>
   </Br></br></br></div>";
  ?>


   
 
       
         
<?php   echo "   </br></br></br>
 
              
 


           
 <div class='card card-solid'>
 <div class='card-body pb-0'>         
 <form action='executereq.php' method='POST'>  

 <b>Nouvelle matiere</b> </br>
  <input name='newmate' class='form-control'>
  

  <b>Choisir les classes</b>
      <div class='select2-purple'>
      <select name='classe[]' class='select2' multiple='multiple' data-placeholder='Choisir les classes' data-dropdown-css-class='select2-purple' style='width: 100%;'>
      ";   
    $vy='SELECT * FROM classe  ORDER BY ordre';
     $reponsey = $bdd->query($vy); 
      
       while ($donneesy = $reponsey->fetch() )
      {  $iDcl=$donneesy['idclasse'];
        $nomcl=$donneesy['nomclasse'];
        
       echo "<option value='".$iDcl."'>".$nomcl."</option>";
        
      } 
      $reponsey->closeCursor(); 
  echo "</select></div></br>'
 

 <div class='btn-group w-100 mb-2' >

<button type='submit' name='ajoutermate' style='width: 100%; height: 5%;' class='btn btn-info active'>Ajouter</button>                  
          
</div></form></div></div>   

<div class='row'>
<h5>Les matières</h5> </br>
           <div class='card-body table-responsive p-0' style='height: 300px;''> 
           <table border='3'  class='table table-head-fixed text-nowrap'> 
                   
                       <tr bgcolor='#70DBDB'><td><B>#</B></td><td><B>Matières</B></td> 
                       <td colspan='4'><B>Actions</B></td> </tr> ";
             $v="SELECT * FROM matiere  ORDER BY nomatiere";
           
             $reponse = $bdd->query($v);
             $i=1;
             while ($donnees = $reponse->fetch() )
             {
               $idmate=$donnees['idmatiere'];
               $nomate=$donnees['nomatiere'];
              
               $modom='#modaal-secondarym'.$i;
               $modom1='modaal-secondarym'.$i;
           
               $modam='#modaal-successm'.$i;
               $modam1='modaal-successm'.$i;
           
               $modadangm='#modaal-dangerm'.$i;
               $modadangm1='modaal-dangerm'.$i;
                 
                 echo "  <tr> <td bgcolor='#8FBC8F'><B>".$i."</B></td>
                 <td><B>".$nomate."
                 
                   </B>
                 </td> 
           
           
           
                 
           
                 
               
           
                 <td><B> <form action=' ' method='POST'> <button value='".$idmate."' 
               name='modif'  type='button'  class='btn btn-success' data-toggle='modal' data-target='".$modam."'
                  title='modifier'>
                 
                 <i class='fas fa-pencil-alt'>
               </i>
               </button>  </form></B></td>
               
             
             </tr> ";?>
           
           
           
         
           
           <?php  echo "<div class='modal fade' id='".$modam1."'> " ; ?>
             <div class="modal-dialog">
               <div class="modal-content ">
                 <div class="modal-header">
                   <h4 class="modal-title">Modifier <?php  echo "- ".$nomate; ?> </h4>
                    
                
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                 <form action='executereq.php' method='POST'>
                 <?php  echo "<input name='modifmate' class='form-control' value='".$nomate."'>"; ?>
             </br><button type="submit" name="engmate" value="<?php echo $idmate; ?>" class="btn btn-primary">Modifier</button>
                          
             
           
           
                   
                 </div>
                 <div class="modal-footer justify-content-between">
                 <b>Voulez-vous vraiment supprimer cette matière ?   </b>
                 
                   <button type="submit" name="supmate" value="<?php echo $idmate; ?>" class="btn btn-danger">Supprimer</button>
           </div></form>
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
             $i=$i-1;
             echo "  </table></br></br></div></br><B>Total :  ".$i."</Br>
              </B>";
             ?>



           

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
     <?php  
    
     $admin=0;
     if($admin==0){
      echo "<a class='btn btn-success' href='organiser.php' data-filter='3'><span class='fas fa-users'></span> Organisation</a>";
     }
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
