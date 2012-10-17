<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer $url
     *
     * @ORM\Column(name="url", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $url;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="station_nom", referencedColumnName="nom")
     * })
     */
    private $stationNom;


}
