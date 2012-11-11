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
    private $departementNumero;

    /**
     * Constructor
     */
    public function __construct($nom, $description, $numero)
    {
        $this->nom = $nom;
    	$this->description = $description;
    	$this->departementNumero = $numero; 
    }
    
    public function __setDepartement($numero)
    {
    	$this->departementNumero = $numero;
    }
    
}
