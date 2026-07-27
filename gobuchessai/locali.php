<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
/*  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['yuser']=" "; $_SESSION['ymtp']=" "; 
$_SESSION['departdemande']=-1;

*/
require 'connectC.php';   require 'lesmenusgerer.php'; require 'lesfunctions.php'; 
$ip=$_SERVER['REMOTE_ADDR'];
$ipinfo=@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
echo "pays : ".$ipinfo->geoplugin_countryName." !!! VILLE : ".$ipinfo->geoplugin_city." !!! continent : ".$ipinfo->geoplugin_continentName;




try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
 $v="SELECT *  FROM auditconnexion ORDER BY idaudit DESC";
			  $reponse = $bdd->query($v);
	 
	while ($donnees = $reponse->fetch() )
	{
		$iadr= $donnees['adrip'];	 $idadit=$donnees['idaudit'];
		$ipinfo=@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$iadr));
$pays=$ipinfo->geoplugin_countryName; $VILLE=$ipinfo->geoplugin_city; $continent=$ipinfo->geoplugin_continentName;
$r="UPDATE  auditconnexion SET ville='".$VILLE."' WHERE idaudit='".$idadit."'";
	$req=$bdd->query($r);
$r="UPDATE  auditconnexion SET pays='".$pays."' WHERE idaudit='".$idadit."'";
	$req=$bdd->query($r);
			 
	} 
	$reponse->closeCursor(); 

 ?>