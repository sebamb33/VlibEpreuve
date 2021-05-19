<?php
    $user=new Utilisateur();
    $user=unserialize($_SESSION["dataUser"]);
   
    //Création des items sur les infos de l'utilisateur 


    //Premier item affichant le nom et le prenom
    $mesItems="<div class = \"itemInfoUtilisateur\"><div class =intituleItem>👨‍🦲Utilisateur</div><div class =\"sousIntituleItem\"> Nom : ".$user->getNOM()."</div><div class =\"sousIntTrois\">Prénom :".$user->getPRENOM()."</div><div class =\"sousIntQuatre\"> Login : ".$user->getLOGIN()."</div></div>";

    //Deuxieme item  servant à afficher les coordonées 
    $mesItems.="<div class = \"itemInfoUtilisateur\"><div class =intituleItem>🏡Votre adresse</div><div class =\"sousIntituleItem\">Votre adresse : ".$user->getADRESSE()."</div><div class =\"sousIntTrois\">Complément d'adresse : ".$user->getSUPLEMENTADDR()."</div><div class =\"sousIntQuatre\"> Numéro tel :".$user->getTEL()."</div></div>";

    // Trosième item affichant le type d'abonnement de l'utilisteur 
    if($user->getCODEA()==0)//Si l'utilisateur  n'a pas d'abonnement je met un fond gris 
    {
        $mesItems.="<div class = \"itemInfoUtilisateur\"><div class =intituleItem id=\"alerteAucunAbonnement\">📜Votre abonnement</div><div class =\"sousIntituleItem\">".abonnementDAO::libelleAbonnement($user)."</div></div>";
    }else
    {
        $mesItems.="<div class = \"itemInfoUtilisateur\"><div class =intituleItem id=\"aUnAbonnement\">📜Votre abonnement </div><div class =\"sousIntituleItem\">".abonnementDAO::libelleAbonnement($user)."</div><div class =\"sousIntTrois\">Date début  : ".$user->getDATEDEBABON()."</div><div class =\"sousIntQuatre\">Date fin : :".$user->getDATEFINABON()."</div></div>";
    }
   
    //Quatrième item  affichant le solde en euro de l'utilisateur 
    if(((float)$user->calculFinance())<2.0)
    {


        $mesItems.="<div class = \"itemInfoUtilisateur\"><div class =intituleItem id=\"alerteBasSolde\">💶 (Crédit Temps - Débit)</div><div class =\"sousIntituleItem\" id=\"affichageArgent\">".$user->calculFinance()." euro(s)</div><div class =\"sousIntTrois\"><form method=\"post\" action=\"controleurs/controleurRechargement.php\" name=\"fRech\" class=\"fRech\"><div class=\"ligne\"><input type=\"submit\" name=\"rechSolde\" id=\"rechSolde\" value=\"Recharger\"> </div></form></div></div>";
    }else
    {
        $mesItems.="<div class = \"itemInfoUtilisateur\"><div class =intituleItem id=\"aBonSolde\">💶 (Crédit Temps - Débit)</div><div class =\"sousIntituleItem\"id=\"affichageArgent\">".$user->calculFinance()." euro(s)</div></div>";
    }

    require_once "vues/infoUtilisateur.php";
?>