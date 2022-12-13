
<?php
include("cnx.php");
$id=$_GET["id"];
$r=$_GET["r"];
$supp="DELETE FROM apprenant where Id=?";
$supp=$db->prepare($supp);
$supp->execute([$id]);
header("location:../recherch.php?r=".$r);
?>