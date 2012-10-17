<?php
//ne fais pas tout manque l'espace de nommage ...
//perte de quantite
class createModelFromDB extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('doctrine');
    }

    function index() {
        $em = $this->doctrine->em;
        $em->getConfiguration()->setMetadataDriverImpl(
                new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                        $em->getConnection()->getSchemaManager()
                )
        );

        $cmf = new Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($em);
        $metadata = $cmf->getAllMetadata();
        
          $cme = new \Doctrine\ORM\Tools\Export\ClassMetadataExporter();

          $exporter = $cme->getExporter('annotation', 'application/models');
          $exporter->setMetadata($metadata);
          $etg = new \Doctrine\ORM\Tools\EntityGenerator;
          $exporter->setEntityGenerator($etg);
          $exporter->export();
         
    }

}

?>
