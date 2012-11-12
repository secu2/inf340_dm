<?php


namespace models;

/**
 * Station
 *
 * @Table(name="station")
 * @Entity (repositoryClass="\models\repositories\StationRepository")
 */
class Station
{
    /**
     * @var string $nom
     *
     * @Column(name="nom", type="string", length=100, nullable=false)
     * @Id
     * @GeneratedValue(strategy="NONE")
     */
    private $nom;

    /**
     * @var string $description
     *
     * @Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Departement 
     *
     * @ManyToOne(targetEntity="Departement")
     * @JoinColumns({
     *   @JoinColumn(name="departement_numero", referencedColumnName="numero", nullable=false)
     * })
     */
    //on passe un objet département en paramètre
    private $departement;

    /**
     * Constructor
     */
    public function __construct($nom, $description, $departement)
    {
        $this->nom = $nom;
    	$this->description = $description;
    	$this->departement = $departement; 
    }
    
    public function getNom()
    {
    	return $this->nom;
    }
    
    public function getDescription()
    {
    	return $this->description;
    }
    
    public function getDepartement()
    {
    	return $this->departement;
    }
    
    public function __setDepartement($departement)
    {
    	$this->departement = $departement;
    }
    
}
