<?php 
function connexion($unDsn,$unUser,$unPass)
{
    try{
        $uneConnex=new PDO($unDsn,$unUser,$unPass);
        return $uneConnex;
    }catch(PDOException $e){
        die("Erreur de connexion");
    }
 }
 ?>