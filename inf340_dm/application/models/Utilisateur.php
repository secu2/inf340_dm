<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $login
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=false)
     */
    private $password;

    /**
     * @var integer $level
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Station", inversedBy="utilisateur")
     * @ORM\JoinTable(name="commentaire",
     *   joinColumns={
     *     @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="station_nom", referencedColumnName="nom")
     *   }
     * )
     */
    private $stationNom;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stationNom = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
