<?php  
 echo "<html>
 <head>
   <meta charset='utf-8'></head>";
 function visuelnote($note){
	if($note=='0.00'){ 
		$note='0';
	}
	if($note!='0.00'){ 
	  if(substr($note,-2)=='00'){ 
	   $note=trim($note,"00");
	   $note=trim($note,".");
	  }
    }
		return $note;
   }


function format($date){
	$a=substr($date,0,4);
	
	$m=substr($date,5,2);
	
	$j=substr($date,8,2);
	
	$dat=$j.".".$m.".".$a;
	return $dat;
	} 
	function format2($date){
		$j=substr($date,0,2);
		
		$m=substr($date,3,2);
		
		$a=substr($date,6,4);
		
		$dat=$a.".".$m.".".$j;
		return $dat;
		} 

	
		



function nomclasse($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM classe";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idclasse']==$idop){ 
			$op=$donnees['nomclasse'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}
 
function nomatiere($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM matiere";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idmatiere']==$idop){ 
			$op=$donnees['nomatiere'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function videolecon($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT idlecon,nomlecon,video FROM lecon";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=$donnees['video'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function couperchap($idop){
	$len=strlen($idop);
	 
	$ch="";
	for($i=0;$i<$len;$i++){
       if($i%28==0 AND $i!=0){
		$ch=$ch."-<br>".$idop[$i];
	   }
	   else{
		$ch=$ch.$idop[$i];
	   }
	}
	return $ch;

}



function couperchapi2($idop){
	$len=strlen($idop);
	 
	$ch="";
	for($i=0;$i<$len;$i++){
       if($i%55==0 AND $i!=0){
		$ch=$ch."-<br>".$idop[$i];
	   }
	   else{
		$ch=$ch.$idop[$i];
	   }
	}
	return $ch;

}

function couperchapi3($idop){
	$len=strlen($idop);
	 
	$ch="";
	for($i=0;$i<$len;$i++){
       if($i%40==0 AND $i!=0){
		$ch=$ch."-<br>".$idop[$i];
	   }
	   else{
		$ch=$ch.$idop[$i];
	   }
	}
	return $ch;

}


function qtierensg($idutil){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
		 $nom=$donnees['quartier'];  
		}
	} 
	$reponse->closeCursor(); 
	return $nom;
}


function evalutout($idclas,$idmat){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM estevalue WHERE idclasse='".$idclas."' AND idmatiere='".$idmat."'";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() )
	{
		if($donnees['nom']!=" "){ 
		 $true++;  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}



function evaludat($idclas,$idmat,$dat){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM estevalue WHERE idclasse='".$idclas."' AND idmatiere='".$idmat."'";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() )
	{
		if($donnees['nom']!=" " AND $donnees['date']==$dat){ 
		 $true++;  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}

function evaludatp($idclas,$idmat,$dat1,$dat2){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM estevalue WHERE idclasse='".$idclas."' AND idmatiere='".$idmat."'";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch()  )
	{
		if($donnees['nom']!=" " AND $donnees['date']>=$dat1 AND $donnees['date']<=$dat2){ 
		 $true++;  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}







   function examtout($idclas,$idmat){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 
	 $true=0; $nom= " "; $nomo= " ";
	 $chap="SELECT * FROM session   ORDER BY ordre DESC";
          $rep = $bdd->query($chap);
          
          while ($don = $rep->fetch()){
            $idsession=$don['idsession'];
            $nomsession=$don['nomsession'];
            $ord=$don['ordre'];
            $nom="examenpdf/exampdf".$idmat."-".$idclas."-".$idsession.".pdf";
            if(file_exists($nom)!=0){
              $true++; $nomo=$nomo.", ".$nomsession;
            }
        
        } 
          $rep->closeCursor();  
		  return $true."-".$nomo;
}



function examdat($idclas,$idmat,$dat){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $true=0; $nom= " "; $nomo= " ";
	 $chap="SELECT * FROM session   ORDER BY ordre DESC";
          $rep = $bdd->query($chap);
          
          while ($don = $rep->fetch()){
            $idsession=$don['idsession'];
            $nomsession=$don['nomsession'];
            $ord=$don['ordre'];
            $nom="examenpdf/exampdf".$idmat."-".$idclas."-".$idsession.".pdf";
            if(file_exists($nom)!=0){
				if(date("Y.m.d",filemtime($nom))==$dat){ 
              $true++;  $nomo=$nomo.", ".$nomsession;
			     }
            }
        } 
          $rep->closeCursor();  
		   return $true."-".$nomo;
   }

function examdatp($idclas,$idmat,$dat1,$dat2){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $true=0; $nom= " "; $nomo= " ";
	 $chap="SELECT * FROM session   ORDER BY ordre DESC";
          $rep = $bdd->query($chap);
          
          while ($don = $rep->fetch()){
            $idsession=$don['idsession'];
            $nomsession=$don['nomsession'];
            $ord=$don['ordre'];
            $nom="examenpdf/exampdf".$idmat."-".$idclas."-".$idsession.".pdf";
            if(file_exists($nom)!=0){
				if(date("Y.m.d",filemtime($nom))>=$dat1 AND date("Y.m.d",filemtime($nom))<=$dat2){ 
              $true++; $nomo=$nomo.", ".$nomsession;
			     }
            }
        } 
          $rep->closeCursor();  
		    return $true."-".$nomo;
}






function vilensg($idutil){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
		 $nom=$donnees['ville'];  
		}
	} 
	$reponse->closeCursor(); 
	return $nom;
}

function verifensg($idutil){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
		 $true=$donnees['idenseign'];  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}

function verifensgcomp($idutil,$idmat,$idclas){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM ensmatclas ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil AND $donnees['idmat']==$idmat  AND $donnees['idclas']==$idclas){ 
		 $true=$donnees['idemc'];  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}


function verifviensg($idu,$ville){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idu AND $donnees['ville']==$ville){ 
		 $true=$donnees['idenseign'];  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}


function verifqtensg($idu,$qtier){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idu AND $donnees['quartier']==$qtier){ 
		 $true=$donnees['idenseign'];  
		}
	} 
	$reponse->closeCursor(); 
	return $true;
}



function imagensg($idu){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 $true=0; $nom= "user.png";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idu){ 
		 $nom=$donnees['photo']; 
		 $true=1; 
		}
	} 
	$reponse->closeCursor(); 
	return $nom;
}


  function completname($idutil){
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
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
			$nom=$donnees['nom']." ".$donnees['prenom']; 
		 $true=$donnees['idutilisateur']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $nom;
}



function namekonto($idutil){
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
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
			$nom=$donnees['nom']; 
		 $true=$donnees['idutilisateur']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $nom;
}

function vornamekonto($idutil){
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
	 $true=0; $nom= " ";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
			$nom=$donnees['prenom']; 
		 $true=$donnees['idutilisateur']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $nom;
}



  function infosdemande($idemand){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM demande ";
	 $reponse = $bdd->query($v);
	   
	 $true=0; $genresouh= "|"; $date= "|"; $heure= "|"; $idclasse= "|";
	   $idutilisateur= "|";  $idmomentouch= "|";   $lieusouh= "|";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idemande']==$idemand){ 
			  $genresouh=$donnees['genresouh'];
			$date=$donnees['date'];  $heure=$donnees['heure'];  
			   $idclasse=$donnees['idclasse']; 
			   $idutilisateur=$donnees['idutilisateur'];  $idmomentouch=$donnees['idmomentouch']; 
			  $lieusouh=$donnees['lieusouh']; 
			  if($lieusouh==" " OR empty($lieusouh)) { $lieusouh= "|";} 
			  
		 
		 $true=$donnees['idemande']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $genresouh."@".$date."@".$heure."@".$idclasse."@".$idutilisateur."@".$idmomentouch."@".$lieusouh;
}


 function infoseanc($idseanc){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM seance ORDER BY idseance DESC ";
	 $reponse = $bdd->query($v);
	   
	 $true=0; $idestsollicitee= "|"; $nomdeb= "|"; $statutdeb= "|"; $nomfin= "|";
	   $statutfin= "|";  $idenseign= "|";   $dateseance= "|";
	     $heuredeb= "|";  $heurefin= "|";   $duree= "|";
		   $taux= "|";  $total= "|";   $decision= "|";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idseance']==$idseanc){ 
			  $idestsollicitee=$donnees['idestsollicitee'];
			$nomdeb=$donnees['nomdeb'];  $statutdeb=$donnees['statutdeb'];  
			   $nomfin=$donnees['nomfin']; 
			   $statutfin=$donnees['statutfin'];  $idenseign=$donnees['idenseign']; 
			  $dateseance=$donnees['dateseance']; 
			     $heuredeb=$donnees['heuredeb'];  $heurefin=$donnees['heurefin']; 
				 $duree=$donnees['duree'];  $taux=$donnees['taux']+0; 
				 $total=$donnees['total']+0;  $decision=$donnees['decisionsea']; 
			  if($nomdeb==" " OR empty($nomdeb)) { $nomdeb= "|";} 
			    if($nomfin==" " OR empty($nomfin)) { $nomfin= "|";} 
				if($heurefin==" " OR empty($heurefin)) { $heurefin= "|";} 
		 
		 $true=$donnees['idseance']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $idestsollicitee."@".$nomdeb."@".$statutdeb."@".$nomfin."@".$statutfin."@".$idenseign."@".$dateseance."@".$heuredeb."@".$heurefin."@".$duree."@".$taux."@".$total."@".$decision;
}





function infosuppuser($idutil){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM enseignant ";
	 $reponse = $bdd->query($v);
	 
	 $true=0; $ville= "|"; $cni= "|"; $photo= "|"; $planlocal= "|";
	 $dispo= "|";  $quartier= "|";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
			$photo=$donnees['photo'];
			$cni=$donnees['cni'];  $planlocal=$donnees['planlocal'];  
			$ville=$donnees['ville']; 
			 $quartier=$donnees['quartier'];  $dispo=$donnees['dispo']; 
			 
			 if($photo==" " OR empty($photo)) { $photo= "|";} 
			 if($cni==" " OR empty($cni)) { $cni= "|";}
			 if($planlocal==" " OR empty($planlocal)) { $planlocal= "|";} 
			 if($ville==" " OR empty($ville)) { $ville= "|";}
		 if($quartier==" " OR empty($quartier)) { $quartier= "|";} 
		 if($dispo=" " OR empty($dispo)) { $dispo= "|";}
		 
		 $true=$donnees['idenseign']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $photo."@".$cni."@".$planlocal."@".$ville."@".$quartier."@".$dispo;
}




 function lastsean($idestsoll){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT idseance,decisionsea,idestsollicitee FROM seance ORDER BY idseance DESC ";
	 $reponse = $bdd->query($v);
	   
	 $true=0;  $decision=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idestsollicitee']==$idestsoll){ 
		  $decision=$donnees['decisionsea']; 
		 $true=$donnees['idseance']; 
	   }
	} 
	$reponse->closeCursor(); 
	return $decision;
}


 function seancemploi($idestsoll){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM seance ORDER BY idseance DESC ";
	 $reponse = $bdd->query($v);
	   
	 $true=0; $idseance= 0; $nomdeb= "|"; $statutdeb= "|"; $nomfin= "|";
	   $statutfin= "|";  $idenseign= "|";   $dateseance= "|";
	     $heuredeb= "|";  $heurefin= "|";   $duree= "|";
		   $taux= "|";  $total= "|";   $decision= 0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idestsollicitee']==$idestsoll){ 
			  $idseance=$donnees['idseance'];
			$nomdeb=$donnees['nomdeb'];  $statutdeb=$donnees['statutdeb'];  
			   $nomfin=$donnees['nomfin']; 
			   $statutfin=$donnees['statutfin'];  $idenseign=$donnees['idenseign']; 
			  $dateseance=$donnees['dateseance']; 
			     $heuredeb=$donnees['heuredeb'];  $heurefin=$donnees['heurefin']; 
				 $duree=$donnees['duree'];  $taux=$donnees['taux']; 
				 $total=$donnees['total'];  $decision=$donnees['decisionsea']; 
			  if($nomdeb==" " OR empty($nomdeb)) { $nomdeb= "|";} 
			    if($nomfin==" " OR empty($nomfin)) { $nomfin= "|";} 
				if($heurefin==" " OR empty($heurefin)) { $heurefin= "|";} 
		 
		 $true=$donnees['idseance']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $idseance."@".$nomdeb."@".$statutdeb."@".$nomfin."@".$statutfin."@".$idenseign."@".$dateseance."@".$heuredeb."@".$heurefin."@".$duree."@".$taux."@".$total."@".$decision;
}



function calculduree($deb,$fin){
	$duree="00:00";
 $arraydeb=explode(":",$deb); $arrayfin=explode(":",$fin);
 $hd=$arraydeb[0]; $md=$arraydeb[1];   $hf=$arrayfin[0]; $mf=$arrayfin[1]; 

 if($hf>=$hd){ $diffm=$mf-$md; 
  if($diffm>=0){ 
	$diffh=$hf-$hd;
  }
  if($diffm<0){
	$diffh=$hf-$hd-1; $diffm=$diffm+60;
  }
 }

if($hf<$hd){ $diffm=$mf-$md; 
  if($diffm>=0){ 
	$diffh=$hf-$hd+24;
  }
  if($diffm<0){
	$diffh=$hf-$hd+23; $diffm=$diffm+60;
  }
 }
 if($diffh<10){$diffh="0".$diffh;} if($diffm<10){$diffm="0".$diffm;}
 $duree=$diffh.":".$diffm;
 return $duree;
}

function infokontouser($idutil){
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
	 $true=0; $nom= "|"; $pnom= "|"; $motpasse= "|"; $nomuser= "|";
	 $genre= "|"; $datenaiss= "|"; $numtelsimpl= "|"; $numtelwh= "|"; $date= "|"; $heure= "|";
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idutilisateur']==$idutil){ 
			$genre=$donnees['genre'];
			$nom=$donnees['nom'];  $pnom=$donnees['prenom'];  $motpasse=$donnees['motpasse']; 
			 $nomuser=$donnees['nomuser'];  $numtelsimpl=$donnees['numtelsimpl']; $datenaiss=$donnees['datenaiss'];
			 $numtelwh=$donnees['numtelwh']; $date=$donnees['date']; $heure=$donnees['heure'];
			 if($nom==" " OR empty($nom)) { $nom= "|";} if($pnom==" " OR empty($pnom)) { $pnom= "|";}
			 if($motpasse==" " OR empty($motpasse)) { $motpasse= "|";} if($nomuser==" " OR empty($nomuser)) { $nomuser= "|";}
		 if($genre==" " OR empty($genre)) { $genre= "|";} if($datenaiss==" " OR empty($datenaiss)) { $datenaiss= "|";}
		if($numtelsimpl==" " OR empty($numtelsimpl)) { $numtelsimpl= "|";}	
		if($numtelwh==" " OR empty($numtelwh)) { $numtelwh= "|";} if($date==" " OR empty($date)) { $date= "|";}	
		if($heure==" " OR empty($heure)) { $heure= "|";}	
		 $true=$donnees['idutilisateur']; 
		  
		}
	} 
	$reponse->closeCursor(); 
	return $nom."@".$pnom."@".$motpasse."@".$nomuser."@".$genre."@".$datenaiss."@".$numtelsimpl."@".$numtelwh."@".$date."@".$heure;
}



function note($idlecon,$idutil){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM note";
	 $reponse = $bdd->query($v);
	 $op=" "; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idlecon AND $donnees['idutilisateur']==$idutil){ 
			$op=$donnees['texte'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function idnote($idlecon,$idutil){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM note";
	 $reponse = $bdd->query($v);
	 $op=0; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idlecon AND $donnees['idutilisateur']==$idutil){ 
			$op=$donnees['idnote'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function nomchap($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM chapitre";
	 $reponse = $bdd->query($v);
	 $op=" "; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idchapitre']==$idop){ 
			$op=$donnees['nomchapitre'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}


function nomlecon($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM lecon";
	 $reponse = $bdd->query($v);
	 $op=" "; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=$donnees['nomlecon'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function imagelecon($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM lecon";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=$donnees['image'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}
function imagexo($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM exercice";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=$donnees['image'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}


function imagexoexist($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM exercice";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=$donnees['image'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}



function nomsession($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM session";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idsession']==$idop){ 
			$op=$donnees['nomsession'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function datelecon($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM lecon";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=format($donnees['date'])." ".$donnees['heure'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function ordlecon($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM lecon";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idlecon']==$idop){ 
			$op=$donnees['ordre'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}

function ordchap($idop){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM chapitre";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idchapitre']==$idop){ 
			$op=$donnees['ordre'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}


function idestenseigne($idcl,$idmat){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM estenseigne";
	 $reponse = $bdd->query($v);
	 $op="0"; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idclasse']==$idcl AND $donnees['idmatiere']==$idmat){ 
			$op=$donnees['idestenseigne'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}



function momentsouh($idmom){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM momentsouh";
	 $reponse = $bdd->query($v);
	 $op=" "; $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idmomentouch']==$idmom){ 
			$op=$donnees['libelle'];  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $op;
}


function genre($id){
	$c=" ";
 if($id==1){
	$c="Masculin";
 }
 if($id==2){
	$c="Féminin";
 }
 if($id==3){
	$c="Peu importe";
 }
  
	return $c;


}


  function comparaisonheure($min1,$max1,$min2, $max2){
 $ok=0; //   $min2, $max2 poruor la base
 if($max1<=$min2 OR $max2<=$min1){
    $ok=1;
 }
 return $ok;
}



  function disponibilite($iduser,$jr,$min1,$max1){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	  $v="SELECT idenseign,duree,horairedeb,jourcours,decision FROM  estsollicitee";
	 $reponse = $bdd->query($v);
	   $true=1; 
	while ($donnees = $reponse->fetch() AND $true==1)
	{
		  $min2=$donnees['horairedeb'];  $max2=$min2+$donnees['duree'];
		  
		   if($donnees['jourcours']==$jr AND $donnees['idenseign']==$iduser AND $donnees['decision']==0 ){ 
              $ok=comparaisonheure($min1,$max1,$min2, $max2);
			  if($ok==0){
			  $true=0;
			}
			
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true; // 1 CEST ORK
}





function nomjour($id){
	if($id==0){
		return "Aucun";
	 }
	if($id==1){
	   return "Lundi";
	}
	if($id==2){
	   return "Mardi";
	}
	if($id==3){
	   return "Mercredi";
	}
	if($id==4){
		return "Jeudi";
	 }
	 if($id==5){
		return "Vendredi";
	 }
	 if($id==6){
		return "Samedi";
	 }
	 if($id==7){
		return "Dimanche";
	 }
   
   }

   function nomheure($id){
	 
	if($id==1){
	   return "08:00";
	}
	if($id==2){
	   return "09:00";
	}
	if($id==3){
	   return "10:00";
	}
	if($id==4){
		return "11:00";
	 }
	 if($id==5){
		return "12:00";
	 }
	 if($id==6){
		return "13:00";
	 }
	 if($id==7){
		return "14:00";
	 }
	 if($id==8){
		return "15:00";
	 }
	 if($id==9){
		return "16:00";
	 }
	 if($id==10){
		return "17:00";
	 }
	 if($id==10.5){
		return "17:30";
	 }
	 if($id==11){
		return "18:00";
	 }
	 if($id==11.5){
		return "18:30";
	 }
	 if($id==12){
		return "19:00";
	 }
	 
   
   }



 function actifemploi($id){
	if($id==1){
		return "Non actif";
	 }
	else { 
	   return "Actif";
	}
	}

   function nomduree($id){
	 
	if($id==1){
	   return "01:00";
	}
	if($id==1.5){
		return "01:30";
	 }
	if($id==2){
	   return "02:00";
	}
	if($id==2.5){
		return "02:30";
	 }
	if($id==3){
	   return "03:00";
	}
	if($id==3.5){
		return "03:30";
	 }
	if($id==4){
		return "04:00";
	 }
	 if($id==4.5){
		return "04:30";
	 }
	 if($id==5){
		return "05:00";
	 }
	 if($id==5.5){
		return "05:30";
	 }
	 if($id==6){
		return "06:00";
	 }
	  
   
   }



   function nomevaluation($id){
	$nom=' ';
	if($id==1){
		$nom='Evaluation 1';
	 }
	 if($id==2){
		$nom='Evaluation 2';
	 }
	 if($id==3){
		$nom='Evaluation 3';
	 }
	 if($id==4){
		$nom='Evaluation 4';
	 }
	 if($id==5){
		$nom='Evaluation 5';
	 }
	 if($id==6){
		$nom='Evaluation 6';
	 }
	 if($id==7){
		$nom='Contrôles continus';
	 }
	 if($id==8){
		$nom ="Examens blancs";
	 }
	 if($id==9){
		$nom ="TD";
	 }
   return $nom;
   }



   function mmclasse($nom){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM classe";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if(strtolower($donnees['nomclasse'])==strtolower($nom)){ 
  
			$true=$donnees['idclasse'];
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}


function mmatiere($nom){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM matiere";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if(strtolower($donnees['nomatiere'])==strtolower($nom)){ 
  
			$true=$donnees['idmatiere'];
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}



function mmchap($nom){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM chapitre";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if(strtolower($donnees['nomchapitre'])==strtolower($nom)){ 
  
			$true=$donnees['idchapitre'];
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}


function mmlecon($nom){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM lecon";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if(strtolower($donnees['nomlecon'])==strtolower($nom)){ 
  
			$true=$donnees['idlecon'];
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}



function existestenseigne($idcl,$idmat){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM estenseigne";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch() AND $true==0)
	{
		if($donnees['idclasse']==$idcl AND $donnees['idmatiere']==$idmat){ 
  
			$true=$donnees['idestenseigne'];
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}


function nbrelecon($idchap){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM chapitre";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch())
	{
		if($donnees['idchapitre']==$idchap){ 
  
			$true++;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}



function existordre($ordr){
	try 
	{
	 $bdd = new PDO(host(),UTIL(),mtp());  
	 } 
	 catch(Exception $e) 
	 {       
	 die('Erreur : '.$e->getMessage());
	 }
	 $v="SELECT * FROM lecon";
	 $reponse = $bdd->query($v);
	   $true=0;
	while ($donnees = $reponse->fetch())
	{
		if($donnees['ordre']==$ordr){ 
  
			$true=1;
		}
	} 
	$reponse->closeCursor(); 
	 
	return $true;
}






echo "</html>";
?>