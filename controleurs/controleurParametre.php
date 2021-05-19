<?php
    $user=new Utilisateur();
    $user=unserialize($_SESSION["dataUser"]);
    // if(isset($_POST["nomModif"]))
    // {
    //     $userNew= new Utilisateur($_POST["nomModif"],$_POST["prenomModif"],$_POST["email"],$_POST["selectSexe"],$_POST["datenaissance"],$_POST["numerovoie"],$_POST["supplementAddr"],$_POST["tel"],$_POST["ville"],$_POST["cdp"]);
    //     //TODO   faire verification si la requete dans la bd fonctionne 
    //     $_SESSION["dataUser"]=serialize($us)
    // }



    $infoUser="<div class='labelInfoUser'> Login👨‍🦲 : <div class='infoUser'>".$user->getLOGIN()."</div>
    </div>
    <div class='labelInfoUser'> mail✉ :<div class='infoUser'>".$user->getMAIL()."</div>
    </div>
    <div class='labelInfoUser'>Abonnement :<div class='infoUser'>".abonnementDAO::libelleAbonnement($user)."</div>
    </div>
    <div class='labelInfoUser'> nom :<div class='infoUser'>".$user->getNOM()."</div>
    </div>
    <div class='labelInfoUser'> prenom : <div class='infoUser'>".$user->getPRENOM()."</div>
    </div>
    <div class='labelInfoUser'> n°tel📱: <div class='infoUser'>".$user->getTEL()."</div>
    </div>
    <div class='labelInfoUser'> ville🗺: <div class='infoUser'>".$user->getVILLE()."</div>
    </div>
    <div class='labelInfoUser'> adresse🏡: <div class='infoUser'>".$user->getADRESSE()."</div>
    </div>
    <div class='labelInfoUser'>Supplément adresse: <div class='infoUser'>".$user->getSUPLEMENTADDR()."</div>
    </div>";
    //Vérification que l'utilisateur à un abonnement
    if($user->getCODEA()!=0)
    {
        $infoUser.="<div class='labelInfoUser'> Validité abonnemnt : <div class='infoUser'>[".$user->getDATEDEBABON()."]/[".$user->getDATEFINABON()."]</div></div>";
    }
    $infoUser.="<div class='labelInfoUser'>Montant à débiter:  <div class='infoUser'>".$user->getMONTANTADEBITER()." euro(s)</div></div>
    <div class='labelInfoUser'> Credit temps: <div class='infoUser'>".$user->getCREDITTEMPS()." euro(s)</div></div>";


    //Formulaire de modification 
    $formModif=new Formulaire("post","index.php","fModif","FModif");
	
	$formModif->ajouterComposantLigne($formModif->creerLabel('email', 'Email :'));
    $formModif->ajouterComposantLigne($formModif->creerInputTexte('emailParamModif', 'emailParamModif', '', 1, 'votre Email', 0));
    $formModif->ajouterComposantTab();

    

	$formModif->ajouterComposantLigne($formModif->creerLabelFor('numerovoie', 'N° et libellé de voie :'));
	$formModif->ajouterComposantLigne($formModif->creerInputTexte('numerovoie', 'numerovoie', '', 1, 'votre adresse', 0));
	$formModif->ajouterComposantTab();

	$formModif->ajouterComposantLigne($formModif->creerLabelFor('supplementAddr', 'Information complémentaire adresse :'));
    $formModif->ajouterComposantLigne($formModif->creerInputTexte('supplementAddr', 'supplementAddr', '', 1, 'Supplément adresse', 0));
    $formModif->ajouterComposantTab();

	$formModif->ajouterComposantLigne($formModif->creerLabelFor('ville', ' Ville :'));
    $formModif->ajouterComposantLigne($formModif->creerInputTexte('ville', 'ville', '', 1, 'votre ville', 0));
    $formModif->ajouterComposantTab();

	$formModif->ajouterComposantLigne($formModif->creerLabelFor('cdp', 'Code postal :'));
    $formModif->ajouterComposantLigne($formModif->creerInputTexte('cdp', 'cdp', '', 1, 'votre code postale', 0));
    $formModif->ajouterComposantTab();

	$formModif->ajouterComposantLigne($formModif->creerLabelFor('tel', 'N° télephone :'));
    $formModif->ajouterComposantLigne($formModif->creerInputTexte('tel', 'tel', '', 1, 'votre numéro téléphonique ', 0));
    $formModif->ajouterComposantTab();

    $formModif->ajouterComposantLigne($formModif->creerLabelFor("mdpModif",'Mot de passe: '));
    $formModif->ajouterComposantLigne($formModif->creerInputMdp('mdpModif', 'mdpModif', 1, 'Nouveaux mot de passe ', ''));
    $formModif->ajouterComposantTab();

	$formModif->ajouterComposantLigne($formModif->creerInputSubmit('modification',"modification","💾"));
    $formModif->ajouterComposantTab();

	$formModif->creerFormulaire();


    /*Formulaire pour  ajouter de l'argent dans le compte  */
    $formPayement=new Formulaire("post","index.php","fPayement","FPayement");
    $formPayement->ajouterComposantLigne($formPayement->creerLabelFor('sommePay', ' Somme de rechargement :'));
    $formPayement->ajouterComposantLigne($formPayement->creerInputTexte('sommePay', 'sommePay', '', 1, 'Somme ', 0));
    $formPayement->ajouterComposantTab();
    $formPayement->ajouterComposantLigne($formPayement->creerInputSubmit('modifierPay',"modifierPay","💾"));
    $formPayement->ajouterComposantTab();
    $formPayement->creerFormulaire();

    //Récupération de tout les types d'abonnement utiliser dans la base de données 

    $bdDonne=abonnementDAO::ChargementLibelleToutabonnements();
    $LibelleToutAbonnement=[];

    foreach($bdDonne as $donne)
    {
        array_push($LibelleToutAbonnement,$donne[0]);
    }


    //Formulaire pour choisir l'abonnement et changer 
    $formChoixAbonn=new Formulaire("post","index.php","fChoixAbonn","FChoixAbonn");
    $formChoixAbonn->ajouterComposantLigne($formChoixAbonn->creerLabelFor('selectAbonn', ' Selectionner votre nouvel abonnement :'));
    $formChoixAbonn->ajouterComposantLigne($formChoixAbonn->creerSelect("selectAbonn","selectAbonn",$LibelleToutAbonnement));
    $formChoixAbonn->ajouterComposantTab();
    $formChoixAbonn->ajouterComposantLigne($formChoixAbonn->creerInputSubmit('modifierAbon',"modifierAbon","💾"));
    $formChoixAbonn->ajouterComposantTab();
    $formChoixAbonn->creerFormulaire();
    require_once "vues/parametre.php";
?>