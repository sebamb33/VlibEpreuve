<?php
class Utilisateur
{
    //Toute les variables en majusucle car tout est en majuscule dans la base de données
    private $IDUTIL;
    private $LOGIN;
    private $MDP;
    private $MAIL;
    private $CODETYPE;
    private $CODEA;
    private $NOM;
    private $PRENOM;
    private $SEXE;
    private $DATENAISS;
    private $ADRESSE;
    private $SUPLEMENTADDR;
    private $TEL;
    private $VILLE;
    private $CP;
	private $DATEDEBABON;
	private $DATEFINABON;
	private $CREDITTEMPS;
	private $MONTANTADEBITER;
	private $VELOLOUER;

    public function __construct($nom=null,$prenom=null,$mail=null,$sexe=null,$date=null,$adresse=null,$adresseSup=null,$tel=null,$vil=null,$cp=null)
    {
        $this->NOM=$nom;
        $this->PRENOM=$prenom;
        $this->MAIL =$mail;        
        $this->SEXE=$sexe;
        $this->DATENAISS =$date;
        $this->ADRESSE =$adresse;
        $this->SUPLEMENTADDR=$adresseSup;
        $this->TEL =$tel;
        $this->CP=$cp;
        $this->VILLE=$vil;
    }
	public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


	public function getIDUTIL(){
		return $this->IDUTIL;
	}

	public function setIDUTIL($IDUTIL){
		$this->IDUTIL = $IDUTIL;
	}

	public function getLOGIN(){
		return $this->LOGIN;
	}

	public function setLOGIN($LOGIN){
		$this->LOGIN = $LOGIN;
	}

	public function getMDP(){
		return $this->MDP;
	}

	public function setMDP($MDP){
		$this->MDP = $MDP;
	}

	public function getMAIL(){
		return $this->MAIL;
	}

	public function setMAIL($MAIL){
		$this->MAIL = $MAIL;
	}

	public function getCODETYPE(){
		return $this->CODETYPE;
	}

	public function setCODETYPE($CODETYPE){
		$this->CODETYPE = $CODETYPE;
	}

	public function getCODEA(){
		return $this->CODEA;
	}

	public function setCODEA($CODEA){
		$this->CODEA = $CODEA;
	}

	public function getNOM(){
		return $this->NOM;
	}

	public function setNOM($NOM){
		$this->NOM = $NOM;
	}

	public function getPRENOM(){
		return $this->PRENOM;
	}

	public function setPRENOM($PRENOM){
		$this->PRENOM = $PRENOM;
	}

	public function getSEXE(){
		return $this->SEXE;
	}

	public function setSEXE($SEXE){
		$this->SEXE = $SEXE;
	}

	public function getDATENAISS(){
		return $this->DATENAISS;
	}

	public function setDATENAISS($DATENAISS){
		$this->DATENAISS = $DATENAISS;
	}

	public function getADRESSE(){
		return $this->ADRESSE;
	}

	public function setADRESSE($ADRESSE){
		$this->ADRESSE = $ADRESSE;
	}

	public function getSUPLEMENTADDR(){
		return $this->SUPLEMENTADDR;
	}

	public function setSUPLEMENTADDR($SUPLEMENTADDR){
		$this->SUPLEMENTADDR = $SUPLEMENTADDR;
	}

	public function getTEL(){
		return $this->TEL;
	}

	public function setTEL($TEL){
		$this->TEL = $TEL;
	}

	public function getVILLE(){
		return $this->VILLE;
	}

	public function setVILLE($VILLE){
		$this->VILLE = $VILLE;
	}

	public function getCP(){
		return $this->CP;
	}

	public function setCP($CP){
		$this->CP = $CP;
	}

	public function getDATEDEBABON(){
		return $this->DATEDEBABON;
	}

	public function setDATEDEBABON($DATEDEBABON){
		$this->DATEDEBABON = $DATEDEBABON;
	}

	public function getDATEFINABON(){
		return $this->DATEFINABON;
	}

	public function setDATEFINABON($DATEFINABON){
		$this->DATEFINABON = $DATEFINABON;
	}

	public function getCREDITTEMPS(){
		return $this->CREDITTEMPS;
	}

	public function setCREDITTEMPS($CREDITTEMPS){
		$this->CREDITTEMPS = $CREDITTEMPS;
	}

	public function getMONTANTADEBITER(){
		return $this->MONTANTADEBITER;
	}

	public function setMONTANTADEBITER($MONTANTADEBITER){
		$this->MONTANTADEBITER = $MONTANTADEBITER;
	}

	public function getVELOLOUER(){
		return $this->VELOLOUER;
	}

	public function setVELOLOUER($VELOLOUER){
		$this->VELOLOUER = $VELOLOUER;
	}
	public function genererLogin()
	{
		
		//Je regarde dans la base de donnée si le  numéro accés 6 chiffres n'est pas déja utiliser
		do
		{
			$logGener=random_int(0,999999);
		}while(UtilisateurDao::VerificationLoginDisponible($logGener)==FALSE);
		$this->LOGIN=$logGener;
		
	
	}
	public function genererMDP()
	{
		$this->MDP=random_int(0,9999);
	}

	public function calculFinance()
	{
		//Calcul l'argent que l'utilisateur dois 
		return ($this->CREDITTEMPS -$this->MONTANTADEBITER);
	}
	//Va set la date du début de l'abonnement et de la fin de l'abonnement en fonction de l'abonnement choisis
	public function calculDate($codeA)
	{
		$this->DATEDEBABON=date('d.m.y');

			if($codeA==1){ //24h 
				
				$this->DATEFINABON= date('d.m.y', strtotime($this->DATEDEBABON. ' + 1 days'));
			}
			else if($codeA==2){//7jours

                $this->DATEFINABON= date('d.m.y', strtotime($this->DATEDEBABON. ' + 1 week'));
			}else
			{

			}
		
	}
	// Va modifier le format date pour l'insertion dans la base de données 
}
?>