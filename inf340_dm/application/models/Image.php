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
    private $stationNom;


}
