<?php
require_once 'modele/DAO/param.php';
require_once 'modele/DAO/accesDonnes.php';


    class abonnementDAO{

        //Recherche le libelle via le codeA de l'utilisateur
        public static function libelleAbonnement(Utilisateur $user)
        {
            $codeA=$user->getCODEA();
            $sql="SELECT LIBELLETYPEABO FROM type_abonement WHERE CODETYPEABO = :codeabo";
            $req=DBConnex::getInstance()->prepare($sql);
            $req->bindParam(":codeabo",$codeA);
            $req->execute();
            return $req->fetch()[0];
        }
        //Recherche tout les types d'abonnement qui exsite 
        public static function ChargementLibelleToutabonnements()
        {
            $sql="SELECT LIBELLETYPEABO FROM type_abonement";
            $req=DBConnex::getInstance()->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }

        //Recherche le numéro de l'abonnement  grâce au libellé
        public static function ChargementCodeA($libelle)
        {
            $sql="SELECT CODETYPEABO FROM type_abonement WHERE LIBELLETYPEABO = :lib ";
            $req=DBConnex::getInstance()->prepare($sql);
            $req->bindParam(":lib",$libelle);
            $req->execute();
            return $req->fetch();
        }


    }?>