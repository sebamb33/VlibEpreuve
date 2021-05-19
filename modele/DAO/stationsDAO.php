<?php
require_once 'modele/DAO/param.php';
require_once 'modele/DAO/accesDonnes.php';

class stationsDAO
{
    //recupère toutes les stations
    public static function chargementTouteStations()
    {
        $sql="SELECT * FROM station";
        $req=DBConnex::getInstance()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}