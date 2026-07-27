<?php
 
require 'lien.php';



function verifadmin($user,$mot){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
	$v="SELECT * FROM admin ";
	 $reponse = $bdd->query($v);
	 $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['emailadm']==$user AND $donnees['mtpadm']==$mot){ 
		 $true=$donnees['idamin']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
   }


   function verifuser($user,$mot){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
	$v="SELECT * FROM utilisateur ";
	 $reponse = $bdd->query($v);
	 $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['nomuser']==$user AND $donnees['motpasse']==$mot){ 
		 $true=$donnees['idutilisateur']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
   }

  





function timestampajour(){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
 $nb=0;
 $f="SELECT COUNT(*) AS n  FROM enligne WHERE  adrip='".$_SERVER['REMOTE_ADDR']."' " ;
 $rep=$bdd->query($f);
 while ($donnee=$rep->fetch())
 {
  $nb=$donnee['n'];   
 }
 $rep->closeCursor();
 $date=date('Y.m.d');
 $heur=date('H:i');
 $idresp=0; $typeap=0; $typeutil=0;
 if(isset($_SESSION['wegonlinenum'])){
$idresp=$_SESSION['wegonlinenum'];
if($idresp==0){ $typeutil=0;}
if($idresp!=0){ $typeutil=1;}
 }

 if(isset($_SESSION['gouser']) AND isset($_SESSION['gomot'])){
$idresp=verifadmin($_SESSION['gouser'],$_SESSION['gomot']);
if($idresp==0){ $typeutil=0;}
if($idresp!=0){ $typeutil=2;}
 } 

 $isMob=is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"mobile"));
 if($isMob){
$typeap=0; // TELEPHONE
 }
 if(!$isMob){
$typeap=1;  // ORDINATEUR
 }

  if($nb==0){
	 $reqq1=$bdd->prepare('INSERT INTO enligne(idresp,dateligne,heureligne,
	 adrip,typeappareil,marque,temps,reponse,typeutil)
	 VALUES(?,?,?,?,?,?,?,?,?)');
	$reqq1->execute(array($idresp,$date,$heur,
 $_SERVER['REMOTE_ADDR'],$typeap,'marque',time(),0,$typeutil));   
		 
  }
  else{
	$r="UPDATE enligne SET dateligne='".$date."' WHERE adrip='".$_SERVER['REMOTE_ADDR']."'";
	$req=$bdd->query($r);
	$r="UPDATE enligne SET typeutil='".$typeutil."' WHERE adrip='".$_SERVER['REMOTE_ADDR']."'";
	$req=$bdd->query($r);
	$r="UPDATE enligne SET idresp='".$idresp."' WHERE adrip='".$_SERVER['REMOTE_ADDR']."'";
	$req=$bdd->query($r);
	$r="UPDATE enligne SET temps='".time()."' WHERE adrip='".$_SERVER['REMOTE_ADDR']."'";
	$req=$bdd->query($r);
  }
	$max=time()-300 ;  
	$r="DELETE FROM enligne WHERE temps<'".$max."'";
	$req=$bdd->query($r);
   }
   




   function tentative_connexion(){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
 $date=date('Y.m.d');
 $heur=date('H:i');

$idresp=0; $typeap=0; $typeutil=0;
 if(isset($_SESSION['wegonlinenum'])){
$idresp=$_SESSION['wegonlinenum'];
if($idresp==0){ $typeutil=0;}
if($idresp!=0){ $typeutil=1;}
 }

 if(isset($_SESSION['gouser']) AND isset($_SESSION['gomot'])){
$idresp=verifadmin($_SESSION['gouser'],$_SESSION['gomot']);
if($idresp==0){ $typeutil=0;}
if($idresp!=0){ $typeutil=2;}
 } 

 $isMob=is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"mobile"));
 if($isMob){
$typeap=0; // TELEPHONE
 }
 if(!$isMob){
$typeap=1;  // ORDINATEUR
 }


 
  $temps=time();
   $reqq1=$bdd->prepare('INSERT INTO auditconnexion (idresp,dateaudit,heureaudit,
	adrip,typeappareil,marque,appareil,temps,reponse,typeutil)
	VALUES(?,?,?,?,?,?,?,?,?,?)');
   $reqq1->execute(array($idresp,$date,$heur,
  $_SERVER['REMOTE_ADDR'],$typeap,'marque','appareil',$temps,'0',$typeutil));   
 
  
  
   
   }



    function pourcomptervisite(){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
 $date=date('Y.m.d');
 $heur=date('H:i');

$idresp=0; $typeap=0; $typeutil=0;
   
 $v="SELECT idresp,idaudit,adrip,temps  FROM auditconnexion ORDER BY idaudit DESC ";
	 $reponse = $bdd->query($v);
	 $true=0; $min=0; $max=0; $idaudit=0;
	while ($donnees = $reponse->fetch() AND $true<=1)
	{ 
		if($donnees['adrip']==$_SERVER['REMOTE_ADDR']){ 
			
			if($true==0){ 
				$idaudit=$donnees['idaudit'];
		       $max=$donnees['temps'];
		    }
			if($true==1){ 
		       $min=$donnees['temps'];
		    }
			 $true++;
			  }
			$diff=$max-$min; 
			if($diff>300) { // 5 min
               $r="UPDATE  auditconnexion SET etab='1' WHERE idaudit='".$idaudit."'";
	$req=$bdd->query($r);
			}
	} 
	$reponse->closeCursor(); 
  
  
   
   }
  
   timestampajour(); tentative_connexion();  pourcomptervisite();

   function useronline(){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
	$v="SELECT idresp,adrip,typeutil  FROM enligne ";
	 $reponse = $bdd->query($v);
	 $all=0; $nonidentifie=0; $konto=0; $admin=0;
	while ($donnees = $reponse->fetch() )
	{
		if($donnees['adrip']!=$_SERVER['REMOTE_ADDR']){ 
			if($donnees['typeutil']==0){ 
		       $nonidentifie++;
		    }
			if($donnees['typeutil']==1){ 
		       $konto++;
		    }
			if($donnees['typeutil']==2){ 
		       $admin++;
		    }
			$all++;
			  }
	} 
	$reponse->closeCursor(); 
	$ensb=$all."-".$nonidentifie."-".$konto."-".$admin;
	return $ensb;
 

}

function nbreverbinden($date,$monadrip){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
  


 
	$tabadrip=array();   
 
	$v="SELECT DISTINCT adrip  FROM auditconnexion WHERE dateaudit='".$date."' 
  AND typeutil!='2'  ";
  
 
	 $reponse = $bdd->query($v);
	 $i=0;  
	while ($donnees = $reponse->fetch() )
	{
		$tabadrip[$i]= $donnees['adrip'];	
		$i++;
			 
	} 
	$reponse->closeCursor(); 

	$total=count($tabadrip);
	$som=0;
	if($total>0){  
		for($j=0; $j<$total; $j++){
			$ip=$tabadrip[$j];   
			$preced=0;
			if($monadrip==0){   // SANS MOI
	          $v="SELECT adrip,typeutil,dateaudit,temps  FROM auditconnexion WHERE dateaudit='".$date."' 
             AND  typeutil!='2' AND adrip='".$ip."' AND adrip!='".$_SERVER['REMOTE_ADDR']."'";
			   $reponse = $bdd->query($v);
			 while ($donnees = $reponse->fetch() )
	          {
		         $val= $donnees['temps'];    
				 $diff=$val-$preced;   
				 if($diff>300){   // 5 Minutes
                    $som++;
				 }	
		         $preced=$val;
			 
	           } 
	          $reponse->closeCursor(); 

           }
             if($monadrip==1){   // AVEC MOI
	          $v="SELECT  adrip,typeutil,dateaudit,temps  FROM auditconnexion WHERE dateaudit='".$date."' 
               AND typeutil!='2'  AND adrip='".$ip."' ";
			   $reponse = $bdd->query($v);
			 while ($donnees = $reponse->fetch() )
	          {
		         $val= $donnees['temps'];    
				 $diff=$val-$preced;  
				 if($diff>300){   // 5 Minutes
                    $som++;
				 }	
		         $preced=$val;
			 
	           } 
	          $reponse->closeCursor(); 

           }
            
		}
	}
 	
 return $som;


}






function pagesvisites($date,$monadrip){
	try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
  
if($monadrip==0){   // SANS MOI
	$v="SELECT adrip,typeutil,dateaudit,temps  FROM auditconnexion WHERE dateaudit='".$date."' 
               AND typeutil!='2'  AND adrip!='".$_SERVER['REMOTE_ADDR']."'";
}
if($monadrip==1){   // AVEC MOI
	$v="SELECT adrip,typeutil,dateaudit,temps  FROM auditconnexion WHERE dateaudit='".$date."' 
               AND typeutil!='2'";
}
	 $reponse = $bdd->query($v);
	 $i=0;  
	while ($donnees = $reponse->fetch() )
	{
	$i++;
			 
	} 
	$reponse->closeCursor(); 
	
return $i;
}


   ?>
 