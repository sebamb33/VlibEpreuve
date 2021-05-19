<?php
//Tableaux ou je récupère  toute mes stations
$tab=stationsDAO::chargementTouteStations();
$tabObjStation=[];
foreach($tab as $uneStation)
{
    $stat=new Station();
    $stat->hydrate($uneStation);
    array_push($tabObjStation,$stat);
}
//Création de div  pour chaque station

$affichageStation="";

foreach($tabObjStation as $station)
{
    if($station->getETATS()=="Disponible")
    {
        $affichageStation.=" <div class=\"StatDispo\">
        <div class ='tabStation'>
            <div class='intituleStat'>Nom de station : </div> <div class='infoStat'>".$station->getNOMS()."</div>
            <div class='intituleStat'>etat : </div><div class='infoStat'>".$station->getETATS()." </div>
            <div class='intituleStat'>Nombre de bornes : </div> <div class='infoStat'>".$station->getNUMBORNE()."</div>
        </div>
        </div>";
    }else
    {
        $affichageStation.=" <div class=\"StatIndispo\">
        <div class ='tabStation'>
            
            <div class='intituleStat'>Nom de station : </div> <div class='infoStat'>".$station->getNOMS()."</div>
            <div class='intituleStat'>etat : </div><div class='infoStat'>".$station->getETATS()." </div>
            <div class='intituleStat'>Nombre de bornes : </div> <div class='infoStat'>".$station->getNUMBORNE()."</div>
        </div>
        </div>";
    }

}
require_once "vues/station.php";
