<?php
 $newsletter = "";
 if(isset($_POST)["newsletter"])

 {
   $newsletter = $_POST ["newsletter"];
   if(!empty($newsletter) && preg_match("/[A-Za-z] {4,30}/",$newsletter))
   {
    include("connexion.php");
    }
 }
 ?>