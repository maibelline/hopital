<?php
require_once(dirname(__FILE__).'/../utils/database.php');
//prends pr modele la table
class Patient{
    private int $_id;
    private string $_lastname;  // créer les propriétes/attributs(noms des colonnes)
    private string $_firstname; // private car pas d'héritage
    private string $_birthdate; // _ car ils sont privés
    private string $_phone; //string car commence par un 0 ou par un + o -
    private string $_mail;
    private object $_pdo; //cet objet on va l'hydater au moment du new patient apres connecter à la base (?)


// méhode magique recoit apparamétre d'entree ms ne retournera rien
//appeler auto lors de l'intenciation qd ya un new patient
//intenciation de la classe pour hydrater  notre objet
//hydrater -> c'est affecter des valeurs aux attributs 
//id en auto incrément pas besoin de renseigner l'id// pas besoin de le mettre

// commentaire clic sur mot puis cntrl entree

    /**
     * méthode magique permettant d'hydrater mon objet
     *
     * @param string $lastname
     * @param string $firstname
     * @param string $birthdate
     * @param string $phone
     * @param string $mail
     */
    public function __construct(string $lastname,string $firstname,string $birthdate,string $phone,string $mail){// utilise le setter paramétre d'entree
    $this-> setLastname($lastname);// hydrate notre objet
    $this-> setFirstname($firstname); //affecte $firstname à l'attriburt fisrtname
    $this-> setBirthdate($birthdate);
    $this-> setPhone($phone);
    $this-> setMail($mail);
    $this-> _pdo=dbConnect();// car fait un return ds database
    }


    //GETTER   permet de récupérer la donnée
    // méthode de visibilité publique "public" pour accéder depuis l'extérieur de la classe
    // :int = retourne un entier
    // $this ds la classe en cours * $id fait référence à l'attribut déclarer en haut
    public function getId():int {
        return $this->_id;
    }
    public function getLastname():string {
        return $this->_lastname;
    }
    public function getFirstname():string{
        return $this->_firstname;
    }
    public function getBirthdate():string{
        return $this->_birthdate;
    }
    public function getPhone():string{
        return $this->_phone;
    }
    public function getMail():string {
        return $this->_mail;
    }


    //SETTER   permet d'hydrate l'attributs (string $lastame)
    // info qu(on va récupérer du formulaire et sera stocker ds la variables * lastaname qui n'est pas l'attribut)
    public function setId(int $id ):void{
        $this ->_id=$id;
        //ds classe en cours on affecte la valeur à l'attribut
    }
    public function setLastname(string $lastname): void {
        $this->_lastname= $lastname;
    }
    public function setFirstname(string $firstname):void {
        $this->_firstname= $firstname;
    }
    public function setBirthdate(string $birthdate):void{
        $this->_birthdate=$birthdate;
    }
    public function setPhone(string $phone):void{
        $this->_phone=$phone;
    }
    public function setMail(string $mail): void {
        $this->_mail=$mail;
    }
// void car ca retourne rien
//$this= classe ds laquelle tu es.... dans la classe en cours

// methode pr faire appel a l'ext de la classe pour inserer les données
    public function add(){
       //insérer une requetes sql        
        $sql="  INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) 
                VALUES (:lastname,:firstname,:birthdate,:phone,:mail)";
                $sth=$this->_pdo->prepare($sql);//->query va exécuter la requete // nous on veux réparer la requéte en vue de lui affecter des valeurs derrrieres
                $sth=$this->_pdo->prepare($sql);
                $sth-> binValue(':lastname',$this->getLastname(),PDO::PARAM_STR); // méthode pdo statement 
                //binvalue=
                //methode pdo statment
         //methode query qui retourne un objet de type pdo statment =appeler $sth (qui permet d'accéder à des methodes pdo statment)
         //:lastname= marqueur nomminatif avec ces marqueurs = on prepare,on binValue et on execute
                $sth-> binValue(':firstname',$this->getFirstname(),PDO::PARAM_STR);
                $sth-> binValue(':birthdate',$this->getBirthdate(),PDO::PARAM_STR);
                $sth-> binValue(':phone',$this->getPhone(),PDO::PARAM_STR);
                $sth-> binValue(':mail',$this->getMail(),PDO::PARAM_STR);//shift alt fléche bas pr dupliquer

                if($sth->execute()){//pas besoin de paramétre; requete sera exécuter à ce moment là
                return true;
                } else {
                return false;
                }
                





            

        

    }
}





