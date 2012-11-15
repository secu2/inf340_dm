<?php

namespace models;


/**
 * Image
 *
 * @Table(name="image")
 * @Entity (repositoryClass="\models\repositories\ImageRepository")
 */
class Image
{
    /**
     * @var integer $url
     *
     * @Column(name="url", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $url;

    /**
     * @var string $description
     *
     * @Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var Station
     *
     * @ManyToOne(targetEntity="Station")
     * @JoinColumns({
     *   @JoinColumn(name="station_nom", referencedColumnName="nom", onDelete = "Cascade")
     * })
     */
    private $station_nom;

    public function __construct($description, $station_nom) {
    	$this->description = $description;
    	$this->station_nom = $station_nom;
    }
    
    /**
     * Permet de connaître l'url de l'image
     * @return string l'url de l'image
     */
    public function getURL(){
    	return $this->url;
    }
}


