<?php




/**
 * Utilisateur
 *
 * @Table(name="utilisateur")
 * @Entity
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany(targetEntity="Station", inversedBy="utilisateur")
     * @JoinTable(name="commentaire",
     *   joinColumns={
     *     @JoinColumn(name="utilisateur_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="station_nom", referencedColumnName="nom")
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
