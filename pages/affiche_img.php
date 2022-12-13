<?php
include("cnx.php");
$id=$_GET["id"];
$req=$db->prepare("select * from club where Id=? ");
 $req->setFetchMode (PDO::FETCH_ASSOC); 
 $req->execute(array($id));
  $tab=$req->fetchAll(); 
  echo $tab[0]["Logo"];
?>