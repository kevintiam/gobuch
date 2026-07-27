<?php

// 
function logo(){
 // return "gobuch";
 return "<img src='client/profil.png' height='35px' width='35px' class='img-circle elevation-2' alt='User Image'>";
}
function logo1(){
   return "gobuch";

}
function menuhautappli(){ 
  echo "
  <a href='#' class='brand-link'>
  <center><b>".logo1()."</b></center>
     </a>"; 
     }

function menuhautnom($nom,$image){ 

  $monom=" ";   $monpnom=" ";
  if(isset($_SESSION['wegonlinenum'])){
    if($_SESSION['wegonlinenum']!=0){ 
      $monom=$_SESSION['wegonlinenom'];
      $monpnom=$_SESSION['wegonlineprnm'];
    }}

  echo " 
        
       
  <center>
         <div class='image'>
           <img src='client/profil.png' height='70px' width='70px' class='img-circle elevation-2' alt='User Image'>
         </div></center>
         <div class='info'>
           <a href='#' class='d-block'><center>".$monom." ".$monpnom."</center></a>
         </div>
       "; 
        
     }

//DEB WEBMASTER
function bloc($bloc){
  $bloc1='nav-item';$bloc2='nav-item';
  $bloc3='nav-item';$bloc4='nav-item'; $bloc5='nav-item';
  if($bloc==1){$bloc1='nav-item menu-open'; return $bloc1;}
  if($bloc==2){$bloc2='nav-item menu-open'; return $bloc2;}
  if($bloc==3){$bloc3='nav-item menu-open'; return $bloc3;}
  if($bloc==4){$bloc4='nav-item menu-open'; return $bloc4;}
   if($bloc==5){$bloc5='nav-item menu-open'; return $bloc5;}
}
function actif($actif){
  $actif1='nav-link';$actif2='nav-link';
  $actif3='nav-link';$actif4='nav-link';
  $actif5='nav-link';
  if($actif==1){$actif1='nav-link active'; return $actif1;}
  if($actif==2){$actif2='nav-link active'; return $actif2;}
  if($actif==3){$actif3='nav-link active'; return $actif3;}
  if($actif==4){$actif4='nav-link active'; return $actif4;}
  if($actif==5){$actif5='nav-link active'; return $actif5;}
}
function pageactif($pageactif){
  $actif1='nav-link';$actif2='nav-link';
  $actif3='nav-link';$actif4='nav-link';
   $actif5='nav-link';
  if($actif==1){$actif1='nav-link active'; return $actif1;}
  if($actif==2){$actif2='nav-link active'; return $actif2;}
  if($actif==3){$actif3='nav-link active'; return $actif3;}
  if($actif==4){$actif4='nav-link active'; return $actif4;}
  if($actif==5){$actif5='nav-link active'; return $actif5;}
}
function tableaubord($bloc,$actif,$pageactif){
  $bloc0='nav-item';
  $bloc1='nav-item';$bloc2='nav-item';
  $bloc3='nav-item';$bloc4='nav-item';
  $bloc5='nav-item';$bloc6='nav-item';
  if($bloc==0){$bloc0='nav-item menu-open'; }
  if($bloc==1){$bloc1='nav-item menu-open'; }
  if($bloc==2){$bloc2='nav-item menu-open'; }
  if($bloc==3){$bloc3='nav-item menu-open'; }
  if($bloc==4){$bloc4='nav-item menu-open'; }
  if($bloc==5){$bloc5='nav-item menu-open'; }
  if($bloc==6){$bloc6='nav-item menu-open'; }

  $actif0='nav-link'; $actif1='nav-link';$actif2='nav-link';
  $actif3='nav-link';$actif4='nav-link';
  $actif5='nav-link';
  if($actif==0){$actif0='nav-link active';}
  if($actif==1){$actif1='nav-link active';}
  if($actif==2){$actif2='nav-link active';}
  if($actif==3){$actif3='nav-link active';}
  if($actif==4){$actif4='nav-link active';}
  if($actif==5){$actif5='nav-link active';}

  $pageactif0='nav-link';$pageactif1='nav-link';$pageactif2='nav-link';
  $pageactif3='nav-link';$pageactif4='nav-link';
  $pageactif5='nav-link';$pageactif6='nav-link';
  $pageactif7='nav-link';$pageactif8='nav-link';
  $pageactif9='nav-link';$pageactif10='nav-link';
  $pageactif11='nav-link';$pageactif12='nav-link';
  if($pageactif==0){$pageactif0='nav-link active'; }
  if($pageactif==1){$pageactif1='nav-link active'; }
  if($pageactif==2){$pageactif2='nav-link active';}
  if($pageactif==3){$pageactif3='nav-link active';}
  if($pageactif==4){$pageactif4='nav-link active';}
  if($pageactif==5){$pageactif5='nav-link active';}
  if($pageactif==6){$pageactif6='nav-link active';}
  if($pageactif==7){$pageactif7='nav-link active'; }
  if($pageactif==8){$pageactif8='nav-link active'; }
  if($pageactif==9){$pageactif9='nav-link active'; }
  if($pageactif==10){$pageactif10='nav-link active'; }
  if($pageactif==11){$pageactif11='nav-link active'; }
  if($pageactif==12){$pageactif12='nav-link active'; }
  echo "  
   
  <li class='".$bloc0."'>
  <a href='index.php' class='".$actif0."'>
  <i class='nav-icon fas fa-tachometer-alt'></i>
  <p>
    Accueil
    <i class='fas fa-angle-left right'></i>
  </p>
  </a>
   
</li>

  <li class='".$bloc1."'>
            <a href='#' class='".$actif1."'>
            <i class='nav-icon fas fa-book'></i>
            <p>
              Cours + Exercices
              <i class='fas fa-angle-left right'></i>
            </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='programmegen.php' class='".$pageactif1."'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Enseignement général</p>
                </a>
              </li>
               
               
            </ul>
          </li>
     

     <li class='".$bloc2."'>
     <a href='#' class='".$actif2."'>
     <i class='nav-icon far fa-plus-square'></i>
     <p>
       Sujets d'examens
       <i class='fas fa-angle-left right'></i>
     </p>
     </a>
     <ul class='nav nav-treeview'>
       <li class='nav-item'>
         <a href='examensgen.php' class='".$pageactif2."'>
           <i class='far fa-circle nav-icon'></i>
           <p>Enseignement général</p>
         </a>
       </li>
        
       
       
     </ul>
   </li>

          
   <li class='".$bloc3."'>
   <a href='#' class='".$actif3."'>
   <i class='nav-icon fas fa-chart-pie'></i>
   <p>
     Evaluations
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='evaluation.php' class='".$pageactif3."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Enseignement général</p>
       </a>
     </li>
      
     
   </ul>
 </li> 

           
   <li class='".$bloc4."'>
   <a href='#' class='".$actif4."'>
   <i class='nav-icon far fa-calendar-alt'></i>
   <p>
     Accompagnement par un expert
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='repetition.php' class='".$pageactif4."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Faire une demande</p>
       </a>
     </li>";
      if(isset($_SESSION['wegonlinenum'])){
        if($_SESSION['wegonlinenum']==0){ 

        }
        if($_SESSION['wegonlinenum']!=0){ 
          echo "<li class='nav-item'>
       <a href='mesdemandes.php' class='".$pageactif5."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Mes demandes</p>
       </a>
     </li>";
        }
      }
      
     
   echo "</ul>
 </li>";  
 
  if(isset($_SESSION['wegonlinenum'])){
        if($_SESSION['wegonlinenum']==0){ 

        }
        if($_SESSION['wegonlinenum']!=0){ 
            
      echo   "<li class='".$bloc5."'>
   <a href='#' class='".$actif5."'>
   <i class='fas fa-cogs'></i>
   <p>
     Tuteur.e
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a   data-toggle='modal'   data-target='#emploi' class='".$pageactif6."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Emploi du temps</p>
       </a>
     </li>
      <li class='nav-item'>
       <a   data-toggle='modal'   data-target='#seanc' class='".$pageactif7."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Mes séances effectuées</p>
       </a>
     </li>
      
     
   </ul>
 </li> ";       
           
        }
      }

  /*
 echo "<li class='".$bloc5."'>
 <a href='#' class='".$actif5."'>
   <i class='fas fa-user'></i>
   <p>
     Mon compte
     <i class='fas fa-angle-left right'></i>
   </p>
 </a>
 <ul class='nav nav-treeview'>
 <li class='nav-item'>
     <a href='compte.php' class='".$pageactif12."'>
       <i class='far fa-circle nav-icon'></i>
       <p>Informations personnelles</p>
     </a>
   </li>
   
 </ul>
</li> ";*/    

    

if(isset($_SESSION['wegonlinenum'])){
  if($_SESSION['wegonlinenum']!=0){ 
echo "</br> <center><a href='delogin.php'>
 <p>Se déconnecter</p>
</a></center>";
  }}

    
}


//FIN WEBMASTER

 

//administrateur
 

 




?>



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



  <?php   echo "<div class='modal fade' id='seanc'> " ; ?>
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Mes séances effectuées</h4>
         
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
  <div class="modal-body">


  <form action='seanceall.php' method='POST'>
 
    <div class='input-group mb-3'>
    <?php  
    echo "<div class='btn-group w-100 mb-2'>
     <button type='submit' name='envoi' class='btn btn-primary'>  Toutes mes séances</button>
   </div>";
    
    ?></div></form>

   <form action='seancejr.php' method='POST'>
  <label for='exampleInputPassword1'> Les séances effectués sur une date</label>
    <div class='input-group mb-3'>
    <?php echo "<input name='datpdeb'   class='form-control' type='date'></br></br>";
    
    echo "<div class='btn-group w-100 mb-2'>
     <button type='submit' name='envoi' class='btn btn-success'>  Valider</button>
   </div>";
    
    ?></div></form>

</br><b>Les séances effectués sur une periode</b></br>
 <form action='seanceper.php' method='POST'>
   
   <div class='input-group mb-3'><input value='Du' disabled='disabled'  class='form-control'>
  <input value='Au' disabled='disabled'  class='form-control'></div>
    <div class='input-group mb-3'>
       
    <?php echo "<input name='datpdeb'   class='form-control' type='date'></br></br>";
     echo "<input name='datpfin'   class='form-control' type='date'></br></br>";
    echo "<div class='btn-group w-100 mb-2'>
     <button type='submit' name='envoipe' class='btn btn-secondary'>  Valider</button>
   </div>";
    
    ?></div></form>
 </form>
  </br>
      
     
  
  </div>
      
       
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->