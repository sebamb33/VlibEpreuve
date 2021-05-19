<?php


function tableauHtml($tab,$entete , $classEntete, $classTab, $classLigne){
    $res = "<table class='" . $classTab ."'>";
    if(count($entete)>0){
        $res .= "<tr>";
        foreach ($entete as $cellule){
            $res .= "<th class='" . $classEntete . "'>" . $cellule . "</th>";
        }
        $res .= "</tr>";
    }
    if(count($tab)>0){
        foreach ($tab as  $ligne) {
            $res .= "<tr class='" . $classLigne . "'>";
            foreach ($ligne as $cellule) {
                $res .= "<td>" . $cellule . "</td>";
            }
            $res .= "</tr>";
        }
    }
    $res .= "</table>";
    return $res;
}



function tabStation($tab, $entete, $classTab){
    if(isset($_SESSION['abonne'])) {
        $Abonne = $_SESSION['abonne'];
        $lesVelo = $Abonne->getVELOS();
    } else{
        $leVelo = null;
    }
    $res = "<table class'" . $classTab . "'>";
    if(count($entete)){
        $res .= "<tr>";
        foreach ($entete as $cellule){
            $res .= "<th>" . $cellule . "</th>";
        }
        $res .= "</tr>";
    }
    if (count($tab) > 0){
        foreach($tab as $station){
            $res .= "<tr><td>";
            $res .= $station->getNUMS() . "</td><td>";
            $res .= $station->getNOMS() . "</td><td>";
            $res .= ($station->getCAPACITES() - $station->getNbVelos()) . "</td><td>";
            $res .= $station->getNbVelos() . "</td><td>";
            if(count($lesVelo) > 0 && ($station->getCAPACITES() - $station->getNbVelos()) > 0) {
                $res .= "<a href = 'index.php?numStationD=" . $station->getNUMS() . "'>";
                $res .= "<img title='Déposer' src='images/deposer.jpg' alt='lien'></a>";
            }else {
                $res .= "<img title='Dépôt impossible' src='images/deposerN.png' alt='lien'>";
            }
            if($station->getNbVelos() > 0) { //Vérifie qu'il y a un vélo sur la station
                $res .= "<a href='index.php?numStationE=" . $station->getNUMS() . "'>";
                $res .= "<img title='Emprunter' src='images/emprunter.jpg' alt=''></a></td></tr>";
            } else{
                $res .= "<img title='Emprunt impossible' src='images/emprunterN.png' alt=''></td></tr>";
            }
        }
    }
    $res .= "</table>";
    return $res;
}

