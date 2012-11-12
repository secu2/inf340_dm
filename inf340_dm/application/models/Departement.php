<?php

namespace models;



/**
 * Departement
 *
 * @Table(name="departement")
 * @Entity (repositoryClass="\models\repositories\DepartementRepository")
 */
class Departement
{
    /**
     * @var string $numero
     *
     * @Column(name="numero", type="string", length=3, nullable=false)
     * @Id
     * @GeneratedValue(strategy="NONE")
     */
    private $numero;

    /**
     * @var string $nom
     *
     * @Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;
    
    public function __construct($numero, $nom)
    {
    	$this->numero = $numero;
    	$this->nom = $nom;
    }
    
    public function getNumero()
    {
    	return $this->numero;
    }
    

    public function getNom()
    {
    	return $this->nom;
    }
    
}
