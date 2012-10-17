<?php

namespace models;



/**
 * Departement
 *
 * @Table(name="departement")
 * @Entity
 */
class Departement
{
    /**
     * @var string $numero
     *
     * @Column(name="numero", type="string", length=3, nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $numero;

    /**
     * @var string $nom
     *
     * @Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;


}
