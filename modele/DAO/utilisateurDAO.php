<?php
require_once 'modele/DAO/param.php';
require_once 'modele/DAO/accesDonnes.php';


    class UtilisateurDao{
        
    //Fonction qui va servir à verfier le mail avant de crée un utilisateur
    public static function VerificationUtilisateurMail(Utilisateur $user)
    {
        $mailSaisi=$user->getMAIL();
        $sql="SELECT IDUTIL FROM utilisateur WHERE MAIL =:mail";
        $req=DBCONNEX::getInstance()->prepare($sql);
        $req->bindParam(":mail",$mailSaisi);
        $req->execute();
        return $req->fetchAll();

    }
    //Va verifier à chaque inscription si le login est bien unique 
    public static function VerificationLoginDisponible($log)
    {
        $sql="SELECT IDUTIL FROM utilisateur WHERE LOGIN =:logi";
        $req=DBConnex::getInstance()->prepare($sql);
        $req->bindParam(":logi",$log);
        $req->execute();
        $req=$req->fetchAll();

        if(count($req)==0)
        {
            return TRUE;
        }
        return FALSE;
    }

    //Inscription de l'utilisateur à utilisé une fois  le mdp et le login générer
    public static function  InscriptionUtilisateur(Utilisateur $user)
    {
        //Code type de 1 car abonné  CODEA car pas d'abonnement encore et initialisation à 0 du crédit temps et du montant à débiter 
        $sql="INSERT INTO utilisateur  (`LOGIN`, `MDP`, `CODETYPE`,`CODEA`, `NOM`, `PRENOM`, `SEXE`, `DATENAISS`, `ADRESSE`, `SUPLEMENTADDR`, `TEL`, `VILLE`, `CP`, `CREDITTEMPS`, `MONTANTADEBITER`, `MAIL`)VALUES (:logi,:mdp,'1','0',:nom,:pren,:sexe,:dateNaiss,:addr,:supaddr,:tel,:vil,:cp,'0.0','0.0',:mail)";
        $req=DBConnex::getInstance()->prepare($sql);
        //Créer variable dans les version récentes de php sinon warning
        $log=$user->getLOGIN();
        $mdp=md5($user->getMDP());
        $nom=$user->getNom();
        $pren=$user->getPRENOM();
        $sexe=$user->getSexe();
        $dateNaiss=strval($user->getDATENAISS());
        $dateNaiss=preg_split("[/]",$dateNaiss);//Changement de l'ordre de la date pour éviter souci dans la bdd
        //Eviter les erreur de traitement sur le tableaux
        if(count($dateNaiss)!=3)
        {
            
            return 0;
        }
        $dateNaissanceAjust=$dateNaiss[2]."-".$dateNaiss[1]."-".$dateNaiss[0];
        $addr=$user->getADRESSE();
        $suppAddr=$user->getSUPLEMENTADDR();
        $tel=$user->getTEL();
        $vil=$user->getVILLE();
        $cp=$user->getCP();
        $mail=$user->getMAIL();

        $req->bindParam(":logi",$log);
        $req->bindParam(":mdp",$mdp);
        $req->bindParam(":nom",$nom);
        $req->bindParam(":pren",$pren);
        $req->bindParam(":sexe",$sexe);
        $req->bindParam(":dateNaiss",$dateNaissanceAjust);
        $req->bindParam(":addr",$addr);
        $req->bindParam(":supaddr",$suppAddr);
        $req->bindParam(":tel",$tel);
        $req->bindParam(":vil",$vil);
        $req->bindParam(":cp",$cp);
        $req->bindParam(":mail",$mail);
        return $req->execute();
        

    }

    public static function connexionUtilisateur($log,$mdp)
    {
        //Creation des variables pour éviter warning
        $l=$log;
        $m=md5($mdp);
        $sql="SELECT * FROM utilisateur WHERE LOGIN=:logi and MDP=:mdp";
        $req=DBConnex::getInstance()->prepare($sql);
        $req->bindParam(":logi",$l);
        $req->bindParam(":mdp",$m);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifAbonnement($id,$codeA)
    {
        $sql ="UPDATE utilisateur SET CODEA = :code WHERE IDUTIL= :idutil";
        $req=DBConnex::getInstance()->prepare($sql);
        $req->bindParam(":code",$codeA);
        $req->bindParam(":idutil",$id);
        return $req->execute();
    }

        //Modiifie la date du début de l'abonnement et de la fin de l'abonnement
        public static function  ChangeDateAbon($idUtil,$codeA)
        {
            //Probleme de formatage de la date
            //$dateFi=date('Y-m-d',strtotime($dateFin)); ne fonctionne pas donc obliger de faire
            //des conditions ici
            $dateDeb=date("Y-m-d");

            if($codeA==1)//Abonnement un jour
            {
                $dateFin=date("Y-m-d",strtotime($dateDeb.'1 days'));
            }elseif($codeA==2)//abonnement 7 jours
            {
                $dateFin=date("Y-m-d",strtotime($dateDeb.'1 week'));
            }else // abonnement 1 ans
            {
                $dateFin=date("Y-m-d",strtotime($dateDeb.'+12 month'));
            }
            $sql ="UPDATE utilisateur set  DATEDEBABON =:dateDeb, DATEFINABON= :dateFin where IDUTIL=:idUtil";
            $req=DBCONNEX::getInstance()->prepare($sql);
            $req->bindParam(":dateDeb",$dateDeb);
            $req->bindParam(":dateFin",$dateFin );
            $req->bindParam(":idUtil",$idUtil);
            $req->execute();
        }

        //Modifie la somme de l'utilisateur dans le compte
    public static function RechargeSolde($id,$somme)
    {
        $sql="UPDATE  utilisateur set CREDITTEMPS= :somme WHERE IDUTIL=:id";
        $req=DBConnex::getInstance()->prepare($sql);
        $req->bindParam(":somme",$somme);
        $req->bindParam(":id",$id);
        $req->execute();

    }
    public static function ModificationInfoUtilisateur($id,$email,$addr,$supAddr,$ville,$cdp,$tel,$mdp)
    {
        $sql="update utilisateur 
            set MAIL=:mail,CP=:cp,VILLE=:vil,TEL=:tel,SUPLEMENTADDR=:supAddr,ADRESSE=:addr,MDP=md5(:mdp) 
            WHERE IDUTIL=:id";
        $req=DBConnex::getInstance()->prepare($sql);
        $req->bindParam(":mail",$email);
        $req->bindParam(":cp",$cdp);
        $req->bindParam(":vil",$ville);
        $req->bindParam(":tel",$tel);
        $req->bindParam(":supAddr",$supAddr);
        $req->bindParam(":addr",$addr);
        $req->bindParam(":mdp",$mdp);
        $req->bindParam(":id",$id);
        return $req->execute();
    }
}
?>