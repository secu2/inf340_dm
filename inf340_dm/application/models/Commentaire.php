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
     *@Column(name="texte", type="string", length=100)
     *
     */
    private $texte;
    
    
    
    public function __construct($id, $nom, $texte){
    	$this->id = $id;
    	$this->nom = $nom;	
    	$this->texte = $texte;
    }
    
    public function getTexte(){
    	return $this->texte;
    }
    
    public function setTexte($texte){
    	$this->texte = $texte;
    }
    
    public function getId(){
    	return $this->id;
    }
    public function getNom(){
    	return $this->nom;
    }
}
