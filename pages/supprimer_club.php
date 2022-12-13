<?php
include("cnx.php");
$id=$_GET["id"];//id club a supp
$r=$_GET["r"];
//
$req="DELETE FROM club WHERE Id =?";
$req=$db->prepare($req);
$req->execute([$id]);
//
 $suppM="DELETE  from apprenant where Id_club=?";
 $suppM=$db->prepare($suppM);
 $suppM->execute([$id]);
header("location:../recherch.php?r=".$r);
?>