<?php



namespace models;

/**
 * Utilisateur
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
    private $id;

    /**
     * 
     *@Id
     *@ManyToOne(targetEntity="Station")
     * @JoinColumns({
     *   @JoinColumn(name="Station_nom", referencedColumnName="nom", onDelete="Cascade")
     * })
     */
    private $nom;
    
    /**
     * @var string $parameter
     *
     *@Column(name="data", type="string", length=100)
     *
     */
    private $data;
    
    
    
    public function __construct($id, $nom, $data){
    	$this->id = $id;
    	$this->nom = $nom;	
    	$this->data = $data;
    }
    
    public function getData(){
    	return $this->data;
    }
    
    public function setData($data){
    	$this->data = $data;
    }
    
    public function getId(){
    	return $this->id;
    }
    public function getNom(){
    	return $this->nom;
    }
}
