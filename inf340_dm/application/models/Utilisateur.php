<?php


namespace models;

/**
 * Utilisateur
 *
 * @Table(name="utilisateur")
 * @Entity (repositoryClass="\models\repositories\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $login
     *
     * @Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;

    /**
     * @var string $password
     *
     * @Column(name="password", type="string", length=45, nullable=false)
     */
    private $password;

    /**
     * @var integer $level
     *
     * @Column(name="level", type="integer", nullable=false)
     */
    private $level;
	
	
    /**
     * Constructor
     */
    public function __construct($login,$password, $level, $stationNom){
    
    	$this->login = $login;
    	$this->level=$level;
    	$this->password=$this->encryptPassword($password);
    	//$this->stationNom=new ArrayCollection;
    }
    
    /**
     * Permet de connaître le login
     * @return string le login
     */
    public function getLogin() {
    	return $this->login;
    }
    
    /**
     * renvoie le mot de passe de l'utilisateur chiffré
     * @return string le mot de passe chiffré
     */
    public function getEncryptedPassword() {
    	return $this->password;
    }
    
    /**
     * Permet de connaïtre le niveau de l'utilisateur
     * @return number le niveau
     */
    public function getLevel() {
    	return $this->level;
    }
   
    
    /**
     * Permet de modifier le login
     * @param unknown_type $login le nouveau login
     */
    public function setLogin($login){
    	$this->login=$login;
    }
    
    /**
     * Permet de modifier le mot de passe
     * @param unknown_type $password le nouveau mot de passe
     */
    public function setPassword($password) {
    	$this->password = $this->encryptPassword($password);
    }
    
    /**
     * Permet de modifier le niveau de l'utilisateur
     * @param unknown_type $level le niveau de l'utilisateur
     */
    public function setLevel($level) {
    	$this->level = $level;
    }
    
    /**
     * Renvoie le mot de passe chiffré
     * @param unknown_type $password le mot de passe à chiffrer
     * @return unknown le mot de passe chiffré
     */
    private function encryptPassword($password){
    	$CI = & get_instance();
    	$CI->load->library('encrypt');
    	$encryped= $CI->encrypt->sha1($password);
    	return $encryped;
    }
    
    /**
     * Permet de savoir si le mot de passe passé en paramètre est clui de l'utilisateur
     * @param unknown_type $password le mot à vérifier
     * @return boolean true si les mots de passes correspondent et false sinon
     */
    public function authenticate($password){
    	return $this->password===$this->encryptPassword($password);
    }
    
    /**
     * Renvoie l'identifiant de l'utilisateur courant
     * @return string l'identidifiant de l'utilisateur courant
     */
    public function getId(){
    	return $this->id;
    }
    
}
