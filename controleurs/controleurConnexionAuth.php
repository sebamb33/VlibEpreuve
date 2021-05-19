<?php
//Création formulaire connexion 
$formulaireConnexion= new Formulaire("post","index.php","fconnexion","Fconnexion");

//En tête 
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Connexion'));
	$formulaireConnexion->ajouterComposantTab();
//Identifiant
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Identifiant :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('login', 'login', '', 1, 'code accès 6 Chiffres', ''));
	$formulaireConnexion->ajouterComposantTab();
//Mot de passe
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mot de Passe :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp',  1, 'code à 4 chiffres', ''));
	$formulaireConnexion->ajouterComposantTab();
//Bouton de connexion
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion-> creerInputSubmit('submitConnex', 'submitConnex', 'Se connecter'));
	$formulaireConnexion->ajouterComposantTab();
	$formulaireConnexion->creerFormulaire();



//Création formulaire inscription
	$formInscr=new Formulaire("post","index.php","finscription","Finscription");

	$formInscr->ajouterComposantLigne($formInscr->creerLabel('Inscription'));
	$formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabel("Nom :"));
	$formInscr->ajouterComposantLigne($formInscr->creerInputTexte('nomInsc','nomInsc','',1," votre nom  ",''));
	$formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabel("Prenom :"));
	$formInscr->ajouterComposantLigne($formInscr->creerInputTexte('prenomInsc','prenomInsc','',1,"votre Prenom ",''));
	$formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabel("Sexe :"));
	$formInscr->ajouterComposantLigne($formInscr->creerSelect("selectSexe","selectSexe",["Mr","Mme","Mlle"]));
	$formInscr->ajouterComposantTab();
	
	$formInscr->ajouterComposantLigne($formInscr->creerLabel('email', 'Email :'));
    $formInscr->ajouterComposantLigne($formInscr->creerInputTexte('email', 'email', '', 1, 'votre Email', 0));
    $formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabelFor('datenaissance', ' Date de naissance :'));
	$formInscr->ajouterComposantLigne($formInscr->creerInputTexte('datenaissance', 'datenaissance', '', 1, 'jj/mm/aaaa', 0));
	
	$formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabelFor('numerovoie', 'N° et libellé de voie :'));
	$formInscr->ajouterComposantLigne($formInscr->creerInputTexte('numerovoie', 'numerovoie', '', 1, 'votre adresse', 0));
	$formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabelFor('supplementAddr', 'Information complémentaire adresse :'));
    $formInscr->ajouterComposantLigne($formInscr->creerInputTexte('supplementAddr', 'supplementAddr', '', 1, 'Supplément adresse', 0));
    $formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabelFor('ville', ' Ville :'));
    $formInscr->ajouterComposantLigne($formInscr->creerInputTexte('ville', 'ville', '', 1, 'votre ville', 0));
    $formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabelFor('cdp', 'Code postal :'));
    $formInscr->ajouterComposantLigne($formInscr->creerInputTexte('cdp', 'cdp', '', 1, 'votre code postale', 0));
    $formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerLabelFor('tel', 'N° télephone :'));
    $formInscr->ajouterComposantLigne($formInscr->creerInputTexte('tel', 'tel', '', 1, 'votre numéro téléphonique ', 0));
    $formInscr->ajouterComposantTab();

	$formInscr->ajouterComposantLigne($formInscr->creerInputSubmit('inscription',"inscription","Inscription"));
    $formInscr->ajouterComposantTab();

	$formInscr->creerFormulaire();



include_once 'vues/ConnexionAuth.php';
?>