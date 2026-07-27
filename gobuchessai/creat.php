

<?php



try 
{
 $bdd = new PDO('mysql:host=localhost','root',' ');  
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
 }
//  SV6PduF7v8UDq5S
$r="CREATE DATABASE u356752624_aaaaaaaa ";
    $req=$bdd->query($r); 

echo $r;
 

?>
