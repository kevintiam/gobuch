<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
require 'connectC.php';  require 'inscripfunction.php'; require 'lesmenus.php';
require 'lesmenushoriz.php'; require 'listabrvtype.php'; require 'etattranche.php'; 
require 'bilrecetfunction.php';
try 
{
    $bdd = new PDO(host(),UTIL(),mtp()); 
} 
catch(Exception $e) 
{       
die('Erreur : '.$e->getMessage());
}
 /*	$v="SELECT *  FROM classe1  WHERE id>='1' AND id<='10'";
	$reponse = $bdd->query($v);
  $true=0;
  while ($donnees = $reponse->fetch() )
  {
 $code= $donnees['code'] ; 
 $niveau= $donnees['niveau'] ;
 $type= $donnees['typeEns'] ;
 $cycle= $donnees['cycle'] ; 
 $req = $bdd->prepare('INSERT INTO classe1(code,niveau,typeEns,cycle,etab0,anc,anens) VALUES(?,?,?,?,?, ?,?)'); 
 $req->execute(array($code,$niveau,$type,$tel,$cycle,'50','0','2021/2022')); 


	  
  } 
  $reponse->closeCursor();*/
  
  
  $r="UPDATE classe1 SET anens = '2022/2023'  WHERE anc='1'";
  $req=$bdd->query($r); 

  /*

-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 05 Juin 2022 à 04:14
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `college1test`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe1`
--

CREATE TABLE IF NOT EXISTS `classe1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) CHARACTER SET utf8 NOT NULL,
  `niveau` varchar(30) CHARACTER SET utf8 NOT NULL,
  `typeEns` int(11) NOT NULL,
  `cycle` int(11) NOT NULL,
  `etab0` int(11) NOT NULL,
  `anc` int(11) NOT NULL,
  `anens` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Contenu de la table `classe1`
--

INSERT INTO `classe1` (`id`, `code`, `niveau`, `typeEns`, `cycle`, `etab0`, `anc`, `anens`) VALUES
(1, '6EME-1', '1', 1, 1, 15, 0, '2022/2023'),
(2, '6EME-2', '1', 1, 1, 15, 0, '2022/2023'),
(3, '6EME-3', '1', 1, 1, 50, 0, '2022/2023'),
(4, '5EME-1', '1', 1, 1, 15, 0, '2022/2023'),
(5, '5EME-2', '1', 1, 1, 0, 0, '2022/2023'),
(6, '5EME-3', '1', 1, 1, 0, 0, '2022/2023'),
(7, '4ALL-1', '2', 1, 1, 15, 0, '2022/2023'),
(8, '4ESP-1', '3', 1, 1, 0, 0, '2022/2023'),
(9, '4ESP-2', '3', 1, 1, 0, 0, '2022/2023'),
(10, '4ESP-3', '3', 1, 1, 0, 0, '2022/2023'),
(11, '4MIXTE', '2a', 1, 1, 15, 0, '2022/2023'),
(12, '3ALL-1', '4', 1, 1, 15, 0, '2022/2023'),
(13, '3ESP-1', '5', 1, 1, 0, 0, '2022/2023'),
(14, '3ESP-2', '5', 1, 1, 0, 0, '2022/2023'),
(15, '3ESP-3', '5', 1, 1, 0, 0, '2022/2023'),
(16, '3MIXTE', '4a', 1, 1, 15, 0, '2022/2023'),
(17, '2NDE-A4-ALL', '6', 1, 2, 0, 0, '2022/2023'),
(18, '2NDE-A4-ESP', '7', 1, 2, 0, 0, '2022/2023'),
(19, '2NDE-A4-ALL-ESP', '6a', 1, 2, 15, 0, '2022/2023'),
(20, '2NDE-C1', '8', 1, 2, 0, 0, '2022/2023'),
(21, '2NDE-C2', '8', 1, 2, 0, 0, '2022/2023'),
(22, '2NDE-STT', '14', 2, 2, 50, 0, '2022/2023'),
(23, '2NDE-SES', '49', 2, 2, 50, 0, '2022/2023'),
(24, '2NDE-ESF', '50', 2, 2, 50, 0, '2022/2023'),
(25, '2NDE-F8', '48', 2, 2, 50, 0, '2022/2023'),
(26, '1ERE-A4-ALL', '10', 1, 2, 0, 0, '2022/2023'),
(27, '1ERE-A4-ESP', '11', 1, 2, 0, 0, '2022/2023'),
(28, '1ERE-A4-ALL-ESP', '10a', 1, 2, 0, 0, '2022/2023'),
(29, '1ERE-C', '8', 1, 2, 0, 0, '2022/2023'),
(30, '1ERE-D1', '8', 1, 2, 0, 0, '2022/2023'),
(31, '1ERE-D2', '8', 1, 2, 0, 0, '2022/2023'),
(32, '1ERE-D3', '8', 1, 2, 0, 0, '2022/2023'),
(33, '1ERE-C-D', '8', 1, 2, 0, 0, '2022/2023'),
(34, '1ERE-ACA', '17', 2, 2, 50, 0, '2022/2023'),
(35, '1ERE-ACC', '15', 2, 2, 0, 0, '2022/2023'),
(36, '1ERE-CG', '16', 2, 2, 50, 0, '2022/2023'),
(37, '1ERE-FIG', '54', 2, 2, 50, 0, '2022/2023'),
(38, '1ERE-F2', '19', 3, 2, 0, 0, '2022/2023'),
(39, '1ERE-F3', '19', 3, 2, 50, 0, '2022/2023'),
(40, '1ERE-F4', '29', 3, 2, 50, 0, '2022/2023'),
(41, '1ERE-F5', '30', 3, 2, 50, 0, '2022/2023'),
(42, '1ERE-F8', '31', 2, 2, 50, 0, '2022/2023'),
(43, '1ERE-E', '32', 3, 2, 50, 0, '2022/2023'),
(44, '1ERE-IH', '33', 3, 2, 50, 0, '2022/2023'),
(45, '1ERE-IS-RH', '55', 3, 2, 50, 0, '2022/2023'),
(46, '1ERE-ESF', '34', 2, 2, 50, 0, '2022/2023'),
(47, '1ERE-GT-TO', '38', 3, 2, 50, 0, '2022/2023'),
(48, '1ERE-MEB', '51', 3, 2, 50, 0, '2022/2023'),
(49, '1ERE-CMA-MVT', '35', 3, 2, 50, 0, '2022/2023'),
(50, '1ERE-MEM', '36', 3, 2, 50, 0, '2022/2023'),
(51, '1ERE-MEH', '37', 3, 2, 50, 0, '2022/2023'),
(52, '1ERE-MA', '39', 3, 2, 50, 0, '2022/2023'),
(53, '1ERE-MISE', '53', 3, 2, 50, 0, '2022/2023'),
(54, '1ERE-SES', '40', 2, 2, 50, 0, '2022/2023'),
(55, '1ERE-TI', '52', 3, 2, 50, 0, '2022/2023'),
(57, 'TLE-A4-ALL', '12', 1, 2, 0, 0, '2022/2023'),
(58, 'TLE-A4-ESP', '13', 1, 2, 0, 0, '2022/2023'),
(59, 'TLE-A4-ALL-ESP', '12a', 1, 2, 10, 0, '2022/2023'),
(60, 'TLE-C', '9', 1, 2, 50, 0, '2022/2023'),
(61, 'TLE-D1', '9', 1, 2, 0, 0, '2022/2023'),
(62, 'TLE-D2', '9', 1, 2, 0, 0, '2022/2023'),
(63, 'TLE-C-D', '9', 1, 2, 0, 0, '2022/2023'),
(64, 'TLE-ACA', '18', 2, 2, 50, 0, '2022/2023'),
(65, 'TLE-ACC', '19', 2, 2, 0, 0, '2022/2023'),
(66, 'TLE-CG', '20', 2, 2, 0, 0, '2022/2023'),
(67, 'TLE-FIG', '59', 2, 2, 50, 0, '2022/2023'),
(68, 'TLE-F1', '47', 3, 2, 0, 0, '2022/2023'),
(69, 'TLE-F2', '21', 3, 2, 0, 0, '2022/2023'),
(70, 'TLE-F3', '22', 3, 2, 50, 0, '2022/2023'),
(71, 'TLE-F4', '41', 3, 2, 50, 0, '2022/2023'),
(72, 'TLE-F5', '42', 3, 2, 50, 0, '2022/2023'),
(73, 'TLE-F8', '23', 2, 2, 50, 0, '2022/2023'),
(74, 'TLE-E', '24', 3, 2, 50, 0, '2022/2023'),
(75, 'TLE-IH', '25', 3, 2, 50, 0, '2022/2023'),
(76, 'TLE-ESF', '26', 2, 2, 50, 0, '2022/2023'),
(77, 'TLE-CMA-MVT', '27', 3, 2, 50, 0, '2022/2023'),
(78, 'TLE-MEM', '28', 3, 2, 50, 0, '2022/2023'),
(79, 'TLE-MEH', '43', 3, 2, 50, 0, '2022/2023'),
(80, 'TLE-GT-TO', '44', 3, 2, 50, 0, '2022/2023'),
(81, 'TLE-MA', '45', 3, 2, 50, 0, '2022/2023'),
(82, 'TLE-SES', '46', 2, 2, 50, 0, '2022/2023'),
(83, 'TLE-MISE', '56', 3, 2, 50, 0, '2022/2023'),
(84, 'TLE-MEB', '57', 3, 2, 50, 0, '2022/2023'),
(85, 'TLE-TI', '60', 3, 2, 50, 0, '2022/2023'),
(86, 'TLE-IS-RH', '58', 3, 2, 50, 0, '2022/2023');


  */
 
?>