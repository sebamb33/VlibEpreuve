<?php
require_once 'lib/dispatcher.php';

// Verification  pour voir si il y'a déja un menu principale ou non 
if (isset($_GET['vlibMP'])){
    $_SESSION['vlibMP']= $_GET['vlibMP'];
}
// sinon affecte au menu principal la valeur par defaut
else{
    if(!isset($_SESSION['vlibMP'])){
        $_SESSION['vlibMP']="accueil";
    }
}
//Si on viens d'entrer des information dans le formulaire inscription
if(isset($_POST["nomInsc"]))
{
    $user= new Utilisateur($_POST["nomInsc"],$_POST["prenomInsc"],$_POST["email"],$_POST["selectSexe"],$_POST["datenaissance"],$_POST["numerovoie"],$_POST["supplementAddr"],$_POST["tel"],$_POST["ville"],$_POST["cdp"]);
    $retour=UtilisateurDao::VerificationUtilisateurMail($user);
    
    //Si aucun utilisateur trouvé avec le même mail dans la bdd
    if(count($retour)==0)
    {
       //Genere un login et check si il n'est pas déja present dans la bd 
       $user->genererLogin();
       //Generation mot de passe temporaire pour que l'utilisateur puisse faire sa première connexion 
       $user->genererMDP();
       //Insertion de l'utilisateur dans la base de données
      if(UtilisateurDao::InscriptionUtilisateur($user)==1)
      {
        print("<script>alert(\"Votre  Login est : ".$user->getLOGIN()."  Votre mot de passe générer est : ".$user->getMDP()."\");</script>");
      }else
      {
        print("<script>alert(\"Votre inscription à échouer merci de verifier les saisies, exemple de date (05/03/2000)\");</script>");
      }
    }else
    {
        print("<script>alert(\"Le mail saisi est déja utilisé\");</script>");
    }
// print_r($user);
}
//Si on viens du formulaire de connexion 

if(isset($_POST["login"])and isset($_POST["mdp"]))
{
    $retour=UtilisateurDao::connexionUtilisateur($_POST["login"],$_POST["mdp"]);
    if(count($retour)==0)
    {
        print("<script>alert(\"Vos identifiant sont incorect\");</script>");
    }else
    {
        $_SESSION['vlibMP']="infoUtilisateur";
        $utilConnecter=new Utilisateur();
        $utilConnecter->hydrate($retour);
        $_SESSION["dataUser"]=serialize($utilConnecter);
    }
}


//Si on viens de changer sa formule d'abonnement dans les paramètres
if(isset($_POST["selectAbonn"]))
{
    $user=new Utilisateur();
    $user=unserialize($_SESSION["dataUser"]);
    $idUtil=$user->getIDUTIL();
    $abonnementSelectLibelle = $_POST["selectAbonn"];
    $codeA=abonnementDAO::ChargementCodeA($abonnementSelectLibelle)[0];
    //Definis le date debut et date fin de l'abonnement 
    if($codeA!=0)
    {
        //Changement des dates dans l'objet utilisateur en fonction de l'abonnement choisi
        $user->calculDate($codeA);
        UtilisateurDao::ChangeDateAbon($user->getIDUTIL(),$user->getCODEA());
        $_SESSION["dataUser"]=serialize($user);
    }

    //Si la requete est valider par la BD
    if(UtilisateurDao::modifAbonnement($idUtil,$codeA)==1)
    {
        print("<script>alert(\"Votre abonnement à était modifier pour le  format : ".$abonnementSelectLibelle."\");</script>");
        //modification du codeA dans  l'objet utilisateur
        $user->setCODEA($codeA);
        $_SESSION["dataUser"]=serialize($user);
    }else
    {
        print("<script>alert(".$codeA.");</script>");
        
    }
}

// Quand l'utilisateur modifie son solde dans l'espace paramètre
if(isset($_POST["sommePay"]))
{
    $user=new Utilisateur();
    $user=unserialize($_SESSION["dataUser"]);
    $sommeAjout=$_POST["sommePay"];
    $msgAlert="<script>alert(La valeur saisie est pas bonne ou votre solde est supérieur à 50 après l'ajout )</script>";
    //Verification que ça soit bien un nombre qui soit rentré
    if(!preg_match('/^([^0-9]+)$/', $sommeAjout))
    {
        if(floatval($sommeAjout)+$user->getCREDITTEMPS()<=50.0)
        {
            $somme=floatval($sommeAjout)+floatval($user->getCREDITTEMPS());
            $user->setCREDITTEMPS($somme);
            UtilisateurDao::RechargeSolde($user->getIDUTIL(),$somme);
            $_SESSION["dataUser"]=serialize($user);
        }else
        {
            print($msgAlert);
        }
    }

}

//Si l'utilisateur modifie ses informations

if(isset($_POST["emailParamModif"]))
{
    $user=new Utilisateur();
    $user=unserialize($_SESSION["dataUser"]);
    $emailModif=$_POST["emailParamModif"];
    $addrModif=$_POST["numerovoie"];
    $complAddrModif=$_POST["supplementAddr"];
    $villeModif=$_POST["ville"];
    $cdpModif=$_POST["cdp"];
    $numTelModif=$_POST["tel"];
    $mdpModif=$_POST["mdpModif"];
    if(UtilisateurDao::ModificationInfoUtilisateur($user->getIDUTIL(),$emailModif,$addrModif,$complAddrModif,$villeModif,$cdpModif,$numTelModif,$mdpModif)==1 and !preg_match('/^([^0-9]+)$/', $mdpModif))
    {
        print("<script>alert(' Votre mot de passe à était modifier  vous allez maintenant être déconnecté');</script>");
        require_once "controleurDeconnexion.php";
    }else
    {
        print("<script>alert(' Verifiez votre saisie, aucune modification');</script>");
    }
}


//Création du menu principale

if(isset($_SESSION["dataUser"]))
{
    $vlibMP = new Menu("menuPrincipal");
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("infoUtilisateur", "Mes infos"));
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("parametre", "Modifier mes options"));
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("rervations", "Réserver  🚲"));
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("deconnexion", "Se déconnecter ❌"));
    $menuPrincipal = $vlibMP->creerMenu($_SESSION['vlibMP'],'vlibMP');
    
}else{
    $vlibMP = new Menu("menuPrincipal");
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("accueil", "Accueil"));
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("stations", "Stations"));
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("abonnements", "Abonnements"));
    $vlibMP->ajouterComposant($vlibMP->creerItemLien("connexionAuth", "Connexion/Inscriptions"));
    $menuPrincipal = $vlibMP->creerMenu($_SESSION['vlibMP'],'vlibMP');
}
include_once dispatcher::dispatch($_SESSION['vlibMP']);


?>