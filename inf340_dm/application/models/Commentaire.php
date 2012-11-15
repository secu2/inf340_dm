<?php



namespace models;

/**
 * Commentaire
 *
 *@Table(name="Commentaire")
 *@Entity (repositoryClass="\models\repositories\CommentaireRepository")
 */
class Commentaire
{
    /**
     * 
     *
     *@Id
     *@ManyToOne(targetEntity="Utilisateur")
     * @JoinColumns({
     *   @JoinColumn(name="Utilisateur_id", referencedColumnName="id", onDelete="Cascade")
     * })
     */
	//on passe un objet utilisateur en paramètre
    private $utilisateur;

    /**
     * 
     *@Id
     *@ManyToOne(targetEntity="Station")
     * @JoinColumns({
     *   @JoinColumn(name="Station_nom", referencedColumnName="nom", onDelete="Cascade")
     * })
     */
    //on passe un objet station en paramètre
    private $station;
    
    /**
     * @var string $parameter
     *
     *@Column(name="data", type="string", length=150)
     *
     */
    private $data;
    
    /**
     * @var integer $parameter
     *
     *@Column(name="note", type="integer", length=2)
     *
     */
    private $note;
    
    
    
    public function __construct($utilisateur, $station, $data, $note){
    	$this->utilisateur = $utilisateur;
    	$this->station = $station;	
    	$this->data = $data;
    	$this->note = $note;
    }
    
    public function getData(){
    	return $this->data;
    }
    
    public function setData($data){
    	$this->data = $data;
    }
    
    public function getNote(){
    	return $this->note;
    }
    
    public function setNote($note){
    	$this->note = $note;
    }
    
    public function getUtilisateur(){
    	return $this->utilisateur;
    }
    public function getStation(){
    	return $this->station;
    }
}
