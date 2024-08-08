<?php
session_start();
include_once "db.php";
$idd=$_GET["idd"];
$sql="delete from todo where id=:idd";
$stm=$conn->prepare($sql);
$stm->bindParam(':idd',$idd);
$stm->execute();
$_SESSION["delete"]="the task was deleted successflly ! ";
header('location:main.php');
exit;
?>