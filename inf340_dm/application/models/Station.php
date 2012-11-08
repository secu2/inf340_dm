<?php


namespace models;

/**
 * Station
 *
 * @Table(name="station")
 * @Entity
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany(targetEntity="Utilisateur", mappedBy="stationNom")
     */
    private $utilisateur;

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
    public function __construct()
    {
        $this->utilisateur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
