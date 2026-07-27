<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenus.php'; require 'lesfunctions.php'; 
$bloc=4;$actif=$bloc; $pageactif=5;
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=1; $newp=1;
$_SESSION['numprgm']=1; $_SESSION['nomprgm']=2;
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
  $_SESSION['nodemrepet']=$_GET['numdmd']; 
  
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
  <title>gobuch - détails</title>

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
      <?php  echo "<form action='mesdemandes.php' method='POST'>"; ?>
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
            <h1 class="m-0">Mes demandes</h1>
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
        
        
        
        echo "   </br>  
         <h5 class='mb-2 mt-4'>Les détails de la demande</h5> </br> 
  
  
         <div class='card card-solid'>
         <div class='card-body pb-0'>
         <div class='row'>
           
  
         ";
         $date1=date('Y.m.d'); $heure1=date('H:i');
          $lsql="SELECT * FROM demande  WHERE idutilisateur='".$_SESSION['wegonlinenum']."'  ORDER BY idemande DESC";
           $reponse = $bdd->query($lsql);
           $cpt=0;   $i=1;
          while ($donnees = $reponse->fetch() )
          {
            $idemande=$donnees['idemande'];
            $genre=$donnees['genresouh']; $lieusouh=$donnees['lieusouh'];
            $dateng=$donnees['date'];
            $heureg=$donnees['heure'];
            $dclasse=$donnees['idclasse'];
              $idmomentouch=$donnees['idmomentouch']; 
  
     
    //idemander	idempl	idconge	date	heure	datedeb	datefin	heuredeb	heurefin	fichier	reponse	autresp	repdem	daterep	heurerep	idagence
    $modo='#modaal-secondary'.$i;
    $modo1='modaal-secondary'.$i;

    $moda='#modaal-success'.$i;
    $moda1='modaal-success'.$i;

    $modadang='#modaal-danger'.$i;
    $modadang1='modaal-danger'.$i;

    $name="name".$i; 
   
    
    if($_SESSION['nodemrepet']==$idemande){

       
    echo " 
    <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='depensedetail.php?ID=63' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='card-header border-bottom-0'>
                 <h5 class='lead'><b>".nomclasse($dclasse)." </br> </b></h2></br>
                    
                   <b>La(les) matière(s) :<br>";
                   
$lmat="SELECT DISTINCT idmatiere FROM estsollicitee  WHERE idemande='".$idemande."'  ORDER BY idemande DESC";
           $repmat = $bdd->query($lmat);
   //idemande,idmatiere        
          while ($donmat = $repmat->fetch() )
          {
            echo "&nbsp &nbsp + ".nomatiere($donmat['idmatiere'])." <br>";
           
  }
          $repmat->closeCursor();
                 echo "</b></br>
                   
                   ";
                  
                  
                  echo "<b>Lieu : ".$lieusouh."</b></br>"; 
                 echo "</div> 

                </small>
                 
               </div>
               <!--/a-->
             </div>
             

    
    ";


    echo " 
    <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='depensedetail.php?ID=63' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='card-header border-bottom-0'>
                 <h5 class='lead'><b>Moment souhaité pour le debut : <span class='badge bg-warning'>".momentsouh($idmomentouch)."</span></b></h5></br>
                    
                   <b>Date de la demande : <span class='badge bg-secondary'>".format($dateng)." à ".$heureg."</span><br></b></br></br>
                   
                   ";
                   echo  "<small>Numero de la demande : ".$idemande."</small></br>";
                    
                 echo "</div> 

                  
                  
                  
               </div>
               <!--/a-->
             </div>
             

    
    ";
/*    */
    echo " 
    <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <!--a href='depensedetail.php?ID=63' class='nav-link'-->
             <div class='card bg-light d-flex flex-fill'>
                 <div class='card-header border-bottom-0'>
                  
                    
                  <b>Genre souhaité : ".genre($genre)."<b><br>
                   <br><br><br>
                   ";
                  
                
                 echo "</div> 

                 
                 
                 <div class='no-print'><div class='card-footer'>
                 <div class='btn-group w-100 mb-2'>";
                 echo " 
                      <button class='btn btn-danger' type='button' data-toggle='modal'   data-target='".$modadang."'><i class='fas fa-trash'></i></button>
                        ";
                      echo " 
                      <button class='btn btn-success' type='button' data-toggle='modal'   data-target='".$moda."'><i class='fas fa-pencil-alt'></i></button>
                        ";
                
               echo "</div>
                 </div>  </div>
               </div>
               <!--/a-->
             </div>
             

    
    ";

   



  
 



 



       ?>









<?php   echo "<div class='modal fade' id='".$moda1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Modification de la demande </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
  <?php 
  echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Moment souhaité pour le debut</label>
              <select name='moment'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$idmomentouch."'>".momentsouh($idmomentouch)."</option>";
              $reponse = $bdd->query("SELECT * FROM momentsouh ");
                     while ($donnees = $reponse->fetch()){                            
                      $phrase =$donnees['idmomentouch'] ; 
       
         
        echo "<option value='".$phrase."'>".$donnees['libelle']."</option>" ; 
                      } 
                 $reponse->closeCursor(); 
            echo "</select></div><br>";

echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Genre du tuteur.e souhaité</label>
              <select name='genre'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$genre."'>".genre($genre)."</option>
              <option value='1'>Masculin</option><option value='2'>Feminin</option><option value='3'>Peu importe</option>
       
              ";
           
            echo "</select></div><br>";
echo "<label for='exampleInputPassword1'> Lieu</label><textarea name='lieu'  class='form-control'>".$lieusouh."</textarea></br> ";
 
 
            ?>
    
    
  <?php 
   


   

                  
  
 
            ?>
  </br>
      
     
  
  </div>
      <div class="modal-footer justify-content-between">
      <button type="button"   class="btn btn-default"> </button>
      
      <button type="submit" name="chgdmdserv" value="<?php echo $idemande; ?>" class="btn btn-primary">Enregistrer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




 

 

 <?php   echo "<div class='modal fade' id='".$modadang1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Suppression de la demande </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
    <b>Vous êtes sur le point de supprimer cette demande</b>
  </br>
      
     
  
  </div>
      <div class="modal-footer justify-content-between">
      <button type="button"   class="btn btn-default"> </button>
      
      <button type="submit" name="supdmdserv" value="<?php echo $idemande; ?>" class="btn btn-primary">Confirmer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




 






<?php      

  ?>
       
<?php     
      $i++;
      $true=1;
    }
  } 
  $reponse->closeCursor(); 
 
  ?>


   
 
  



           

         </div>
        <!-- /.row -->
        </div></div>






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
  <div class='card-body pb-0'><b>Emploi du temps</b></br></br>
         <div class='row'>

        <?php   // $idemande   $_SESSION['nodemrepet']
        $lsql="SELECT * FROM estsollicitee  WHERE idemande='".$idemande."'  ORDER BY jourcours";
           $reponse = $bdd->query($lsql);
           $cpt=0;  
          while ($donnees = $reponse->fetch() )
          {

             $mode='#modaal-secondary'.$cpt;
    $mode1='modaal-secondary'.$cpt;
        
            $idestsollicitee=$donnees['idestsollicitee'];
            $idenseign=$donnees['idenseign'];
            $idmatiere=$donnees['idmatiere'];
            $duree=$donnees['duree'];
            $horairedeb=$donnees['horairedeb'];
              $ijourcours=$donnees['jourcours'];
               $th=$donnees['th'];
            $decision=$donnees['decision'];
              $montant=$donnees['montant']+0;

     echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column' style='color:black';> <div class='card card-solid'>
        <div class='card-body pb-0 '>
      <b>
       
      Jour : <span class='badge bg-success'>".nomjour($ijourcours)."</span> &nbsp &nbsp &nbsp &nbsp 
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <!--button class='default' type='button' data-toggle='modal'   data-target='".$mode."'><i class='fas fa-pencil-alt'></i></button--><br>
     Heure de debut : <span class='badge bg-info'>".nomheure($horairedeb)."</span><br> 
     Durée : <span class='badge bg-primary'>".$duree." heure.s</span><br>
Matière : ".nomatiere($idmatiere)."<br>
 Tuteur.e : ".completname($idenseign)."<br>
Taux horaire : ".$th." FCFA <br>
Montant total : ".$montant." FCFA <br>
Etat de l'emploi du temps : ".actifemploi($decision)."<br>";
  

      echo " </b>"; 
  
           
            
          echo "</br>
        <!--div class='btn-group w-100 mb-2' >
      
      <button type='submit' name='rechclasse' style='width: 100%; height: 5%;' class='btn btn-info active'>Rechercher</button>                  
                 
     </div-->   
         </div> 
      </div></div>";

?>




<?php   echo "<div class='modal fade' id='".$mode1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Modification de l'emploi du temps </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
  <?php 
  /* $idenseign=$donnees['idenseign'];
            $idmatiere=$donnees['idmatiere'];
            $duree=$donnees['duree'];
            $horairedeb=$donnees['horairedeb'];
              $jourcours=$donnees['jourcours'];
               $th=$donnees['th'];
            $decision=$donnees['decision'];
              $montant=$donnees['montant'];

              */
  echo "<div class='select2-purple'> 
              <label for='exampleInputPassword1'>Jour</label>
              <select name='day'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'>  
               <option value='".$ijourcours."'>".nomjour($ijourcours)."</option>
              <option value='0'>Choisir un jour</option>
        <option value='1'>Lundi</option><option value='2'>Mardi</option><option value='3'>Mercredi</option>
        <option value='4'>Jeudi</option><option value='5'>Vendredi</option><option value='6'>Samedi</option>
        <option value='7'>Dimanche</option>";
            echo "</select></div><br>";

            echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Heure de debut</label>
              <select name='debut'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$horairedeb."'>".nomheure($horairedeb)."</option>
              <option value='1'>08:00</option><option value='2'>09:00</option><option value='3'>10:00</option>
        <option value='4'>11:00</option><option value='5'>12:00</option><option value='6'>13:00</option>
        <option value='7'>14:00</option><option value='8'>15:00</option><option value='9'>16:00</option>
        <option value='10'>17:00</option><option value='11'>17:30</option>
        <option value='12'>18:00</option><option value='13'>18:30</option><option value='14'>19:00</option>
              ";

            echo "</select></div><br>";

            echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Durée</label>
              <select name='duree'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$duree."'>".nomduree($duree)."</option>
              <option value='1'>01:00</option><option value='1.5'>01:30</option>
        <option value='2'>02:00</option><option value='2.5'>02:30</option>
        <option value='3'>03:00</option><option value='3.5'>03:30</option>
        <option value='4'>04:00</option><option value='4.5'>04:30</option>
        <option value='5'>05:00</option><option value='5.5'>05:30</option>
        <option value='6'>06:00</option>
              ";
              
            echo "</select></div><br>";

            echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Matière</label>
              <select name='matie'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$idmatiere."'>".nomatiere($idmatiere)."</option>";
             
            echo "</select></div><br>";

             echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Tuteur.e</label>
              <select name='matie'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$idenseign."'>".namekonto($idenseign)."</option>";
             
            echo "</select></div><br>";
 
echo "<label for='exampleInputPassword1'> Taux horaire en FCFA </label><input name='taux' value='".$th."' class='form-control'></br> ";
 echo "<label for='exampleInputPassword1'> Montant total en FCFA </label><input name='total' value='".$montant."' class='form-control'></br> ";
 
 
            ?>
    
    
  <?php 
   


   

                  
  
 
            ?>
  </br>
      
     
  
  </div>
      <div class="modal-footer justify-content-between">
      <button type="button"   class="btn btn-default"> </button>
      
      <button type="submit" name="chgdmdserv" value="<?php echo $idemande; ?>" class="btn btn-primary">Enregistrer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


 <?php 

           $cpt++;  
          }
          $reponse->closeCursor();
          ?> <!-- ./col -->

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

  <footer class="main-footer">
  <div class="btn-group w-100 mb-2">
     <a class="btn btn-secondary" href="repetition.php" data-filter="2"><span class="fas fa-users"></span> Demander l'accompagnement d'un expert</a>
     <?php  
     $admin=0;
      
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
