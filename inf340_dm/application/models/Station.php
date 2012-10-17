<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Station
 *
 * @ORM\Table(name="station")
 * @ORM\Entity
 */
class Station
{
    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nom;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="stationNom")
     */
    private $utilisateur;

    /**
     * @var Departement
     *
     * @ORM\ManyToOne(targetEntity="Departement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departement_numero", referencedColumnName="numero")
     * })
     */
    private $departementNumero;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
