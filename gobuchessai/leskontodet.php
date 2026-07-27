<?php
 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenusgerer.php'; require 'lesfunctions.php'; 
$bloc=4;$actif=$bloc; $pageactif=7;
$numpagepreced=$_SESSION['numpage'];
$_SESSION['numpage']=1; $newp=1;
$_SESSION['numprgm']=1;
if($numpagepreced==0 AND $newp!=$numpagepreced){
  $_SESSION['nompagepreced']="index.php";
}
 
if($_SESSION['lesback']==1){
  $byback="leskontoacc.php";
}
 if($_SESSION['lesback']==2){
  $byback="kontonoensg.php";
}
 if($_SESSION['lesback']==3){
  $byback="kontoensg.php";
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



if(isset($_GET['idacc'])){
 $_SESSION['idacc']=$_GET['idacc'];
}
 $ligneinfo=infokontouser($_SESSION['idacc']);
 $tab=array();
 $tab=explode("@",$ligneinfo);
$_SESSION['ligname']=$tab[0]; $_SESSION['lignpname']=$tab[1];
$_SESSION['lignmpasse']=$tab[2]; $_SESSION['lignuser']=$tab[3]; $_SESSION['ligngenre']=$tab[4];
$_SESSION['ligndnaiss']=$tab[5]; $_SESSION['lignumsimp']=$tab[6]; $_SESSION['lignumw']=$tab[7];
$_SESSION['ligndate']=$tab[8]; $_SESSION['lignheure']=$tab[9];
 
$infosuppuser=infosuppuser($_SESSION['idacc']);
  $tab2=array();
 $tab2=explode("@",$infosuppuser);
$_SESSION['lignphoto']=$tab2[0]; $_SESSION['ligncni']=$tab2[1];
$_SESSION['lignplanlocal']=$tab2[2]; $_SESSION['lignville']=$tab2[3];
$_SESSION['lignquartier']=$tab2[4]; $_SESSION['ligndispo']=$tab2[5];
 

if(!isset($_SESSION['getvisual'])){
 $_SESSION['getvisual']=0;
}
if(isset($_GET['getvisual'])){
 $_SESSION['getvisual']=$_GET['getvisual'];
}
if($_SESSION['getvisual']==0){ $styclas1="btn btn-primary"; $styclas2="btn btn-default"; $styclas3="btn btn-default";}
 if($_SESSION['getvisual']==1){ $styclas1="btn btn-default"; $styclas2="btn btn-primary"; $styclas3="btn btn-default";}
 if($_SESSION['getvisual']==2){ $styclas1="btn btn-default"; $styclas2="btn btn-default"; $styclas3="btn btn-primary";}
 
 if(!isset($_SESSION['getok'])){
  $_SESSION['getok']=0;
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
  <title>gobuch - détails utilisateurs - <?php echo $_SESSION['idacc'];?></title>

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
      <?php  echo "<form action='".$byback."' method='POST'>"; ?>
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
            <h1 class="m-0">Les utilisateurs-détails</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
             
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
       
<?php $verifensg=verifensg($_SESSION['idacc'])  ;?>

<div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
<?php   if($_SESSION['getok']==3){ 
echo "<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h5><i class='icon fas fa-check'> Enregistrée avec succès</i> 
  </br>
</h5>
</div>"; $_SESSION['getok']=0;
}   ?>
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <?php  echo  "<img class='img-circle elevation-2' height='100px' width='100px'
                       src='client/".imagensg($_SESSION['idacc'])."' 
                       alt='profil prestataire'>" ;
                     
                      ?> <button  
                      type='button'  class='btn btn-block btn-success' data-toggle='modal' 
                       data-toggle='modal' data-filter='all' data-target='#voir' title='image'>
                      <i class='fa fa-camera bg-purple'>
                      </i> agrandir
                       
                  </button> 


 <!-- /.debut voir img -->
 <div class='modal fade' id='voir'>  
<div class='modal-dialog modal-xl'>
  <div class='modal-content '>
    <div class='modal-header'>
      <h4 class='modal-title'>image</h4>
       
      
      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <div class='modal-body'>
    
    <?php  echo "<img src='client/".imagensg($_SESSION['idacc'])."' height='450px' width='250px'>";  ?>
     
    </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
  <!-- /.fin voir img -->


                </div>

                <h3 class="profile-username text-center"> </h3>

                <p class="text-muted text-center"> </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b><?php echo $_SESSION['ligname'];?></b> 
                  </li>
                  <li class="list-group-item">
                    <b><?php echo $_SESSION['lignpname'];?></b>
                  </li>



<?php


if($verifensg!=0){ 
  echo "<li class='list-group-item'>
                    <b>Tuteur</b><!--a type='button' data-toggle='modal' style='color:black'; class='float-right' data-target='#modtypc'><i class='fas fa-pencil-alt'></i> <small> modifier le statut</small></a-->
                  </li>"; 
                  }

                   if($verifensg ==0){ 
  echo "<li class='list-group-item'>
                    <b>Non tuteur</b><!--a type='button' data-toggle='modal' style='color:black'; class='float-right' data-target='#modtypc'><i class='fas fa-pencil-alt'></i> <small> modifier le statut</small></a-->
                  </li>"; 
                  }



echo "  <!-- Default box -->
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'><b> détails</b></h3>

                <div class='card-tools'>
                  <button type='button' class='btn btn-tool' data-card-widget='collapse' title='Collapse'>
                    &nbsp &nbsp &nbsp<i class='fas fa-minus'> &nbsp &nbsp</i>
                  </button>
                   
                </div>
              </div>
              <div class='card-body'>
                 
 
                    <b>Date de naissance : </b></br>  <a   href='#' style='color:black';>".$_SESSION['ligndnaiss']."</a>  <hr style='color:black';> 
                  
                   
                    <b>genre :</b>  <a class='float-right' href='#' style='color:black';>".genre($_SESSION['ligngenre'])."</a> <hr style='color:black';> 
                   
                   
                    <b>".$_SESSION['lignumsimp']."</b>  <a class='float-right' href='tel:".$_SESSION['lignumsimp']."' style='color:black';>&nbsp &nbsp &nbsp &nbsp<span class='fas fa-rg fa-phone' style='color:blue';></span></a> <hr style='color:black';>
                   
                  
                    <b>".$_SESSION['lignumw']."</b>  <a class='float-right' href='https://wa.me/".$_SESSION['lignumw']."' style='color:black';>&nbsp &nbsp &nbsp &nbsp<span class='fab fa-whatsapp' style='color:green';></span></a> <hr style='color:black';>
    
<b>Ville </b>  <a class='float-right' href='#' style='color:black';>&nbsp &nbsp &nbsp &nbsp".$_SESSION['lignville']."</a> <hr style='color:black';>

<b>Quartier </b>  <a class='float-right' href='#' style='color:black';>&nbsp &nbsp &nbsp &nbsp".$_SESSION['lignquartier']."</a> <hr style='color:black';>

<b>N° CNI </b>  <a class='float-right' href='#' style='color:black';>&nbsp &nbsp &nbsp &nbsp".$_SESSION['ligncni']."</a> <hr style='color:black';>
 


              </div>
              <!-- /.card-body -->
               
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->";
  ?>





                 
                  
                  

                 





                  <?php  
                  
 
                   ?>
                   


 <li class="list-group-item">
                    <div class="btn-group w-100 mb-2">
                     <a type='button' data-toggle='modal'  class="btn btn-info" data-target='#modinf'><i class='fas fa-pencil-alt'></i> <small> modifier</small></a>
                    <a type='button' data-toggle='modal'   class="btn btn-primary" data-target='#modimg'><i class='fa fa-camera bg-purple'></i> <small> changer l'image</small></a>
                   </div>

                      
    <?php
echo  "<small> id utilisateur : ".$_SESSION['idacc']."</small></br>";

echo "<div class='modal fade' id='modinf'>
  <div class='modal-dialog'>
    <div class='modal-content '>
      <div class='modal-header'>
        <h4 class='modal-title'>Modifier les données </h4>
         
     
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
    
  <div class='modal-body'>
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
    <b> ";
     echo "Noms </br><input name='nomu' class='form-control' value='".$_SESSION['ligname']."'></br>";
  echo "Prénoms </br><input name='pnomu' class='form-control' value='".$_SESSION['lignpname']."'></br>";
  echo "Date de naissance </br><input name='dateu' class='form-control' value='".$_SESSION['ligndnaiss']."'></br>";
  echo "<b>genre</b>
      <div class='select2-purple'>
      <select name='genre' class='select2'   data-dropdown-css-class='select2-purple' style='width: 100%;'>
      ";  
  echo "<option value='".$_SESSION['ligngenre']."'>".genre($_SESSION['ligngenre'])."</option><option value='1'>Masculin</option>
    <option value='2'>Féminin</option>";
 echo "</select></div></br>";
  
  echo "Numéro téléphone </br><input name='nums' class='form-control' value='".$_SESSION['lignumsimp']."'></br>";
  echo "Numéro Whatsapp </br><input name='numw' class='form-control' value='".$_SESSION['lignumw']."'></br>";
    
  echo "<b>Statut</b>
      <div class='select2-purple'>
      <select name='statut' class='select2'   data-dropdown-css-class='select2-purple' style='width: 100%;'>
      ";  
      if($verifensg!=0){
        echo "<option value='1'>Tuteur</option>
        <option value='0'>Non tuteur</option>";
      }
      if($verifensg==0){
        echo " <option value='0'>Non tuteur</option>
        <option value='1'>Tuteur</option>
       ";
      }
  
 echo "</select></div></br>";
   
 echo "Ville </br><input name='villeu' value='".$_SESSION['lignville']."' class='form-control' ></br>";
 echo "Quartier </br><input name='quartieru' value='".$_SESSION['lignquartier']."' class='form-control' ></br>";
echo "N° CNI </br><input name='cniu'  value='".$_SESSION['ligncni']."' class='form-control' ></br>";
   echo " </br>
    </b></div>
      <div class='modal-footer justify-content-between'>
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>Fermer</button>
      
      <button type='submit' value='".$_SESSION['idacc']."' name='modonne' class='btn btn-primary'>Enregistrer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->";








 echo "<div class='modal fade' id='modimg'>
  <div class='modal-dialog'>
    <div class='modal-content '>
      <div class='modal-header'>
        <h4 class='modal-title'>Modifier l'image </h4>
         
     
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
    
  <div class='modal-body'>
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
   
  <div class='form-group'>
 <b>Choisir l'image</b></div> <div class='form-group'>
    <input type='file' name='imuser'>
    <p class='help-block'>Max. 8MO par image</p>
  </div> 
  
  </br>
   </div>
      <div class='modal-footer justify-content-between'>
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>Fermer</button>
      
      <button type='submit' value='".$_SESSION['idacc']."' name='saveim' class='btn btn-primary'>Enregistrer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->";




 ?>


                  </li>






                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

             
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">

                  
    <?php    if($_SESSION['getvisual']==0){ echo "<b>Emploi du temps</b>";} 
    if($_SESSION['getvisual']==1){
       echo "<b>Compétences &nbsp &nbsp  &nbsp &nbsp ";
if($verifensg!=0){ 
      echo "<a type='button' data-toggle='modal'  style='color:green'; data-target='#newcompet'><i class='nav-icon fas fa-plus' ></i> Ajouter une nouvelle compétence</a></b>";
     }
       echo "<div class='modal fade' id='newcompet'>
  <div class='modal-dialog'>
    <div class='modal-content '>
      <div class='modal-header'>
        <h4 class='modal-title'>Nouvelle compétence </h4>
         
     
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
    
  <div class='modal-body'>
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
   <select name='matadd[]' class='select2' style='color:blue'; multiple='multiple' data-placeholder='Choisir' data-dropdown-css-class='select2-purple' style='width: 100%;'>
     ";
     $vy='SELECT * FROM estenseigne  ORDER BY idmatiere';
     $reponsey = $bdd->query($vy); 
      
       while ($donneesy = $reponsey->fetch() )
      {  $iDcl=$donneesy['idclasse'];
        $mat=$donneesy['idmatiere'];
        $ensb=$mat."-".$iDcl;
       echo "<option value='".$ensb."'>".nomatiere($mat)." / ".nomclasse($iDcl)."</option>";
        
      } 
      $reponsey->closeCursor();
  
   echo "</select></br>
   </div>
      <div class='modal-footer justify-content-between'>
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>Fermer</button>
      
      <button type='submit' value='".$_SESSION['idacc']."' name='addcompet' class='btn btn-primary'>Enregistrer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->";
      
      }  
    if($_SESSION['getvisual']==2){ echo "<b>Les travaux</b>";} 
   
    
    ?>  
  
                   
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                 <!-- Post -->
                   <?php   
            if($_SESSION['getvisual']==1){
               
 echo "<div class='card card-solid'>"; 

  if($_SESSION['getok']==1){ 
echo "<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h5><i class='icon fas fa-check'> Supprimé avec succès</i> 
  </br>
</h5>
</div>"; $_SESSION['getok']=0;
}  

 if($_SESSION['getok']==2){ 
echo "<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h5><i class='icon fas fa-check'> Ajoutée avec succès</i> 
  </br>
</h5>
</div>"; $_SESSION['getok']=0;
}  

  echo "<div class='card-body pb-0'> 
         <div class='row'>";
               $reponseb = $bdd->query("SELECT * FROM ensmatclas WHERE idutilisateur='".$_SESSION['idacc']."'");
           $b=0;  
          while ($donb = $reponseb->fetch() )
          {
              $idemc=$donb['idemc'];
              $iduserc=$donb['idutilisateur'];
              $idmatuser=$donb['idmat'];
              $idclasuser=$donb['idclas'];
              $modo='#modaal-secondary'.$b;
    $modo1='modaal-secondary'.$b;
              echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
            <a type='button' data-toggle='modal'   data-target='".$modo."'>
             <div class='card bg-light d-flex flex-fill'>
                 <div class='btn btn-default'><b>".nomatiere($idmatuser)."</br> 
                 <span class='badge bg-info'>".nomclasse($idclasuser)."</span></br>
                  <i class='fas fa-trash' style='color:red';>
    </i> </b>
</div> 
</div></a></div>"; ?>   

<?php   echo "<div class='modal fade' id='".$modo1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Suppression </h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <form action='executereq.php' method='POST'  enctype='multipart/form-data'>
  <?php 
  echo "<b>".$_SESSION['ligname']." ".$_SESSION['lignpname']."</br>".
  nomatiere($idmatuser)."</br>".nomclasse($idclasuser)." </br> Voulez vous vraiment supprimer ?</b>";
 
  ?>
  
  </br>
   </div>
      <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
      
      <button type="submit" name="supcompet" value="<?php echo $idemc; ?>" class="btn btn-danger">Supprimer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


        <?php  
        $b++; 
          }
          $reponseb->closeCursor();  
             echo "</div></div></div>";  
            } 






    if($_SESSION['getvisual']==0){ // EMPLOI



 echo "<div class='card card-solid'>"; 

  if($_SESSION['getok']==1){ 
echo "<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h5><i class='icon fas fa-check'> Supprimé avec succès</i> 
  </br>
</h5>
</div>"; $_SESSION['getok']=0;
}  

 if($_SESSION['getok']==2){ 
echo "<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h5><i class='icon fas fa-check'> Ajoutée avec succès</i> 
  </br>
</h5>
</div>"; $_SESSION['getok']=0;
}  

  echo "<div class='card-body pb-0'> 
         <div class='row'>";
            $reponseb = $bdd->query("SELECT * FROM estsollicitee   WHERE idenseign='".$_SESSION['idacc']."'");
           $b=0;  
          while ($donb = $reponseb->fetch() )
          {
              $idestsollicitee=$donb['idestsollicitee'];   
            $idenseign=$donb['idenseign'];
            $idmatiere=$donb['idmatiere'];
             $idemande=$donb['idemande'];
            $duree=$donb['duree']+0;
            $horairedeb=$donb['horairedeb'];
              $ijourcours=$donb['jourcours'];
               $th=$donb['th']+0;
            $decision=$donb['decision']; //O POUR ACTIF 1 POUR PASSER
              $montant=$donb['montant']+0;
               $montantens=$donb['montantensei']+0;
               $thens=$donb['tauxensei']+0;
             $infosdemande=infosdemande($idemande);
  $tab2=array();
  $tab2=explode("@",$infosdemande);
 $idclasse=$tab2[3]; $lieusouh=$tab2[6];
 $idemandeur=$tab2[4];

 $infokontouser= infokontouser($idemandeur);
 $tab3=array();
 $tab3=explode("@",$infokontouser);
 $nomdmd=$tab3[0]; $prenamdmd=$tab3[1];
 $genredmd=$tab3[4];
$umsimpdmd=$tab3[6]; $lignumwdmd=$tab3[7];
 

              $modo='#modaal-secondary'.$b;
    $modo1='modaal-secondary'.$b;

     $moda='#modaal-seco'.$b;
    $moda1='modaal-seco'.$b;  
             echo " <div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
             
             <div class='card bg-light d-flex flex-fill'>
               <div class='btn btn-default'><b>".nomclasse($idclasse)."</br>".nomatiere($idmatiere)."</br> 
                  Jour : <span class='badge bg-info'>".nomjour($ijourcours)."</span></br>
                      heure de debut : ".nomheure($horairedeb)."</br>
                  Durée : ".nomduree($duree)." heure.s</br>
                  Lieu : ".$lieusouh."  </br>
               Etat de l'emploi du temps : ".actifemploi($decision)."<br> 
                   </b> 
                  
      
</div> 
 
 <div class='modal-footer justify-content-between'>
 <div class='btn-group w-100 mb-2'>
      <button type='button' data-toggle='modal' class='btn btn-danger'  data-target='".$modo."'><i class='fas fa-trash'> </i></button>
   <button type='button' data-toggle='modal' class='btn btn-info'   data-target='".$moda."'> + détails</button>
 </div> 
 </div> 

</div> </div>"; ?>   

<?php   echo "<div class='modal fade' id='".$modo1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
         <h4 class="modal-title">Suppression de cette plage </h4>  
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <?php   echo "<form action='executereq.php' method='POST'    enctype='multipart/form-data'>"; ?>
  <?php 
       

   echo "<b>Voulez vous vraiment supprimer ? </b><br>";

 
            ?>
    
    
  </div>
      <div class="modal-footer justify-content-between">
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>Fermer</button>
      
      <button type="submit" name="supperioduser" value="<?php echo $idestsollicitee; ?>" class="btn btn-primary">Supprimer</button>
        </form></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


 <?php   echo "<div class='modal fade' id='".$moda1."'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
         <h4 class="modal-title">Détails sur cette plage </h4>  
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">
  <?php   echo "<form>"; 
 
  echo "  <b> Noms et prénoms du demandeur : ".$nomdmd." ".$prenamdmd." <br>
  genre du demandeur : ".genre($genredmd)." <br>
   Lieu : ".$lieusouh." <br>
Contact : <br>
  ".$umsimpdmd."  <a class='float-right' href='tel:".$umsimpdmd."' style='color:black';>&nbsp &nbsp &nbsp &nbsp
   <span class='fas fa-rg fa-phone' style='color:blue';></span></a> <hr style='color:black';><br><br>
    Whatsapp : <br>
  ".$lignumwdmd."   <a class='float-right' href='https://wa.me/".$lignumwdmd."' style='color:black';>&nbsp &nbsp &nbsp &nbsp
  <span class='fab fa-whatsapp' style='color:green';></span></a> <hr style='color:black';><br>

  Taux horaire payé par le demandeur : <br>".$th." FCFA <br>
Montant total payé par le demandeur : <br> ".$montant." FCFA <br> 
Taux horaire à recevoir par le tuteur : <br>".$thens." FCFA <br>
 Montant total  à recevoir par le tuteur : <br> ".$montantens." FCFA <br></b>";

      
            ?>
    
    
  </div>
      </form> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
 

        <?php  
        $b++; 
          }
          $reponseb->closeCursor();  
             echo "</div></div></div>";  




    }

if($_SESSION['getvisual']==2){  // TRAVAUX



    }




           
      ?>
       


                  </div>
                  

                   
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      </br></br></br>





    </section>
    <!-- /.content -->

    </br></br></br></br></br> 

  </div>
  <!-- /.content-wrapper -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <footer class="main-footer">
   <div class="btn-group w-100 mb-2">
    <?php   echo"<a class='".$styclas1."' href='leskontodet.php?getvisual=0' data-filter='2'><small> emploi du temps</small></a>
<a class='".$styclas2."' href='leskontodet.php?getvisual=1'  data-filter='2'><small>Compétences</small></a>
<a class='".$styclas3."' href='leskontodet.php?getvisual=2'  data-filter='2'><small>Les travaux</small></a>  "; 
 ?>  
    </div>
   </footer>
  </nav>

  
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