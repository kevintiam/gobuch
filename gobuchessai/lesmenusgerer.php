<?php
// 
function logo(){
  return "gobuch";
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
  echo " 
        
       
  <center>
         <div class='image'>
           <img src='client/profil.png' height='70px' width='70px' class='img-circle elevation-2' alt='User Image'>
         </div></center>
         <div class='info'>
           <a href='#' class='d-block'><center>  </center></a>
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
  $actif3='nav-link';$actif4='nav-link';$actif5='nav-link';
  if($actif==1){$actif1='nav-link active'; return $actif1;}
  if($actif==2){$actif2='nav-link active'; return $actif2;}
  if($actif==3){$actif3='nav-link active'; return $actif3;}
  if($actif==4){$actif4='nav-link active'; return $actif4;}
  if($actif==5){$actif5='nav-link active'; return $actif5;}
   if($actif==6){$actif6='nav-link active'; return $actif6;}
}
function pageactif($pageactif){
  $actif1='nav-link';$actif2='nav-link';
  $actif3='nav-link';$actif4='nav-link';
  $actif5='nav-link'; $actif6='nav-link';
  if($actif==1){$actif1='nav-link active'; return $actif1;}
  if($actif==2){$actif2='nav-link active'; return $actif2;}
  if($actif==3){$actif3='nav-link active'; return $actif3;}
  if($actif==4){$actif4='nav-link active'; return $actif4;}
   if($actif==5){$actif5='nav-link active'; return $actif5;}
   if($actif==6){$actif6='nav-link active'; return $actif6;}
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
  $actif5='nav-link'; $actif6='nav-link';
  if($actif==0){$actif0='nav-link active';}
  if($actif==1){$actif1='nav-link active';}
  if($actif==2){$actif2='nav-link active';}
  if($actif==3){$actif3='nav-link active';}
  if($actif==4){$actif4='nav-link active';}
  if($actif==5){$actif5='nav-link active';}
  if($actif==6){$actif6='nav-link active';}

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
  <a href='organiser.php' class='".$actif0."'>
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
              Organiser les cours + Exercices
              <i class='fas fa-angle-left right'></i>
            </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='organiser.php' class='".$pageactif1."'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Enseignement général</p>
                </a>
              </li>
               
               
            </ul>
          </li>
          

           <li class='".$bloc2."'>
   <a href='#' class='".$actif2."'>
   <i class='nav-icon fas fa-chart-pie'></i>
   <p>
     Evaluations
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='evaluationadm.php' class='".$pageactif2."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Enseignement général</p>
       </a>
     </li>
      
     
   </ul>
 </li> 


 <li class='".$bloc3."'>
   <a href='#' class='".$actif3."'>
   <i class='nav-icon fas fa-plus'></i>
   <p>
     Examens
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='examensgenadm.php' class='".$pageactif3."'>
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
     Les demandes d'accompagnement
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='demandeacc.php' class='".$pageactif4."'>
         <i class='far fa-circle nav-icon'></i>
         <p>organiser les demandes</p>
       </a>
     </li>
     <li class='nav-item'>
       <a href='numtelaisse.php' class='".$pageactif6."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Les numéros de téléphone laissés 'prospects'</p>
       </a>
     </li>
     <li class='nav-item'>
       <a href='leskontoacc.php' class='".$pageactif7."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Les utilisateurs</p>
       </a>
     </li>
      
     
   </ul>
 </li> 

 <li class='".$bloc5."'>
   <a href='#' class='".$actif5."'>
   <i class='nav-icon fas fa-users'></i>
   <p>
     Les visites
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='viewvisite.php' class='".$pageactif5."'>
         <i class='far fa-circle nav-icon'></i>
         <p>consulter les visites</p>
       </a>
     </li>
       <li class='nav-item'>
       <a href='listavis.php' class='".$pageactif8."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Les avis</p>
       </a>
     </li>
       </li>
       <li class='nav-item'>
       <a href='listnouscon.php' class='".$pageactif9."'>
         <i class='far fa-circle nav-icon'></i>
        <p>Les messages</p>
       </a>
     </li>
      
     
   </ul>
 </li> 
             
             
         ";




echo "<li class='".$bloc6."'>
   <a href='ressources.php?source=0' class='".$actif6."'>
   <i class='nav-icon fas fa-table'></i>
   <p>
    Ressources
     <i class='fas fa-angle-left right'></i>
   </p>
   </a>
   <!--ul class='nav nav-treeview'>
   <li class='nav-item'>
       <a href='ressources.php' class='".$pageactif5."'>
         <i class='far fa-circle nav-icon'></i>
         <p>consulter les visites</p>
       </a>
     </li>
       <li class='nav-item'>
       <a href='listavis.php' class='".$pageactif8."'>
         <i class='far fa-circle nav-icon'></i>
         <p>Les avis</p>
       </a>
     </li>
       </li>
       <li class='nav-item'>
       <a href='listnouscon.php' class='".$pageactif9."'>
         <i class='far fa-circle nav-icon'></i>
        <p>Les messages</p>
       </a>
     </li>
      
     
   </ul-->
 </li> 
             
             
         ";


     
     /*
    echo  "<li class='".$bloc2."'>
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
     </li>
      
      
     
   </ul>
 </li>";     */ 

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
</li>     

    
</br> */
echo "</br><center><a href='auth.php?deconnect=0'  '>
 <p>Se déconnecter</p>
</a></center>
 
</br></br></br></br>
";    
}


//FIN WEBMASTER

 

//administrateur
 

 




?>