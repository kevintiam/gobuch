<?php 
session_cache_limiter('private_no_expire,must-revalidate');session_start();
require 'connectC.php';  require 'lesmenus.php'; require 'lesfunctions.php';
//  require 'phptest/vendor/autoload.php';
 // echo rand(0,9999); 
  try 
  {
   $bdd = new PDO(host(),UTIL(),mtp());  
   } 
   catch(Exception $e) 
   {       
   die('Erreur : '.$e->getMessage());
   }

if(isset($_POST['enregnote'])){
  if($_POST['enregnote']!=0){
    $r="UPDATE note SET texte='".$_POST['note']."' WHERE idnote='".$_POST['enregnote']."'";
      $req=$bdd->query($r);
      header('location:cours.php');
  }
  if($_POST['enregnote']==0){
    $idutil=1;
    $reqq=$bdd->prepare('INSERT INTO note(idlecon,idutilisateur,texte) VALUES( ?,?,?)');
    $reqq->execute(array($_SESSION['idleconc'],$idutil,$_POST['note'])); 
      header('location:cours.php');
  }
}





if(isset($_POST['addnewemp'])){
  $idemande=$_POST['addnewemp'];
  $jr=$_POST['day'];
 $deb=$_POST['debut'];  $duree=$_POST['duree'];
  $fin=$deb+$duree;
   $matiere=$_POST['matie'];  $clas=$_POST['clax'];
    $taux=$_POST['taux']; $total=$_POST['total'];
     $tauxtu=$_POST['tauxtu'];  $totaltu=$_POST['totaltu'];
        $da=date('Y.m.d'); $he=date('H:i');
    
     if(isset($_POST['cocher'])){
      $usar=$_POST['cocher'];
       $disponibilite= disponibilite( $usar,$jr,$deb,$fin);
       if($disponibilite==1) { 
            $reqq=$bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours,th,decision,montant,tauxensei,montantensei,date,heure,datemod,heuremod) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $reqq->execute(array($idemande,$usar,$matiere,$duree,$deb,$jr,$taux,'0',$total,$tauxtu,$totaltu,$da,$he,$da,$he));
       }
     }
      if(!isset($_POST['cocher'])){
            $reqq=$bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours,th,decision,montant,tauxensei,montantensei,date,heure,datemod,heuremod) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $reqq->execute(array($idemande,' ',$matiere,$duree,$deb,$jr,$taux,'0',$total,$tauxtu,$totaltu,$da,$he,$da,$he));
      
      }
     header('location:detailadm.php');
}




if(isset($_POST['modempl'])){
  $idestsollicitee=$_POST['modempl'];
  $jr=$_POST['day'];
 $deb=$_POST['debut'];  $duree=$_POST['duree'];
  $fin=$deb+$duree;
   $matiere=$_POST['matie'];  $clas=$_POST['clax'];
    $taux=$_POST['taux']; $total=$_POST['total'];
     $tauxtu=$_POST['tauxtu'];  $totaltu=$_POST['totaltu'];
        $da=date('Y.m.d'); $he=date('H:i');
    $ancienuxer=$_POST['uxer'];  $decision=$_POST['decision'];
$oldetat=$_POST['oldetat'];
$newetat=$matiere."@".$clas."@".$jr."@".$deb."@".$duree;
   if($oldetat==$newetat){
      $r="UPDATE estsollicitee SET th='".$taux."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET montant='".$total."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET tauxensei='".$tauxtu."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET montantensei='".$totaltu."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET datemod='".$da."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET heuremod='".$he."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET heuremod='".$he."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET decision='".$decision."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      if(isset($_POST['cocher'])){
      $usar=$_POST['cocher'];
       $disponibilite= disponibilite($usar,$jr,$deb,$fin);
       if($disponibilite==1) { 
            $r="UPDATE estsollicitee SET idenseign='".$usar."' WHERE 	idestsollicitee='".$idestsollicitee."'";
             $req=$bdd->query($r);
      }
     }

   }

   if($oldetat!=$newetat){
       
      if(isset($_POST['cocher'])){
      $usar=$_POST['cocher'];
       $disponibilite= disponibilite($usar,$jr,$deb,$fin);
       if($disponibilite==1) { 
        $r="UPDATE estsollicitee SET th='".$taux."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET montant='".$total."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET tauxensei='".$tauxtu."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET montantensei='".$totaltu."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET datemod='".$da."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET heuremod='".$he."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET heuremod='".$he."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET decision='".$decision."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET idenseign='".$usar."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       
       $r="UPDATE estsollicitee SET jourcours='".$jr."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET 	horairedeb='".$deb."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET 	duree='".$duree."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      }
     }
      if(!isset($_POST['cocher'])){
         $disponibilite= disponibilite($_SESSION['mdindens'],$jr,$deb,$fin);
       if($disponibilite==1) { 
        $r="UPDATE estsollicitee SET th='".$taux."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET montant='".$total."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET tauxensei='".$tauxtu."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET montantensei='".$totaltu."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET datemod='".$da."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET heuremod='".$he."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET heuremod='".$he."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET decision='".$decision."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET idenseign='".$_SESSION['mdindens']."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET jourcours='".$jr."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
       $r="UPDATE estsollicitee SET 	horairedeb='".$deb."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      $r="UPDATE estsollicitee SET 	duree='".$duree."' WHERE 	idestsollicitee='".$idestsollicitee."'";
      $req=$bdd->query($r);
      }  
      }  
    }

     header('location:searperiod.php');
}


   if(isset($_POST['supperiodem'])){
$idestsollicitee=$_POST['supperiodem'];
  $rdw="DELETE FROM estsollicitee  WHERE idestsollicitee='".$idestsollicitee."'";
  $reqdw=$bdd->query($rdw);
 header('location:detailadm.php');
}

 if(isset($_POST['supperioduser'])){
  $idestsollicitee=$_POST['supperioduser'];
  $rdw="DELETE FROM estsollicitee  WHERE idestsollicitee='".$idestsollicitee."'";
  $reqdw=$bdd->query($rdw);
   $_SESSION['getok']=1;
 header('location:leskontodet.php');
}


if(isset($_POST['enregavis'])){
  $adrip=$_SERVER['REMOTE_ADDR'];
  $avis=$_POST['avis'];
   $da=date('Y.m.d'); $he=date('H:i');
 $reqq=$bdd->prepare('INSERT INTO avis(contavis,adrip,date,heure) VALUES( ?,?,?,?)');
  $reqq->execute(array($avis,$adrip, $da,$he)); 
  
   
    header('location:index.php');
}


 if(isset($_POST['enregms'])){
  $adrip=$_SERVER['REMOTE_ADDR'];
  $avis=$_POST['avis'];
   $da=date('Y.m.d'); $he=date('H:i');
  $reqq=$bdd->prepare('INSERT INTO nouscontacter(contcon,adrip,date,heure) VALUES( ?,?,?,?)');
  $reqq->execute(array($avis,$adrip, $da,$he)); 
  
   
    header('location:index.php');
}

if(isset($_POST['envoinum'])){
  $_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
  $numtel=$_POST['tel'];
   $da=date('Y.m.d'); $he=date('H:i');
 $reqq=$bdd->prepare('INSERT INTO visiteurlaisse(tel,adrip,date,heure) VALUES( ?,?,?,?)');
  $reqq->execute(array($numtel,$_SERVER['REMOTE_ADDR'], $da,$he)); 
  $_SESSION['numrepetok']=2;
   
    header('location:cours.php');
}

 

if(isset($_POST['loguer'])){
  $_SESSION['gouser']=$_POST['nom'];
  $_SESSION['gomot']=$_POST['mot'];
   $verif=verifadmin($_SESSION['gouser'],$_SESSION['gomot']);
   if($verif==0){
    header('location:auth.php');
  }
  if($verif!=0){
    $_SESSION['goid']=$verif;
    header('location:organiser.php');
  }
   }
   
    

if(isset($_GET['telechlecon'])){
       
    $id=$_GET['telechlecon'];  echo $id;
    $nom="lecon".$id."-pdf.pdf";
    $filename="leconpdf/".$nom;
    header("Content-Type:application/force-download");
    header("Content-Disposition:attachement; filename=".$nom);
     readfile($filename);
  //  header('location:deposuj1.php');
  }


  if(isset($_GET['telechexolecon'])){
       
    $id=$_GET['telechexolecon'];  echo $id;
    $nom="exo".$id."-pdf.pdf";
    $filename="exercicepdf/".$nom;
    header("Content-Type:application/force-download");
    header("Content-Disposition:attachement; filename=".$nom);
     readfile($filename);
  //  header('location:deposuj1.php');
  }

  if(isset($_GET['idsession']) AND isset($_GET['idcours'])){
    
    
    $nom="exampdf".$_GET['idcours']."-".$_SESSION['classec']."-".$_GET['idsession'].".pdf";
    $filename="examenpdf/".$nom;
    $nom2=nomatiere($_GET['idcours'])."_".nomclasse($_SESSION['classec'])."_session".nomsession($_GET['idsession']);
    header("Content-Type:application/force-download");
    header("Content-Disposition:attachement; filename=".$nom);
     readfile($filename);
    
   //  header('location:examensgen.php');
  }




  if(isset($_POST['connaccount'])){
    $user=$_POST['user'];
    $mot=$_POST['user'];
    $date=date('Y.m.d'); $heure=date('H:i');
    $verif=verifuser($user,$mot);
    if($verif!=0){
      $_SESSION['wegonlinenum']=$verif;
      $_SESSION['wegonlinenom']=namekonto($_SESSION['wegonlinenum']);
      $_SESSION['wegonlineprnm']=vornamekonto($_SESSION['wegonlinenum']);
    }
    header('location:index.php');
  }



if(isset($_POST['konnacco'])){
    $user=$_POST['user'];
    $mot=$_POST['user'];
    $date=date('Y.m.d'); $heure=date('H:i');
    $verif=verifuser($user,$mot);
    if($verif==0){
header('location:dmdcon.php');
    }
    if($verif!=0){
      $_SESSION['wegonlinenum']=$verif;
      $_SESSION['wegonlinenom']=namekonto($_SESSION['wegonlinenum']);
      $_SESSION['wegonlineprnm']=vornamekonto($_SESSION['wegonlinenum']);
       
         //CONNECTE
    $req = $bdd->prepare('INSERT INTO demande(genresouh,date,heure,idclasse,idutilisateur,idmomentouch,lieusouh) VALUES(?,?,?,?,?,?,?)'); 
      $req->execute(array($_SESSION['genresouh'],$date,$heure,$_SESSION['classesouh'],$_SESSION['wegonlinenum'],$_SESSION['periodesouh'],$_SESSION['ortsouh'])); 
        $idemande=$bdd->lastInsertId(); 
    
for($i=0;$i<$_SESSION['total'];$i++){
  $req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur1'][$i],$_SESSION['heu1'][$i],$_SESSION['jour1'][$i])); 
   }


 for($i=0;$i<$_SESSION['total'];$i++){
    $req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur2'][$i],$_SESSION['heu2'][$i],$_SESSION['jour2'][$i])); 
   
 }

 for($i=0;$i<$_SESSION['total'];$i++){
$req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur3'][$i],$_SESSION['heu3'][$i],$_SESSION['jour3'][$i])); 
     
 }
 $rdw="DELETE FROM estsollicitee WHERE jourcours='0'";
      $reqdw=$bdd->query($rdw);
 $_SESSION['okengdmd']=1;


// envoi email

$idutilinfo=infokontouser($_SESSION['wegonlinenum']);
$arrayinfo=array();
 $arrayinfo=explode("@",$idutilinfo);
 $nomb=$arrayinfo[0]; $pnomb=$arrayinfo[1]; $numb=$arrayinfo[6];
 $numbwh=$arrayinfo[7];
 if($nomb=="|") { $nomb= " ";}   if($pnomb=="|") { $pnomb= " ";} 
 if($numb=="|") { $numb= " ";}   if($numbwh=="|") { $numbwh= " ";} 
 $infinit="Noms et prénoms : ".$nomb." ".$pnomb."\r\n Tel : ".$numb." \r\n Tel Wh : ".$numbwh." \r\n Lieu : ".$_SESSION['ortsouh']." \r\n Classe : ".nomclasse($_SESSION['classesouh']).
             "\r\n Matière(s) : \r\n";
   $allsmat="-";
   
   for($i=0;$i<$_SESSION['total'];$i++){
    $smatiere=nomatiere($_SESSION['tabmat'][$i]);
    $allsmat=$smatiere." , ";
   }
 
  $contenu=$infinit." ".$allsmat;
   $emetteur="a@gmail.com";
$lsql="SELECT * FROM acontact ";
           $reponse = $bdd->query($lsql);
           $cpt=0;  
          while ($donnees = $reponse->fetch() )
          {
            $idacontact=$donnees['idacontact'];
            $numsimple=$donnees['numsimple'];
             $numwh=$donnees['numwh'];  $emailrecep=$donnees['email'];
             $objet="demande-accompagnement";
             
             mail($emailrecep,$objet,$contenu,$emetteur);
             }
          $reponse->closeCursor();


// fin envoi email









   header('location:mesdemandes.php');
    }
     
  }


  if(isset($_POST['conncreat'])){
    $nom=$_POST['nom'];   $pnom=$_POST['prenom'];
    $user=$_POST['user'];
    $mot=$_POST['user'];
    $tel=$_POST['tel'];
    $date=date('Y.m.d'); $heure=date('H:i');
    $verif=verifuser($user,$mot);
    if($verif==0){
      $req = $bdd->prepare('INSERT INTO utilisateur(nom,prenom,motpasse,nomuser,genre,datenaiss,numtelsimpl,numtelwh,date,heure) VALUES( ?,?,?,?,?,?,?,?,?,?)'); 
      $req->execute(array($nom,$pnom,$mot, $user,' ',' ',$tel,$tel,$date,$heure));  

      $verif2=verifuser($user,$mot);
      if($verif2!=0){
        $_SESSION['wegonlinenum']= $verif2;
        $_SESSION['wegonlinenom']=namekonto($_SESSION['wegonlinenum']);
        $_SESSION['wegonlineprnm']=vornamekonto($_SESSION['wegonlinenum']);
      }
    }
   
    header('location:index.php');
  }


  if(isset($_POST['conncreat2'])){
    $nom=$_POST['nom'];   $pnom=$_POST['prenom'];
    $user=$_POST['user'];
    $mot=$_POST['user'];
     
    $date=date('Y.m.d'); $heure=date('H:i');
    $verif=verifuser($user,$mot);
    if($verif==0){
      $req = $bdd->prepare('INSERT INTO utilisateur(nom,prenom,motpasse,nomuser,genre,datenaiss,numtelsimpl,numtelwh,date,heure) VALUES( ?,?,?,?,?,?,?,?,?,?)'); 
      $req->execute(array($nom,$pnom,$mot, $user,' ',' ',$_SESSION['TELsouh'],$_SESSION['TELsouh'],$date,$heure));  

      $verif2=verifuser($user,$mot);
      if($verif2!=0){
        $_SESSION['wegonlinenum']= $verif2;
        $_SESSION['wegonlinenom']=namekonto($_SESSION['wegonlinenum']);
        $_SESSION['wegonlineprnm']=vornamekonto($_SESSION['wegonlinenum']);
// INSERER DEMANDE
$req = $bdd->prepare('INSERT INTO demande(genresouh,date,heure,idclasse,idutilisateur,idmomentouch,lieusouh) VALUES(?,?,?,?,?,?,?)'); 
      $req->execute(array($_SESSION['genresouh'],$date,$heure,$_SESSION['classesouh'],$_SESSION['wegonlinenum'],$_SESSION['periodesouh'],$_SESSION['ortsouh'])); 
        $idemande=$bdd->lastInsertId(); 
    
for($i=0;$i<$_SESSION['total'];$i++){
  $req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur1'][$i],$_SESSION['heu1'][$i],$_SESSION['jour1'][$i])); 
   }


 for($i=0;$i<$_SESSION['total'];$i++){
    $req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur2'][$i],$_SESSION['heu2'][$i],$_SESSION['jour2'][$i])); 
   
 }

 for($i=0;$i<$_SESSION['total'];$i++){
$req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur3'][$i],$_SESSION['heu3'][$i],$_SESSION['jour3'][$i])); 
     
 }
 $rdw="DELETE FROM estsollicitee WHERE jourcours='0'";
      $reqdw=$bdd->query($rdw);
 $_SESSION['okengdmd']=1;
// envoi email

$infinit="Noms et prénoms : ".$nom." ".$pnom."\r\n Tel : ".$_SESSION['TELsouh']." \r\n Lieu : ".$_SESSION['ortsouh']." \r\n Classe : ".nomclasse($_SESSION['classesouh']).
             "\r\n Matière(s) : \r\n";
             $allsmat="-";
             
             for($i=0;$i<$_SESSION['total'];$i++){
             $smatiere=nomatiere($_SESSION['tabmat'][$i]);
             $allsmat=$smatiere." , ";
             }
            
            $contenu=$infinit." ".$allsmat;
            $emetteur="a@gmail.com";
            echo $contenu;
$lsql="SELECT * FROM acontact ";
           $reponse = $bdd->query($lsql);
           $cpt=0;  
          while ($donnees = $reponse->fetch() )
          {
            $idacontact=$donnees['idacontact'];
            $numsimple=$donnees['numsimple'];
             $numwh=$donnees['numwh'];  $emailrecep=$donnees['email'];
             $objet="demande-accompagnement";
             
             mail($emailrecep,$objet,$contenu,$emetteur);
             }
          $reponse->closeCursor();


// fin envoi email

  header('location:mesdemandes.php');

//FIN INSERER DEMANDE

      }
    }
    if($verif!=0){
header('location:logincreat2.php');
    }
   
     
  }







 if(isset($_POST['confirmerdmd'])){
       $date=date('Y.m.d'); $heure=date('H:i');
   $_SESSION['jour1']=array(); $_SESSION['jour2']=array();  $_SESSION['jour3']=array();
$_SESSION['heu1']=array(); $_SESSION['heu2']=array();  $_SESSION['heu3']=array();
$_SESSION['dur1']=array(); $_SESSION['dur2']=array();  $_SESSION['dur3']=array();
for($i=0;$i<$_SESSION['total'];$i++){
 $jourmat1="jourmat1".$i; $hdeb1="hdeb1".$i; $hduree1="hduree1".$i;
  $_SESSION['jour1'][$i]=$_POST[$jourmat1];
  $_SESSION['heu1'][$i]=$_POST[$hdeb1];
  $_SESSION['dur1'][$i]=$_POST[$hduree1];


   $jourmat2="jourmat2".$i; $hdeb2="hdeb2".$i; $hduree2="hduree2".$i;
  $_SESSION['jour2'][$i]=$_POST[$jourmat2];
  $_SESSION['heu2'][$i]=$_POST[$hdeb2];
  $_SESSION['dur2'][$i]=$_POST[$hduree2];

  $jourmat3="jourmat3".$i; $hdeb3="hdeb3".$i; $hduree3="hduree3".$i;
  $_SESSION['jour3'][$i]=$_POST[$jourmat3];
  $_SESSION['heu3'][$i]=$_POST[$hdeb3];
  $_SESSION['dur3'][$i]=$_POST[$hduree3];
}
if(!isset($_SESSION['wegonlinenum'])){
      // NON CONNECTE
      header('location:dmdcon.php');
    }
      if(isset($_SESSION['wegonlinenum'])){
      if($_SESSION['wegonlinenum']==0){ 
          // NON CONNECTE
           header('location:dmdcon.php');
       }
    if($_SESSION['wegonlinenum']!=0){ 
    //CONNECTE
    $req = $bdd->prepare('INSERT INTO demande(genresouh,date,heure,idclasse,idutilisateur,idmomentouch,lieusouh) VALUES(?,?,?,?,?,?,?)'); 
      $req->execute(array($_SESSION['genresouh'],$date,$heure,$_SESSION['classesouh'],$_SESSION['wegonlinenum'],$_SESSION['periodesouh'],$_SESSION['ortsouh'])); 
        $idemande=$bdd->lastInsertId(); 
for($i=0;$i<$_SESSION['total'];$i++){
    
   $req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur1'][$i],$_SESSION['heu1'][$i],$_SESSION['jour1'][$i])); 
    
 
 }


 for($i=0;$i<$_SESSION['total'];$i++){
  
   $req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur2'][$i],$_SESSION['heu2'][$i],$_SESSION['jour2'][$i])); 
   
 }

 for($i=0;$i<$_SESSION['total'];$i++){
 
$req = $bdd->prepare('INSERT INTO estsollicitee(idemande,idenseign,idmatiere,duree,horairedeb,jourcours) VALUES(?,?,?,?,?,?)'); 
      $req->execute(array($idemande,' ',$_SESSION['tabmat'][$i],$_SESSION['dur3'][$i],$_SESSION['heu3'][$i],$_SESSION['jour3'][$i])); 
     
 }
  $rdw="DELETE FROM estsollicitee WHERE jourcours='0'";
      $reqdw=$bdd->query($rdw);
 $_SESSION['okengdmd']=1;



//debut envoi email
 $idutilinfo=infokontouser($_SESSION['wegonlinenum']);
$arrayinfo=array();
 $arrayinfo=explode("@",$idutilinfo);
 $nomb=$arrayinfo[0]; $pnomb=$arrayinfo[1]; $numb=$arrayinfo[6];
 $numbwh=$arrayinfo[7];
 if($nomb=="|") { $nomb= " ";}   if($pnomb=="|") { $pnomb= " ";} 
 if($numb=="|") { $numb= " ";}   if($numbwh=="|") { $numbwh= " ";} 
 $infinit="Noms et prénoms : ".$nomb." ".$pnomb."\r\n Tel : ".$numb." \r\n Tel Wh : ".$numbwh." \r\n Lieu : ".$_SESSION['ortsouh']." \r\n Classe : ".nomclasse($_SESSION['classesouh']).
             "\r\n Matière(s) : \r\n";
   $allsmat="-";
   
   for($i=0;$i<$_SESSION['total'];$i++){
    $smatiere=nomatiere($_SESSION['tabmat'][$i]);
    $allsmat=$smatiere." , ";
   }
 
  $contenu=$infinit." ".$allsmat;
   $emetteur="a@gmail.com";
$lsql="SELECT * FROM acontact ";
           $reponse = $bdd->query($lsql);
           $cpt=0;  
          while ($donnees = $reponse->fetch() )
          {
            $idacontact=$donnees['idacontact'];
            $numsimple=$donnees['numsimple'];
             $numwh=$donnees['numwh'];  $emailrecep=$donnees['email'];
             $objet="demande-accompagnement";
             
             mail($emailrecep,$objet,$contenu,$emetteur);
             }
          $reponse->closeCursor();


// fin envoi email
  header('location:mesdemandes.php');
     }
 }

      
 
   
  }



  if(isset($_GET['idsessiongp']) ){
    
    
    $nom="exampdf".$_SESSION['idmatierex']."-".$_SESSION['classec']."-".$_GET['idsessiongp'].".pdf";
    $filename="examenpdf/".$nom;
    $nom2=nomatiere($_SESSION['nomatierex'])."_".nomclasse($_SESSION['classec'])."_session".nomsession($_GET['idsessiongp']);
    header("Content-Type:application/force-download");
    header("Content-Disposition:attachement; filename=".$nom);
     readfile($filename);
    
   //  header('location:examensgen.php');
  }


  if(isset($_GET['idevaltelech']) ){
    
    
    $nom=$_GET['idevaltelech'];
    $filename="evaluation/".$_GET['idevaltelech']; 
    // debut filigrane

    /*
      $watermarkText = htmlspecialchars('gobuch.com' ?? 'gobuch.com', ENT_QUOTES, 'UTF-8');
      $inputPath = $filename;
      $outputPath = $filename;
      $monPdf = new Fpdi();

    $monPdf->SetCreator('gobuch.com');
    $monPdf->SetAuthor('gobuch.com);
    $monPdf->SetTitle('gobuch.com');

    $pageCount = $monPdf->setSourceFile($inputPath);

    for ($i = 1; $i <= $pageCount; $i++) {
        $page = $monPdf->importPage($i);
        $size = $monPdf->getTemplateSize($page);

        $monPdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $monPdf->useTemplate($page);

        $monPdf->SetFont('DejaVuSans', 'B', 100);
        $monPdf->SetTextColor(200, 200, 200);

        $monPdf->SetAlpha(0.3);
        $monPdf->StartTransform();
        $monPdf->Rotate(45, $size['width'] / 2, $size['height'] / 2);

        $centerX = $size['width'] / 2;
        $centerY = $size['height'] / 2;

        $monPdf->Text($centerX - 100, $centerY, $watermarkText);

        $monPdf->StopTransform();
        $monPdf->SetAlpha(1);
    }

    $monPdf->Output($outputPath, 'F');
    header("Location: download.php?file=" . urlencode(basename($outputPath)));
    */

    // fin filigrane
    header("Content-Type:application/force-download");
    header("Content-Disposition:attachement; filename=".$nom);
     readfile($filename);
    
   //  header('location:examensgen.php');
  }



  if(isset($_POST['supexam']) ){
    
    $nom2="exampdf".$_SESSION['idmatierex']."-".$_SESSION['classec']."-2.pdf";
    $nom="exampdf".$_SESSION['idmatierex']."-".$_SESSION['classec']."-".$_POST['supexam'].".pdf";
    $dir="examenpdf/".$nom;
     $rdw="DELETE FROM examine  WHERE pdf='".$nom2."'";
    $reqdw=$bdd->query($rdw);
     
    unlink($dir);
    
    header('location:examensgen2.php');
  }

  if(isset($_POST['supexamadm']) ){
    
    $nom2="exampdf".$_SESSION['idmatierex']."-".$_SESSION['classec']."-2.pdf";
    $nom="exampdf".$_SESSION['idmatierex']."-".$_SESSION['classec']."-".$_POST['supexam'].".pdf";
    $dir="examenpdf/".$nom;
     $rdw="DELETE FROM examine  WHERE pdf='".$nom2."'";
    $reqdw=$bdd->query($rdw);
     
    unlink($dir);
    
    header('location:examensgen2adm.php');
  }

  if(isset($_POST['ajtexam'])){ 
     
     $nom=$_FILES["fichexam"]["name"]; // on recupere le nom de l'image avec son extension
     $taille=$_FILES["fichexam"]["size"];  //optionnelle, mnt vous avez la taille
     $idsession=$_POST['ajtsession'];
     $idmat=$_POST['ajtmatex'];
     list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    

     $verif=0;
     $verif1=0; 
       
       $ext=".".strtolower($ext); // on rajoute un . devant l'extention
      
       if($ext==".pdf"){
         $verif=1;
       }
       if($taille<=8000000){
          $verif1=1;
       }
      
      $nom="exampdf".$idmat."-".$_SESSION['classec']."-".$idsession.".pdf";
      $chemin = "examenpdf/".$nom; // ici c'est l'endroit ou va etre stocker le chemin de votre texte ou image ou autre  ici c'est dans ==> r�pertoire.
      
      
  $cherch="examenpdf/".$nom;
  
  if($verif==1 AND $verif1==1){
    $idutil=1;
     if(file_exists($cherch)!=0){
      unlink($chemin);
       move_uploaded_file($_FILES["fichexam"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
       $_SESSION['respenvoi']=1; 
     
       $date=date('Y-m-d');
      $heur=date('H:i');
      $rdw="UPDATE examine SET idutilisateur=".$idutil."' WHERE idmatiere='".$idmat."' AND idclasse='".$_SESSION['classec']."' AND idsession='".$idsession."'";
      $reqdw=$bdd->query($rdw);
      $rdw="UPDATE examine SET date=".$date."' WHERE idmatiere='".$idmat."' AND idclasse='".$_SESSION['classec']."' AND idsession='".$idsession."'";
      $reqdw=$bdd->query($rdw);
      $rdw="UPDATE examine SET heure=".$heur."' WHERE idmatiere='".$idmat."' AND idclasse='".$_SESSION['classec']."' AND idsession='".$idsession."'";
      $reqdw=$bdd->query($rdw);
      }

       if(file_exists($cherch)==0){
       move_uploaded_file($_FILES["fichexam"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
       $_SESSION['respenvoi']=1; 
     
       $date=date('Y.m.d');
      $heur=date('H:i'); 
       $req = $bdd->prepare('INSERT INTO examine(idmatiere,idclasse,idsession,image,pdf,date,heure,idutilisateur,adrip) VALUES( ?,?,?,?,?,?,?,?,?)'); 
       $req->execute(array($idmat,$_SESSION['classec'],$idsession,' ', $nom,$date,$heur,$idutil,$_SESSION['addrIp']
        ));  
      }
     }
     if($verif==0 OR $verif1==0){
           $_SESSION['respenvoi']=2; 
       }
      
       header('location:examensgenadm.php');
        
    }



    if(isset($_POST['ajtexamadm'])){ 
     
      $nom=$_FILES["fichexam"]["name"]; // on recupere le nom de l'image avec son extension
      $taille=$_FILES["fichexam"]["size"];  //optionnelle, mnt vous avez la taille
      $idsession=$_POST['ajtsession'];
      $idmat=$_POST['ajtmatex'];
      list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
      $verif=0;
      $verif1=0; 
        
        $ext=".".strtolower($ext); // on rajoute un . devant l'extention
       
        if($ext==".pdf"){
          $verif=1;
        }
        if($taille<=8000000){
           $verif1=1;
        }
       
       $nom="exampdf".$idmat."-".$_SESSION['classec']."-".$idsession.".pdf";
       $chemin = "examenpdf/".$nom; // ici c'est l'endroit ou va etre stocker le chemin de votre texte ou image ou autre  ici c'est dans ==> r�pertoire.
       
       
   $cherch="examenpdf/".$nom;
   
   if($verif==1 AND $verif1==1){
     $idutil=1;
      if(file_exists($cherch)!=0){
       unlink($chemin);
        move_uploaded_file($_FILES["fichexam"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
        $_SESSION['respenvoi']=1; 
      
        $date=date('Y-m-d');
       $heur=date('H:i');
       $rdw="UPDATE examine SET idutilisateur=".$idutil."' WHERE idmatiere='".$idmat."' AND idclasse='".$_SESSION['classec']."' AND idsession='".$idsession."'";
       $reqdw=$bdd->query($rdw);
       $rdw="UPDATE examine SET date=".$date."' WHERE idmatiere='".$idmat."' AND idclasse='".$_SESSION['classec']."' AND idsession='".$idsession."'";
       $reqdw=$bdd->query($rdw);
       $rdw="UPDATE examine SET heure=".$heur."' WHERE idmatiere='".$idmat."' AND idclasse='".$_SESSION['classec']."' AND idsession='".$idsession."'";
       $reqdw=$bdd->query($rdw);
       }
 
        if(file_exists($cherch)==0){
        move_uploaded_file($_FILES["fichexam"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
        $_SESSION['respenvoi']=1; 
      
        $date=date('Y.m.d');
       $heur=date('H:i'); 
        $req = $bdd->prepare('INSERT INTO examine(idmatiere,idclasse,idsession,image,pdf,date,heure,idutilisateur,adrip) VALUES( ?,?,?,?,?,?,?,?,?)'); 
        $req->execute(array($idmat,$_SESSION['classec'],$idsession,' ', $nom,$date,$heur,$idutil,$_SESSION['addrIp']
         ));  
       }
      }
      if($verif==0 OR $verif1==0){
            $_SESSION['respenvoi']=2; 
        }
       
        header('location:examensgenadm.php');
         
     }


    if(isset($_POST['supepreuve'])){
      $idestevalue=$_POST['supepreuve'];
      $nom=$_POST['nom'];   
    
    $dir=$nom;
     $rdw="DELETE FROM estevalue  WHERE idestevalue='".$idestevalue."'";
    $reqdw=$bdd->query($rdw);
     
    unlink($dir);
       
        header('location:evaluation2.php');
        
    }




    if(isset($_POST['ajteval1'])){ 
     
      $nom=$_FILES["ficheval"]["name"]; // on recupere le nom de l'image avec son extension
      $taille=$_FILES["ficheval"]["size"];  //optionnelle, mnt vous avez la taille
      $ideval=$_POST['ajtype'];
      $idclas=$_POST['ajtclas'];  $description=$_POST['description'];
      echo $_POST['ajtmatev']; 
      $idmat=' ';
      if(isset($_POST['ajtmatev'])){
        $idmat=$_POST['ajtmatev'];
      }   
      $choixetab=$_POST['choixetab'];
      echo $choixetab;
      if(isset($_POST['newetab'])){
        $choixetab=$_POST['newetab'];
      }
      
      if($choixetab=='a' OR $choixetab==' '){
        $choixetab=' ';    
      }
      
      
      list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
      $verif=0;
      $verif1=0; 
        
        $ext=".".strtolower($ext); // on rajoute un . devant l'extention
       
        if($ext==".pdf"){
          $verif=1;
        }
        if($taille<=8000000){
           $verif1=1;
        }
       
      
       
   
   
   if($verif==1 AND $verif1==1){
     $idutil=1;

     $dat=date('Y.m.d'); $heu=date('H:i');
     $reqq=$bdd->prepare('INSERT INTO estevalue(idclasse,idmatiere,ideval,nom,etab,description,idutilisateur,date,heure,ok) VALUES( ?,?,?,?,?,?,?,?,?,?)');
     $reqq->execute(array($idclas,$idmat,$ideval,' ',$choixetab,$description,$idutil,$dat,$heu,'1')); 
   $idestevalue=$bdd->lastInsertId();
 
   $nom="eval".$idestevalue."-".$idmat."-".$idclas."-".$ideval.".pdf";
   $chemin = "evaluation/".$nom; // ici c'est l'endroit ou va etre stocker le chemin de votre texte ou image ou autre  ici c'est dans ==> r�pertoire.
   $rdw="UPDATE estevalue SET nom='".$nom."' WHERE idestevalue='".$idestevalue."' ";
   $reqdw=$bdd->query($rdw);
        move_uploaded_file($_FILES["ficheval"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
        $_SESSION['respenvoi']=1; 
      
        
 
        
      }
      if($verif==0 OR $verif1==0){
            $_SESSION['respenvoi']=2; 
        }
       
          header('location:evaluation.php');
         
     }




     if(isset($_POST['ajtevaladm1'])){ 
     
      $nom=$_FILES["ficheval"]["name"]; // on recupere le nom de l'image avec son extension
      $taille=$_FILES["ficheval"]["size"];  //optionnelle, mnt vous avez la taille
      $ideval=$_POST['ajtype'];
      $idclas=$_POST['ajtclas'];  $description=$_POST['description'];
      echo $_POST['ajtmatev']; 
      $idmat=' ';
      if(isset($_POST['ajtmatev'])){
        $idmat=$_POST['ajtmatev'];
      }   
      $choixetab=$_POST['choixetab'];
      echo $choixetab;
      if(isset($_POST['newetab'])){
        $choixetab=$_POST['newetab'];
      }
      
      if($choixetab=='a' OR $choixetab==' '){
        $choixetab=' ';    
      }
      
      
      list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
      $verif=0;
      $verif1=0; 
        
        $ext=".".strtolower($ext); // on rajoute un . devant l'extention
       
        if($ext==".pdf"){
          $verif=1;
        }
        if($taille<=8000000){
           $verif1=1;
        }
       
      
       
   
   
   if($verif==1 AND $verif1==1){
     $idutil=1;

     $dat=date('Y.m.d'); $heu=date('H:i');
     $reqq=$bdd->prepare('INSERT INTO estevalue(idclasse,idmatiere,ideval,nom,etab,description,idutilisateur,date,heure,ok) VALUES( ?,?,?,?,?,?,?,?,?,?)');
     $reqq->execute(array($idclas,$idmat,$ideval,' ',$choixetab,$description,$idutil,$dat,$heu,'1')); 
   $idestevalue=$bdd->lastInsertId();
 
   $nom="eval".$idestevalue."-".$idmat."-".$idclas."-".$ideval.".pdf";
   $chemin = "evaluation/".$nom; // ici c'est l'endroit ou va etre stocker le chemin de votre texte ou image ou autre  ici c'est dans ==> r�pertoire.
   $rdw="UPDATE estevalue SET nom='".$nom."' WHERE idestevalue='".$idestevalue."' ";
   $reqdw=$bdd->query($rdw);
        move_uploaded_file($_FILES["ficheval"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
        $_SESSION['respenvoi']=1; 
      
        
 
        
      }
      if($verif==0 OR $verif1==0){
            $_SESSION['respenvoi']=2; 
        }
       
          header('location:evaluationadm.php');
         
     }




     if(isset($_POST['supmatklasse'])){
      $idestenseigne=$_POST['supmatklasse'];
      $chap="SELECT * FROM estenseigne WHERE idestenseigne='".$idestenseigne."'";
    $rep = $bdd->query($chap);
    
    while ($don = $rep->fetch()){
      $idmat=$don['idmatiere'];  

      $lec="SELECT * FROM estevalue WHERE idclasse='".$_SESSION['idclasorg1']."' AND idmatiere='".$idmat."'";
      $replec = $bdd->query($lec);
      while ($donlec = $rep->fetch()){
        $nom=$donlec['nom'];
        
        
        $dir="evaluation/".$nom; unlink($dir);
        
    } 
    $replec->closeCursor(); 

    $lec="SELECT * FROM examine WHERE idclasse='".$_SESSION['idclasorg1']."' AND idmatiere='".$idmat."'";
    $replec = $bdd->query($lec);
    while ($donlec = $rep->fetch()){
      $nom=$donlec['pdf'];
      
      
      $dir="examenpdf/".$nom; unlink($dir);
      
  } 
  $replec->closeCursor(); 

    
    } 
    $rep->closeCursor(); 

    //NNNNNNNNNNN

     $rdw="DELETE FROM estenseigne  WHERE idestenseigne='".$idestenseigne."'";
    $reqdw=$bdd->query($rdw);
    $chap="SELECT * FROM chapitre WHERE idestenseigne='".$idestenseigne."'";
    $rep = $bdd->query($chap);
    
    while ($don = $rep->fetch()){
      $idchap=$don['idchapitre'];
      $rdw="DELETE FROM chapitre  WHERE idchapitre='".$idchap."'";
      $reqdw=$bdd->query($rdw);

      $lec="SELECT * FROM lecon WHERE idchapitre='".$idchap."'";
      $replec = $bdd->query($lec);
      while ($donlec = $rep->fetch()){
        $idlec=$donlec['idlec'];
        $image=$donlec['image'];
        $pdf=$donlec['pdf'];
        $dir="lecon/".$image; unlink($dir);
        $dir="leconpdf/".$pdf; unlink($dir);

        $leci="SELECT * FROM exercice WHERE idlecon='".$idlec."'";
        $repleci = $bdd->query($leci);
        while ($donleci = $rep->fetch()){
           
          $imagei=$donleci['image'];
          $pdfi=$donlec['pdf'];
          $diri="exercice/".$imagei; unlink($diri);
          $diri="exercicepdf/".$pdfi; unlink($diri);


        } 
        $repleci->closeCursor();


    } 
    $replec->closeCursor(); 

  } 
  $rep->closeCursor(); 

    
       
         header('location:organiser1.php');
        
    }

if(isset($_POST['supcompet'])){
  $idemc=$_POST['supcompet'];
   $rdw="DELETE FROM ensmatclas  WHERE idemc='".$idemc."'";
   $reqdw=$bdd->query($rdw);
$_SESSION['getok']=1;
 header('location:leskontodet.php');
}


if(isset($_POST['ajtesess'])){ 
 $nomsess=$_POST['sess'];  $ordsess=$_POST['ordrsess'];
 $req = $bdd->prepare('INSERT INTO session(nomsession,ordre) VALUES( ?,?)'); 
  $req->execute(array($nomsess,$ordsess));  
header('location:examensgenadm.php');

}

// SEANCE
if(isset($_POST['debseanc'])){ 
 $nom=$_POST['nom'];  $statut=$_POST['statut'];   $da=date('Y.m.d'); $he=date('H:i');
 $req = $bdd->prepare('INSERT INTO seance(idestsollicitee,nomdeb,statutdeb,nomfin,statutfin,idenseign,dateseance,heuredeb,heurefin,duree,taux,total,decisionsea) 
 VALUES( ?,?,?,?,?,?,?,?,?,?,?,?,?)'); 
  $req->execute(array($_SESSION['idprogempl'],$nom,$statut,' ',' ',$_SESSION['idtutseance'],$da,$he,' ',' ',' ',' ',1));  
$_SESSION['idsean']=$bdd->lastInsertId();
  header('location:seance.php');

}


if(isset($_POST['finseanc'])){ 
 $nom=$_POST['nom'];  $statut=$_POST['statut'];   $da=date('Y.m.d'); $he=date('H:i');
  $idseance=$_POST['finseanc'];
  $seancinfo=infoseanc($idseance);
   $arrayrec=array(); 
    $arrayrec=explode("@",$seancinfo);  
    $debut=$arrayrec[7]; $duree=calculduree($debut,$he);  echo $duree;
     $estsolicit=$arrayrec[0];

    $durec=array(); 
    $durec=explode(":",$duree);  
    $duh=$durec[0]+($durec[1]/60); 

$lsql="SELECT * FROM estsollicitee  ORDER BY idestsollicitee DESC";
           $reponse = $bdd->query($lsql);
            $find=0;
          while ($donnees = $reponse->fetch() AND $find==0)
          {
   $idenseign=$donnees['idenseign'];
            $idmatiere=$donnees['idmatiere'];
            $dureea=$donnees['duree']+0;
            $horairedeb=$donnees['horairedeb'];
              $ijourcours=$donnees['jourcours'];
               $th=$donnees['th']+0;
            $decision=$donnees['decision']; //O POUR ACTIF 1 POUR PASSER
              $montant=$donnees['montant']+0;
               $montantens=$donnees['montantensei']+0;
               $thens=$donnees['tauxensei']+0;
                if($donnees['idestsollicitee']==$estsolicit){

 $r="UPDATE seance SET dureeatt='".$dureea."' WHERE idseance='".$idseance."'";
  $req=$bdd->query($r);
    $djh=$dureea*60; $min=$djh%60; $heu=($djh-$min)/60; if($heu<10){$heu="0".$heu; } if($min<10){$min="0".$min; }  
    $dureeahm=$heu.":".$min;
  $r="UPDATE seance SET dureeatthm='".$dureeahm."' WHERE idseance='".$idseance."'";
  $req=$bdd->query($r);
  if($duh>=$dureea){$paye=$dureea*$thens; }  if($duh<$dureea){$paye=$duh*$thens; }
   $r="UPDATE seance SET taux='".$thens."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
  $r="UPDATE seance SET total='".$paye."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
                $find=1;
                }
 
          }
          $reponse->closeCursor();

  $r="UPDATE seance SET nomfin='".$nom."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
   $r="UPDATE seance SET statutfin='".$statut."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
      $r="UPDATE seance SET heurefin='".$he."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
       $r="UPDATE seance SET duree='".$duh."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
       $r="UPDATE seance SET dureehm='".$duree."' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
       $r="UPDATE seance SET decisionsea ='2' WHERE idseance='".$idseance."'";
      $req=$bdd->query($r);
   header('location:seance.php');

}

if(isset($_POST['addcompet'])){
 $idutil=$_POST['addcompet'];
 $ensemble=array();
 $ensemble=$_POST['matadd'];
 $taille=count($ensemble); 
 if($taille>0){ 
$i=0;
while($i<$taille){
  $addcompet=$ensemble[$i];  
$tab=array();
  $tab=explode("-",$addcompet);
  $idmat=$tab[0];  $idclas=$tab[1];   
    $vercomp=verifensgcomp($idutil,$idmat,$idclas);  
    if( $vercomp==0){
      $req = $bdd->prepare('INSERT INTO ensmatclas(idutilisateur,idmat,idclas) VALUES( ?,?,? )'); 
      $req->execute(array($idutil,$idmat,$idclas));  
       echo nomatiere($idmat)." / ".nomclasse($idclas); 
    }
    $i++;
 }



 }
  
$_SESSION['getok']=2;
   header('location:leskontodet.php');
}

    if(isset($_POST['ajmatclog1'])){
      $idcl=$_SESSION['idclasorg1'];
      $matiere=array();
      $matiere=$_POST['matiere'];
       $len=count($matiere);
       if($len>0){
       for($i=0;$i<$len;$i++){
        $existestenseigne=existestenseigne($idcl,$matiere[$i]);
        if($existestenseigne==0){
        $req = $bdd->prepare('INSERT INTO estenseigne(idmatiere,idclasse ) VALUES( ?,? )'); 
       $req->execute(array($matiere[$i],$idcl));    
        } 
      }
    }
       header('location:organiser1.php');
        
    }
    if(isset($_POST['engmclasse'])){
      $idclas=$_POST['engmclasse'];
      $nom=$_POST['modifclasse'];
      $verif=mmclasse($nom);
       if($verif==0 OR $verif==$idclas){
        $r="UPDATE classe SET nomclasse='".$nom."' WHERE idclasse='".$idclas."'";
      $req=$bdd->query($r);
      $r="UPDATE classe SET ordre='".$_POST['ordre']."' WHERE idclasse='".$idclas."'";
      $req=$bdd->query($r);
       }
       if($_SESSION['numorg']==8){
        header('location:organiser.php');
       }
       
        
    }








if(isset($_POST["saveim"])){

$idlecon=$_POST["saveim"];
   if(!empty($_FILES["imuser"]["name"])){
    $nom=$_FILES["imuser"]["name"]; // on recupere le nom de l'image avec son extension
    $taille=$_FILES["imuser"]["size"];  //optionnelle, mnt vous avez la taille
      
    
    list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
  
    $verif=0;
    $verif1=0; 
      
      $ext=".".strtolower($ext); // on rajoute un . devant l'extention
     
      if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
        $verif=1;
      }
      if($taille<=8000000){
         $verif1=1;
      }
     
    
      
  $nom1="b-".$idlecon.$ext;
  $nomv1="client/b-".$idlecon.$ext;
  $chemin = "client/".$nom1;
  if($verif==1 AND $verif1==1){
   $idutil=1;
   if(file_exists($nomv1)!=0){
    unlink($chemin);
    }
    $dat=date('Y.m.d'); $heu=date('H:i');
    

    move_uploaded_file($_FILES["imuser"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
    $rdw="UPDATE enseignant SET photo='".$nom1."' WHERE idutilisateur='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
         
      $_SESSION['getok']=3; 
  
    }
    if($verif==0 OR $verif1==0){
             
      }
    }
  header('location:leskontodet.php');
}








 if(isset($_POST['modonne'])){
      $idutil=$_POST['modonne'];
      $nom=$_POST['nomu'];
      $pnom=$_POST['pnomu'];
      $dateu=$_POST['dateu'];
      $genre=$_POST['genre'];
      $nums=$_POST['nums'];
      $numw=$_POST['numw'];
      $statut=$_POST['statut'];

       $villeu=$_POST['villeu'];
        $quartieru=$_POST['quartieru'];
        $cniu=$_POST['cniu'];
       
      $r="UPDATE utilisateur SET nom='".$nom."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE utilisateur SET prenom='".$pnom."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE utilisateur SET datenaiss='".$dateu."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE utilisateur SET numtelsimpl='".$nums."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE utilisateur SET numtelwh='".$numw."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE utilisateur SET genre='".$genre."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
        
      
      if($statut==0){
        $r="DELETE FROM enseignant  WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      }
       if($statut==1){
       $verifensg=verifensg($idutil);
        if( $verifensg==0){
        $req = $bdd->prepare('INSERT INTO enseignant(photo,cni,planlocal,ville,quartier,idutilisateur,dispo) VALUES(?,?,?,?,?,?,?)'); 
      $req->execute(array(' ',$cniu,' ',$villeu,$quartieru,$idutil,' ')); 
        }
        if( $verifensg!=0){  
           $r="UPDATE enseignant SET cni='".$cniu."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE enseignant SET ville='".$villeu."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);
      $r="UPDATE enseignant SET quartier='".$quartieru."' WHERE idutilisateur='".$idutil."'";
      $req=$bdd->query($r);

         }
       } 






        $_SESSION['getok']=3;
          header('location:leskontodet.php');
             
        
    }




    if(isset($_POST['supklasse'])){
      $idclas=$_POST['supklasse'];
    
      
       
      $lec="SELECT * FROM estevalue WHERE idclasse='".$idclas."'";
      $replec = $bdd->query($lec);
      while ($donlec = $replec->fetch()){
        $nom=$donlec['nom'];
        $dir="evaluation/".$nom; unlink($dir);
      } 
      $replec->closeCursor(); 
      $lec="SELECT * FROM examine WHERE idclasse='".$idclas."'";
      $replec = $bdd->query($lec);
      while ($donlec = $replec->fetch()){
        $nom=$donlec['pdf'];
        $dir="examenpdf/".$nom; unlink($dir);
      } 
      $replec->closeCursor(); 


      $est="SELECT * FROM estenseigne WHERE idclasse='".$idclas."'";
      $repest = $bdd->query($est);
      
      while ($donest = $repest->fetch()){
        $idestenseigne=$donest['idestenseigne'];


      $chap="SELECT * FROM chapitre WHERE idestenseigne='".$idestenseigne."'";
    $rep = $bdd->query($chap);
    
    while ($don = $rep->fetch()){
      $idchap=$don['idchapitre'];
      $rdw="DELETE FROM chapitre  WHERE idchapitre='".$idchap."'";
      $reqdw=$bdd->query($rdw);

      $lec="SELECT * FROM lecon WHERE idchapitre='".$idchap."'";
      $replec = $bdd->query($lec);
      while ($donlec = $rep->fetch()){
        $idlec=$donlec['idlec'];
        $image=$donlec['image'];
        $pdf=$donlec['pdf'];
        $dir="lecon/".$image; unlink($dir);
        $dir="leconpdf/".$pdf; unlink($dir);

        $leci="SELECT * FROM exercice WHERE idlecon='".$idlec."'";
        $repleci = $bdd->query($leci);
        while ($donleci = $rep->fetch()){
           
          $imagei=$donleci['image'];
          $pdfi=$donlec['pdf'];
          $diri="exercice/".$imagei; unlink($diri);
          $diri="exercicepdf/".$pdfi; unlink($diri);


        } 
        $repleci->closeCursor();


    } 
    $replec->closeCursor(); 

  } 
  $rep->closeCursor(); 


} 
$repest->closeCursor();



$r="DELETE FROM classe WHERE idclasse='".$idclas."'";
$req=$bdd->query($r);
$r="DELETE FROM estenseigne WHERE idclasse='".$idclas."'";
$req=$bdd->query($r);


       if($_SESSION['numorg']==8){
        header('location:organiser.php');
       }
       
        
    }  



    if(isset($_POST['ajoutercl'])){
      $newclasse=$_POST['newclasse'];
      if($_SESSION['numorg']==8){
         $type=1;
       }
       $verif=mmclasse($newclasse);
       if($verif==0){
      $req = $bdd->prepare('INSERT INTO classe(nomclasse,idtypenseig,ordre) VALUES(?,?,?)'); 
      $req->execute(array($newclasse,$type,$_POST['ordre'])); 
       }
      echo $newclasse;
      $idcl=$bdd->lastInsertId();
      $matiere=array();
      $matiere=$_POST['matiere'];
       $len=count($matiere);
       if($len>0){
       for($i=0;$i<$len;$i++){
        $existestenseigne=existestenseigne($idcl,$matiere[$i]);
        if($existestenseigne==0){
        $req = $bdd->prepare('INSERT INTO estenseigne(idmatiere,idclasse ) VALUES( ?,? )'); 
       $req->execute(array($matiere[$i],$idcl));    
        } 
      }
    }
    if($_SESSION['numorg']==8){
      header('location:organiser.php');
     }
    //   header('location:organiser.php');
        
    }


    if(isset($_POST['ajoutermate'])){
      $newmat=$_POST['newmate'];
      $verif=mmatiere($newmat);
      if($verif==0){
      $req = $bdd->prepare('INSERT INTO matiere(nomatiere) VALUES(?)'); 
      $req->execute(array($newmat)); 
      }
      $idmat=$bdd->lastInsertId();
      $classe=array();
      $classe=$_POST['classe'];
       $len=count($classe);
       if($len>0){
       for($i=0;$i<$len;$i++){
        $existestenseigne=existestenseigne($classe[$i],$idmat);
        if($existestenseigne==0){
        $req = $bdd->prepare('INSERT INTO estenseigne(idmatiere,idclasse ) VALUES( ?,? )'); 
       $req->execute(array($idmat,$classe[$i]));    
        } 
      }
    }
    if($_SESSION['numorg']==8){
      header('location:organiser.php');
     }
    //   header('location:organiser.php');
        
    }


    if(isset($_POST['engmate'])){
      $idmat=$_POST['engmate'];
      $nom=$_POST['modifmate'];
      $verif=mmatiere($nom);
       if($verif==0 OR $verif==$idmat){
        $r="UPDATE matiere SET nomatiere='".$nom."' WHERE idmatiere='".$idmat."'";
      $req=$bdd->query($r);
       
       }
       if($_SESSION['numorg']==8){
        header('location:organiser.php');
       }
       
        
    }



    if(isset($_POST['supmate'])){
      $idmat=$_POST['supmate'];
    
      
       
      $lec="SELECT * FROM estevalue WHERE idmatiere='".$idmat."'";
      $replec = $bdd->query($lec);
      while ($donlec = $replec->fetch()){
        $nom=$donlec['nom'];
        $dir="evaluation/".$nom; unlink($dir);
      } 
      $replec->closeCursor(); 
      $lec="SELECT * FROM examine WHERE idmatiere='".$idmat."'";
      $replec = $bdd->query($lec);
      while ($donlec = $replec->fetch()){
        $nom=$donlec['pdf'];
        $dir="examenpdf/".$nom; unlink($dir);
      } 
      $replec->closeCursor(); 


      $est="SELECT * FROM estenseigne WHERE idmatiere='".$idmat."'";
      $repest = $bdd->query($est);
      
      while ($donest = $repest->fetch()){
        $idestenseigne=$donest['idestenseigne'];


      $chap="SELECT * FROM chapitre WHERE idestenseigne='".$idestenseigne."'";
    $rep = $bdd->query($chap);
    
    while ($don = $rep->fetch()){
      $idchap=$don['idchapitre'];
      $rdw="DELETE FROM chapitre  WHERE idchapitre='".$idchap."'";
      $reqdw=$bdd->query($rdw);

      $lec="SELECT * FROM lecon WHERE idchapitre='".$idchap."'";
      $replec = $bdd->query($lec);
      while ($donlec = $rep->fetch()){
        $idlec=$donlec['idlec'];
        $image=$donlec['image'];
        $pdf=$donlec['pdf'];
        $dir="lecon/".$image; unlink($dir);
        $dir="leconpdf/".$pdf; unlink($dir);

        $leci="SELECT * FROM exercice WHERE idlecon='".$idlec."'";
        $repleci = $bdd->query($leci);
        while ($donleci = $rep->fetch()){
           
          $imagei=$donleci['image'];
          $pdfi=$donlec['pdf'];
          $diri="exercice/".$imagei; unlink($diri);
          $diri="exercicepdf/".$pdfi; unlink($diri);


        } 
        $repleci->closeCursor();


    } 
    $replec->closeCursor(); 

  } 
  $rep->closeCursor(); 


} 
$repest->closeCursor();



$r="DELETE FROM matiere WHERE idmatiere='".$idmat."'";
$req=$bdd->query($r);
$r="DELETE FROM estenseigne WHERE idmatiere='".$idmat."'";
$req=$bdd->query($r);


       if($_SESSION['numorg']==8){
        header('location:organiser.php');
       }
       
        
    }  



    if(isset($_POST['engmodchap'])){
      $idchap=$_POST['engmodchap'];
      $nom=$_POST['modchap'];
      $orchap=$_POST['orchap'];
      $verif=mmchap($nom);   
       if($verif==0 OR $verif==$idchap){
        $r='UPDATE chapitre SET nomchapitre="'.$nom.'" WHERE idchapitre="'.$idchap.'"';
      $req=$bdd->query($r);
       }
       $r='UPDATE chapitre SET ordre="'.$orchap.'" WHERE idchapitre="'.$idchap.'"';
       $req=$bdd->query($r);
      header('location:organiser2.php');
    }

    if(isset($_POST['valider'])){
      $idchap=$_POST['valider'];
       $orchap=$_POST['orname'];
       $r='UPDATE chapitre SET ordre="'.$orchap.'" WHERE idchapitre="'.$idchap.'"';
      $req=$bdd->query($r);
       header('location:organiser2.php');
    }


    if(isset($_POST['jointklasse'])){
      $idestenseigne=$_POST['jointklasse'];
       $liencours=$_POST['liencours'];
       $joint=$_POST['joint'];
       $r="UPDATE estenseigne SET lien=' ' WHERE idestenseigne='".$idestenseigne."'";
      $req=$bdd->query($r);
       $r="UPDATE estenseigne SET joint='".$joint."' WHERE idestenseigne='".$idestenseigne."'";
      $req=$bdd->query($r);
      if($joint==1){
        $r="UPDATE estenseigne SET lien='".$liencours."' WHERE idestenseigne='".$idestenseigne."'";
        $req=$bdd->query($r);
      }
      
       header('location:organiser1.php');
    }

    if(isset($_POST['engmodlec'])){
      $idlecon=$_POST['engmodlec'];
      $nom=$_POST['modlec'];
      $idchap=$_POST['chapitre'];
      $video=$_POST['lienvide'];
       $orlec=$_POST['orlec'];
      $verif=mmlecon($nom);   
       if($verif==0 OR $verif==$idlecon){
        $r='UPDATE lecon SET nomlecon="'.$nom.'" WHERE idlecon="'.$idlecon.'"';
      $req=$bdd->query($r);
       }
       $r='UPDATE lecon SET video="'.$video.'" WHERE idlecon="'.$idlecon.'"';
       $req=$bdd->query($r);
       $r='UPDATE lecon SET ordre="'.$orlec.'" WHERE idlecon="'.$idlecon.'"';
       $req=$bdd->query($r);
       $r='UPDATE lecon SET idchapitre="'.$idchap.'" WHERE idlecon="'.$idlecon.'"';
       $req=$bdd->query($r);
      header('location:organiser3.php');
    }


    if(isset($_POST['validerl'])){
      $idlecon=$_POST['validerl'];
       $orchap=$_POST['orname'];
       $r='UPDATE lecon SET ordre="'.$orchap.'" WHERE idlecon="'.$idlecon.'"';
      $req=$bdd->query($r);
       header('location:organiser3.php');
    }
    
    if(isset($_POST['chgdmdserv'])){
      $idmd=$_POST['chgdmdserv'];
       $mom=$_POST['moment'];   $genre=$_POST['genre'];  $lieu=$_POST['lieu'];
       $r='UPDATE demande SET genresouh="'.$genre.'" WHERE idemande="'.$idmd.'"';
      $req=$bdd->query($r);
       $r='UPDATE demande SET lieusouh="'.$lieu.'" WHERE idemande="'.$idmd.'"';
      $req=$bdd->query($r);
      $r='UPDATE demande SET idmomentouch="'.$mom.'" WHERE idemande="'.$idmd.'"';
      $req=$bdd->query($r);
     ECHO $genre." : ".$mom." : ".$lieu;
     if($_SESSION['nomprgm']==1){
 header('location:detailadm.php');
     }
   if($_SESSION['nomprgm']==2){
 header('location:detail.php');
     }
    }
     

     
     if(isset($_POST['supdmdserv'])){
      $idmd=$_POST['supdmdserv'];
        
      $r='DELETE FROM demande  WHERE idemande="'.$idmd.'"';
      $req=$bdd->query($r); 
      $r='DELETE FROM estsollicitee  WHERE idemande="'.$idmd.'"';
      $req=$bdd->query($r); 
     if($_SESSION['nomprgm']==1){
 header('location:detailadm.php');
     }
   if($_SESSION['nomprgm']==2){
 header('location:detail.php');
     }
    }


 if(isset($_POST['engmodimg'])){ 
   $idlecon=  $_POST['engmodimg'];
    

   if(!empty($_FILES["image"]["name"])){
    $nom=$_FILES["image"]["name"]; // on recupere le nom de l'image avec son extension
    $taille=$_FILES["image"]["size"];  //optionnelle, mnt vous avez la taille
      
    
    list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
  
    $verif=0;
    $verif1=0; 
      
      $ext=".".strtolower($ext); // on rajoute un . devant l'extention
     
      if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
        $verif=1;
      }
      if($taille<=8000000){
         $verif1=1;
      }
     
    
      $no="lecon".$idlecon;  
  $nom1="lecon".$idlecon.$ext;
  $nomv1="lecon/lecon".$idlecon.$ext;
  if($verif==1 AND $verif1==1){
   $idutil=1;
   if(file_exists($nomv1)!=0){
    $dat=date('Y.m.d'); $heu=date('H:i');
    $chemin = "lecon/".$nom1;
    unlink($chemin);
    move_uploaded_file($_FILES["image"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
    $rdw="UPDATE lecon SET idutilisateur='".$idutil."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
        $rdw="UPDATE lecon SET image='".$nom1."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
    $_SESSION['respenvoi']=1; 
   }
   

   if(file_exists($nomv1)==0){
    $dat=date('Y.m.d'); $heu=date('H:i');
    $chemin = "lecon/".$nom1;
     
    move_uploaded_file($_FILES["image"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
    $rdw="UPDATE lecon SET image='".$no."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
        $rdw="UPDATE lecon SET idutilisateur='".$idutil."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
    $_SESSION['respenvoi']=1; 
   }



  
    }
    if($verif==0 OR $verif1==0){
          $_SESSION['respenvoi']=2; 
      }
    }






   if(!empty($_FILES["pdf"]["name"])){
    $nom=$_FILES["pdf"]["name"]; // on recupere le nom de l'image avec son extension
    $taille=$_FILES["pdf"]["size"];  //optionnelle, mnt vous avez la taille
      
    
    list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
  
    $verif=0;
    $verif1=0; 
      
      $ext=".".strtolower($ext); // on rajoute un . devant l'extention
     
      if($ext==".pdf"){
        $verif=1;
      }
      if($taille<=8000000){
         $verif1=1;
      }
     
    
      $no= "lecon".$idlecon."-pdf" ;
  $nom1="lecon".$idlecon."-pdf.pdf";
  $nomv1="leconpdf/lecon".$idlecon."-pdf.pdf";
  if($verif==1 AND $verif1==1){
   $idutil=1;
   if(file_exists($nomv1)!=0){
    $dat=date('Y.m.d'); $heu=date('H:i');
    $chemin = "leconpdf/".$nom1;
    unlink($chemin);
    move_uploaded_file($_FILES["pdf"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
    $rdw="UPDATE lecon SET idutilisateur='".$idutil."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
        $rdw="UPDATE lecon SET pdf='".$no."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
    $_SESSION['respenvoi']=1; 
   }
   if(file_exists($nomv1)==0){
    $dat=date('Y.m.d'); $heu=date('H:i');
    $chemin = "leconpdf/".$nom1;
     
    move_uploaded_file($_FILES["pdf"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
    $rdw="UPDATE lecon SET pdf='".$no."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
        $rdw="UPDATE lecon SET idutilisateur='".$idutil."' WHERE idlecon='".$idlecon."' ";
        $reqdw=$bdd->query($rdw);
    $_SESSION['respenvoi']=1; 
   }
  
    }
    if($verif==0 OR $verif1==0){
          $_SESSION['respenvoi']=2; 
      }
    }
       header('location:organiser3.php');
     
 }


//DEB IMAGE PDF EXO LECON

if(isset($_POST['engmodexo'])){ 
  $idlecon=  $_POST['engmodexo'];
   

  if(!empty($_FILES["imagexo"]["name"])){
   $nom=$_FILES["imagexo"]["name"]; // on recupere le nom de l'image avec son extension
   $taille=$_FILES["imagexo"]["size"];  //optionnelle, mnt vous avez la taille
     
   
   list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
   $verif=0;
   $verif1=0; 
     
     $ext=".".strtolower($ext); // on rajoute un . devant l'extention
    
     if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
       $verif=1;
     }
     if($taille<=8000000){
        $verif1=1;
     }
    
   // $bdd->lastInsertId();
     $no="exo".$idlecon;  
 $nom1="exo".$idlecon.$ext;
 $nomv1="exercice/exo".$idlecon.$ext;
 if($verif==1 AND $verif1==1){
  $idutil=1;
  $finden=imagexoexist($idlecon);
  if($finden!=0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercice/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["imagexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
   $rdw="UPDATE image SET image='".$nom1."' WHERE idlecon='".$idlecon."' ";
   $reqdw=$bdd->query($rdw);
   $_SESSION['respenvoi']=1; 
  }
  

  if($finden==0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercice/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["imagexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
  $req = $bdd->prepare('INSERT INTO exercice(texte,pdf,image,idlecon) VALUES(?,?,?,?)'); 
   $req->execute(array(' ',' ',$nom1,$idlecon)); 
   $_SESSION['respenvoi']=1; 
  }



 
   }
   if($verif==0 OR $verif1==0){
         $_SESSION['respenvoi']=2; 
     }
   }






  if(!empty($_FILES["pdfexo"]["name"])){
   $nom=$_FILES["pdfexo"]["name"]; // on recupere le nom de l'image avec son extension
   $taille=$_FILES["pdfexo"]["size"];  //optionnelle, mnt vous avez la taille
     
   
   list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
   $verif=0;
   $verif1=0; 
     
     $ext=".".strtolower($ext); // on rajoute un . devant l'extention
    
     if($ext==".pdf"){
       $verif=1;
     }
     if($taille<=8000000){
        $verif1=1;
     }
    
   
     $no= "exo".$idlecon."-pdf" ;
 $nom1="exo".$idlecon."-pdf.pdf";
 $nomv1="exercicepdf/exo".$idlecon."-pdf.pdf";
 if($verif==1 AND $verif1==1){
  $idutil=1;
  $finden=imagexoexist($idlecon); echo $idlecon;
  if($finden!=0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercicepdf/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["pdfexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
       $rdw="UPDATE exercice SET pdf='".$no."' WHERE idlecon='".$idlecon."' ";
       $reqdw=$bdd->query($rdw);
   $_SESSION['respenvoi']=1; 
  }
  if($finden==0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercicepdf/".$nom1;
    
   move_uploaded_file($_FILES["pdfexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
   $req = $bdd->prepare('INSERT INTO exercice(texte,pdf,image,idlecon) VALUES(?,?,?,?)'); 
   $req->execute(array(' ',$no,' ',$idlecon)); 
   $_SESSION['respenvoi']=1; 
  }
 
   }
   if($verif==0 OR $verif1==0){
         $_SESSION['respenvoi']=2; 
     }
   }
     header('location:organiser3.php');
    
}

//FIN IMAGE PDF EXO LECON




//DEB 2 IMAGE PDF EXO LECON

if(isset($_POST['engmodexo2'])){ 
  $idlecon=  $_POST['engmodexo2'];
   

  if(!empty($_FILES["imagexo"]["name"])){
   $nom=$_FILES["imagexo"]["name"]; // on recupere le nom de l'image avec son extension
   $taille=$_FILES["imagexo"]["size"];  //optionnelle, mnt vous avez la taille
     
   
   list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
   $verif=0;
   $verif1=0; 
     
     $ext=".".strtolower($ext); // on rajoute un . devant l'extention
    
     if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
       $verif=1;
     }
     if($taille<=8000000){
        $verif1=1;
     }
    
   // $bdd->lastInsertId();
     $no="exo".$idlecon;  
 $nom1="exo".$idlecon.$ext;
 $nomv1="exercice/exo".$idlecon.$ext;
 if($verif==1 AND $verif1==1){
  $idutil=1;
  $finden=imagexoexist($idlecon);
  if($finden!=0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercice/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["imagexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
   $rdw="UPDATE image SET image='".$nom1."' WHERE idlecon='".$idlecon."' ";
   $reqdw=$bdd->query($rdw);
   $_SESSION['respenvoi']=1; 
  }
  

  if($finden==0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercice/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["imagexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
  $req = $bdd->prepare('INSERT INTO exercice(texte,pdf,image,idlecon) VALUES(?,?,?,?)'); 
   $req->execute(array(' ',' ',$nom1,$idlecon)); 
   $_SESSION['respenvoi']=1; 
  }



 
   }
   if($verif==0 OR $verif1==0){
         $_SESSION['respenvoi']=2; 
     }
   }






  if(!empty($_FILES["pdfexo"]["name"])){
   $nom=$_FILES["pdfexo"]["name"]; // on recupere le nom de l'image avec son extension
   $taille=$_FILES["pdfexo"]["size"];  //optionnelle, mnt vous avez la taille
     
   
   list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
   $verif=0;
   $verif1=0; 
     
     $ext=".".strtolower($ext); // on rajoute un . devant l'extention
    
     if($ext==".pdf"){
       $verif=1;
     }
     if($taille<=8000000){
        $verif1=1;
     }
    
   
     $no= "exo".$idlecon."-pdf" ;
 $nom1="exo".$idlecon."-pdf.pdf";
 $nomv1="exercicepdf/exo".$idlecon."-pdf.pdf";
 if($verif==1 AND $verif1==1){
  $idutil=1;
  $finden=imagexoexist($idlecon); echo $idlecon;
  if($finden!=0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercicepdf/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["pdfexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
       $rdw="UPDATE exercice SET pdf='".$no."' WHERE idlecon='".$idlecon."' ";
       $reqdw=$bdd->query($rdw);
   $_SESSION['respenvoi']=1; 
  }
  if($finden==0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "exercicepdf/".$nom1;
    
   move_uploaded_file($_FILES["pdfexo"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
   $req = $bdd->prepare('INSERT INTO exercice(texte,pdf,image,idlecon) VALUES(?,?,?,?)'); 
   $req->execute(array(' ',$no,' ',$idlecon)); 
   $_SESSION['respenvoi']=1; 
  }
 
   }
   if($verif==0 OR $verif1==0){
         $_SESSION['respenvoi']=2; 
     }
   }
   header('location:accesimagexo.php');
    
}

//FIN 2 IMAGE PDF EXO LECON



if(isset($_POST['supexoimage'])){ 
  $idlecon=  $_POST['supexoimage'];
  $nom="exo".$idlecon.".png";
  $chemin = "exercice/".$nom;
  unlink($chemin);
  $nom="exo".$idlecon.".jpg";
  $chemin = "exercice/".$nom;
  unlink($chemin);
 // $rdw="UPDATE exercice SET image=' ' WHERE idlecon='".$idlecon."' ";
   //    $reqdw=$bdd->query($rdw);

  header('location:accesimagexo.php');
}


if(isset($_POST['supexopdf'])){ 
  $idlecon=  $_POST['supexopdf'];
  $nom="exo".$idlecon."-pdf.pdf";
  $chemin = "exercicepdf/".$nom;
  unlink($chemin);
 // $rdw="UPDATE exercice SET pdf=' ' WHERE idlecon='".$idlecon."' ";
  //     $reqdw=$bdd->query($rdw);

  header('location:accesimagexo.php');
}




 if(isset($_POST['ajnewchap'])){
  $nomchap=$_POST['newchap'];
  $ordre=$_POST['ordr'];
  $aller=existestenseigne($_SESSION['idclasorg2'],$_SESSION['idmatorg2']);
     
    $reqq=$bdd->prepare('INSERT INTO chapitre(nomchapitre,idestenseigne,ordre) VALUES( ?,?,?)');
    $reqq->execute(array($nomchap,$aller,$ordre)); 
      header('location:organiser2.php');
   
}


if(isset($_POST['ajnewlec'])){ 
   $idutil=1;
  $nomlec=$_POST['newlecon'];
  $ordre=$_POST['ordre'];
  $idchap=$_POST['chapitre'];
  $newvideo=$_POST['newvideo'];
  $date=date('Y.m.d'); $heure=date('H:i');

 
     
   $reqq=$bdd->prepare('INSERT INTO lecon(nomlecon,texte,video,pdf,idchapitre,image,date,heure,ordre,idutilisateur) VALUES(?,?,?,?,?,?,?,?,?,?)');
    $reqq->execute(array($nomlec,' ',$newvideo,' ',$idchap,' ',$date,$heure,$ordre,$idutil)); 
    $idlecon=$bdd->lastInsertId();
    

  if(!empty($_FILES["fichimg"]["name"])){
  $tabname=array();  
    $tabname=$_FILES["fichimg"]["name"];
    $t1=count($tabname);
    if($t1>0){ 
    for($i=0;$i<$t1;$i++){
      $nom=$_FILES["fichimg"]["name"][$i];
      $taille=$_FILES["fichimg"]["size"][$i];

      list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
      $verif=0;
      $verif1=0; 
        
        $ext=".".strtolower($ext); // on rajoute un . devant l'extention
       
        if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
          $verif=1;
        }
        if($taille<=8000000){
           $verif1=1;
        }
       
        $reqq=$bdd->prepare('INSERT INTO leconimg(idlecon,imgleconorig,imglecon,ordre,date,heure,idutilisateur) VALUES(?,?,?,?,?,?,?)');
        $reqq->execute(array($idlecon,$nom,' ',' ',' ',' ',$idutil)); 
        $idleconimg=$bdd->lastInsertId();
        $no="lecon".$idlecon;  
    $nom1="lecon".$idleconimg.$ext;
    $nomv1="lecon/lecon".$idleconimg.$ext;
    if($verif==1 AND $verif1==1){
     $idutil=1; echo $idutil;
     if(file_exists($nomv1)!=0){
      $dat=date('Y.m.d'); $heu=date('H:i');
      $chemin = "lecon/".$nom1;
      unlink($chemin);
      move_uploaded_file($_FILES["fichimg"]["tmp_name"][$i],$chemin); // on envoie le fichier a l'endroit voulu
      
          $rdw="UPDATE leconimg SET imglecon='".$nom1."' WHERE idleconimg='".$idleconimg."' ";
          $reqdw=$bdd->query($rdw);
          $rdw="UPDATE leconimg SET date='".$dat."' WHERE idleconimg='".$idleconimg."' ";
          $reqdw=$bdd->query($rdw);
          $rdw="UPDATE leconimg SET heure='".$heu."' WHERE idleconimg='".$idleconimg."' ";
          $reqdw=$bdd->query($rdw);
      $_SESSION['respenvoi']=1; 
     }
     
   
     if(file_exists($nomv1)==0){
      $dat=date('Y.m.d'); $heu=date('H:i');
      $chemin = "lecon/".$nom1;
       
      move_uploaded_file($_FILES["fichimg"]["tmp_name"][$i],$chemin); // on envoie le fichier a l'endroit voulu
      
          $rdw="UPDATE leconimg SET imglecon='".$nom1."' WHERE idleconimg='".$idleconimg."' ";
          $reqdw=$bdd->query($rdw);
          $rdw="UPDATE leconimg SET date='".$dat."' WHERE idleconimg='".$idleconimg."' ";
          $reqdw=$bdd->query($rdw);
          $rdw="UPDATE leconimg SET heure='".$heu."' WHERE idleconimg='".$idleconimg."' ";
          $reqdw=$bdd->query($rdw);
          
      $_SESSION['respenvoi']=1; 
     }
   
   
   
    
      }
      if($verif==0 OR $verif1==0){
            $_SESSION['respenvoi']=2; 
        }



    }
  }
  }
 





  if(!empty($_FILES["fichpdf"]["name"])){
   $nom=$_FILES["fichpdf"]["name"]; // on recupere le nom de l'image avec son extension
   $taille=$_FILES["fichpdf"]["size"];  //optionnelle, mnt vous avez la taille
     
   
   list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    
 
   $verif=0;
   $verif1=0; 
     
     $ext=".".strtolower($ext); // on rajoute un . devant l'extention
    
     if($ext==".pdf"){
       $verif=1;
     }
     if($taille<=8000000){
        $verif1=1;
     }
    
   
     $no= "lecon".$idlecon."-pdf" ;
 $nom1="lecon".$idlecon."-pdf.pdf";
 $nomv1="leconpdf/lecon".$idlecon."-pdf.pdf";
 if($verif==1 AND $verif1==1){
  $idutil=1;
  if(file_exists($nomv1)!=0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "leconpdf/".$nom1;
   unlink($chemin);
   move_uploaded_file($_FILES["fichpdf"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
   $rdw="UPDATE lecon SET idutilisateur='".$idutil."' WHERE idlecon='".$idlecon."' ";
       $reqdw=$bdd->query($rdw);
       $rdw="UPDATE lecon SET pdf='".$no."' WHERE idlecon='".$idlecon."' ";
       $reqdw=$bdd->query($rdw);
   $_SESSION['respenvoi']=1; 
  }
  if(file_exists($nomv1)==0){
   $dat=date('Y.m.d'); $heu=date('H:i');
   $chemin = "leconpdf/".$nom1;
    
   move_uploaded_file($_FILES["fichpdf"]["tmp_name"],$chemin); // on envoie le fichier a l'endroit voulu
   $rdw="UPDATE lecon SET pdf='".$no."' WHERE idlecon='".$idlecon."' ";
       $reqdw=$bdd->query($rdw);
        
   $_SESSION['respenvoi']=1; 
  }
 
   }
   if($verif==0 OR $verif1==0){
         $_SESSION['respenvoi']=2; 
     }
   }
        header('location:organiser3.php');
    
}









if(isset($_POST['ajtimgeexo'])){ 
  $idutil=1;
 $idlecon=$_SESSION['idleconbild'];

 $date=date('Y.m.d'); $heure=date('H:i');

 if(!empty($_FILES["fichimg"]["name"])){
 $tabname=array();  
   $tabname=$_FILES["fichimg"]["name"];
   $t1=count($tabname);
   if($t1>0){  
   for($i=0;$i<$t1;$i++){    echo $idlecon;
     $nom=$_FILES["fichimg"]["name"][$i];
     $taille=$_FILES["fichimg"]["size"][$i];
     
     list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    

     $verif=0;
     $verif1=0; 
       
       $ext=".".strtolower($ext); // on rajoute un . devant l'extention
      
       if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
         $verif=1;
       }
       if($taille<=8000000){
          $verif1=1;
       }
      
       $reqq=$bdd->prepare('INSERT INTO exercice(texte,pdf,image,idlecon) VALUES(?,?,?,?)');
       $reqq->execute(array(' ',' ',' ',$idlecon)); 
       $idleconimg=$bdd->lastInsertId();
       $no="exoo".$idlecon;  
   $nom1="exoo".$idleconimg.$ext;
   $nomv1="exercice/exoo".$idleconimg.$ext;
   
   if($verif==1 AND $verif1==1){
    $idutil=1; echo $idutil;
    if(file_exists($nomv1)!=0){
     $dat=date('Y.m.d'); $heu=date('H:i');
     $chemin = "exercice/".$nom1;
     unlink($chemin);
     move_uploaded_file($_FILES["fichimg"]["tmp_name"][$i],$chemin); // on envoie le fichier a l'endroit voulu
     
         $rdw="UPDATE exercice SET image='".$nom1."' WHERE idexo='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
         
     $_SESSION['respenvoi']=1; 
    }
    
  
    if(file_exists($nomv1)==0){
     $dat=date('Y.m.d'); $heu=date('H:i');
     $chemin = "exercice/".$nom1;
      
     move_uploaded_file($_FILES["fichimg"]["tmp_name"][$i],$chemin); // on envoie le fichier a l'endroit voulu
     
         $rdw="UPDATE exercice SET image='".$nom1."' WHERE idexo='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
          
     $_SESSION['respenvoi']=1; 
    }


     }
     if($verif==0 OR $verif1==0){
           $_SESSION['respenvoi']=2; 
       }



   }
 }
 }

   header('location:accesimagexo.php');
   
}











if(isset($_POST['ajtimglecon'])){ 
  $idutil=1;
 $idlecon=$_SESSION['idleconbild'];

 $date=date('Y.m.d'); $heure=date('H:i');

 if(!empty($_FILES["fichimg"]["name"])){
 $tabname=array();  
   $tabname=$_FILES["fichimg"]["name"];
   $t1=count($tabname);
   if($t1>0){  
   for($i=0;$i<$t1;$i++){    echo $idlecon;
     $nom=$_FILES["fichimg"]["name"][$i];
     $taille=$_FILES["fichimg"]["size"][$i];
     
     list($name, $ext) = explode(".", $nom);   // on separe le nom de l'image de son extension    

     $verif=0;
     $verif1=0; 
       
       $ext=".".strtolower($ext); // on rajoute un . devant l'extention
      
       if($ext==".png" OR $ext==".jpg" OR $ext==".jpeg"  OR $ext==".tiff"){
         $verif=1;
       }
       if($taille<=8000000){
          $verif1=1;
       }
      
       $reqq=$bdd->prepare('INSERT INTO leconimg(idlecon,imgleconorig,imglecon,ordre,date,heure,idutilisateur) VALUES(?,?,?,?,?,?,?)');
       $reqq->execute(array($idlecon,$nom,' ',' ',' ',' ',$idutil)); 
       $idleconimg=$bdd->lastInsertId();
       $no="lecon".$idlecon;  
   $nom1="lecon".$idleconimg.$ext;
   $nomv1="lecon/lecon".$idleconimg.$ext;
   
   if($verif==1 AND $verif1==1){
    $idutil=1; echo $idutil;
    if(file_exists($nomv1)!=0){
     $dat=date('Y.m.d'); $heu=date('H:i');
     $chemin = "lecon/".$nom1;
     unlink($chemin);
     move_uploaded_file($_FILES["fichimg"]["tmp_name"][$i],$chemin); // on envoie le fichier a l'endroit voulu
     
         $rdw="UPDATE leconimg SET imglecon='".$nom1."' WHERE idleconimg='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
         $rdw="UPDATE leconimg SET date='".$dat."' WHERE idleconimg='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
         $rdw="UPDATE leconimg SET heure='".$heu."' WHERE idleconimg='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
     $_SESSION['respenvoi']=1; 
    }
    
  
    if(file_exists($nomv1)==0){
     $dat=date('Y.m.d'); $heu=date('H:i');
     $chemin = "lecon/".$nom1;
      
     move_uploaded_file($_FILES["fichimg"]["tmp_name"][$i],$chemin); // on envoie le fichier a l'endroit voulu
     
         $rdw="UPDATE leconimg SET imglecon='".$nom1."' WHERE idleconimg='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
         $rdw="UPDATE leconimg SET date='".$dat."' WHERE idleconimg='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
         $rdw="UPDATE leconimg SET heure='".$heu."' WHERE idleconimg='".$idleconimg."' ";
         $reqdw=$bdd->query($rdw);
         
     $_SESSION['respenvoi']=1; 
    }


     }
     if($verif==0 OR $verif1==0){
           $_SESSION['respenvoi']=2; 
       }



   }
 }
 }

  header('location:accesimage.php');
   
}








if(isset($_POST['suplecon']) ){
    $idlecon=$_POST['suplecon'];
  $pdf="lecon".$idlecon."-pdf.pdf";
  $dirp="leconpdf/".$pdf;
  unlink($dirp);

  $img=imagelecon($idlecon);
  $diri="lecon/".$img;
  unlink($diri);
  $rdw="DELETE FROM lecon  WHERE idlecon='".$idlecon."'";
  $reqdw=$bdd->query($rdw);
  header('location:organiser3.php');
}

if(isset($_POST['supleconimg']) ){
  $idlecon=$_POST['supleconimg'];
$img=imagelecon($idlecon);
$diri="lecon/".$img;
unlink($diri);
 
header('location:organiser3.php');
}


if(isset($_POST['supleconpdf']) ){
  $idlecon=$_POST['supleconpdf'];
$pdf="lecon".$idlecon."-pdf.pdf";
$dirp="leconpdf/".$pdf; echo $pdf; 
unlink($dirp);
 header('location:organiser3.php');
}



if(isset($_POST['supchap']) ){
  $idchap=$_POST['supchap'];
  $rdw="DELETE FROM chapitre  WHERE idchapitre='".$idchap."'";
  $reqdw=$bdd->query($rdw);

  $v="SELECT * FROM lecon WHERE idchapitre='".$idchap."'";
  $reponse = $bdd->query($v);
  while ($donnees = $reponse->fetch())
	{
  $idlecon=$donnees['idlecon'];
$pdf="lecon".$idlecon."-pdf.pdf";
$dirp="leconpdf/".$pdf;
unlink($dirp);

$img=imagelecon($idlecon);
$diri="lecon/".$img;
unlink($diri);
$rdw="DELETE FROM lecon  WHERE idlecon='".$idlecon."'";
$reqdw=$bdd->query($rdw);
} 
	$reponse->closeCursor(); 


header('location:organiser3.php');
}

if(isset($_POST['subimage'])){
  $long=$_POST['subimage']; 
  if($long>1){ 
      for($i=1;$i<$long;$i++){
        $ligne='ligne'.$i;
        $value=$_POST[$ligne] ;
        $chpid='chpid'.$i;
        $id=$_POST[$chpid] ; echo $id;
        $r="UPDATE leconimg SET ordre='".$value."' WHERE idleconimg='".$id."'";
        $req=$bdd->query($r);
        } 
     
  }
   header('location:accesimage.php');
}



if(isset($_POST['subimagexo'])){
  $long=$_POST['subimagexo']; 
  if($long>1){ 
      for($i=1;$i<$long;$i++){
        $ligne='ligne'.$i;
        $value=$_POST[$ligne] ;
        $chpid='chpid'.$i;
        $id=$_POST[$chpid] ; echo $id;
        $r="UPDATE exercice SET texte='".$value."' WHERE idexo='".$id."'";
        $req=$bdd->query($r);
        } 
     
  }
   header('location:accesimagexo.php');
}

if(isset($_POST['deletebild'])){
  $id=$_POST['deletebild']; echo $id;
  $v="SELECT * FROM leconimg ";
  $reponse = $bdd->query($v);
  while ($donnees = $reponse->fetch())
	{
    if($donnees['idleconimg']==$id){ 
  $lecon=$donnees['imglecon'];
$dirp="lecon/".$lecon;
unlink($dirp);
$r="DELETE FROM leconimg WHERE idleconimg='".$id."'";
 $req=$bdd->query($r);
 }
} 
	$reponse->closeCursor(); 
header('location:accesimage.php');
}



if(isset($_POST['deletebildexo'])){
  $id=$_POST['deletebildexo']; echo $id;
  $v="SELECT * FROM exercice ";
  $reponse = $bdd->query($v);
  $true=0;
  while ($donnees = $reponse->fetch() AND $true==0)
	{
    if($donnees['idexo']==$id){
  $lecon=$donnees['image'];
$dirp="exercice/".$lecon;
unlink($dirp);
$r="DELETE FROM exercice WHERE idexo='".$id."'";
 $req=$bdd->query($r);
  $true=1;
  }
} 
	$reponse->closeCursor(); 
header('location:accesimagexo.php');
}

   ?>