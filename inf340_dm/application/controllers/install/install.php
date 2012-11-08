<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of install
 *
 * @author jub
 */
use models\Utilisateur;
class Install extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('doctrine');
		$this->load->helper('file');

	}

	function index() {
		//recupération du gestionnaire d'entitées
		$em = $this->doctrine->em;

		//suppression et creation des tables de la base
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		$tool->dropDatabase();
	  
		$classes = array(
		$em->getClassMetadata('\models\Departement'),
				$em->getClassMetadata('\models\Station'),
				$em->getClassMetadata('\models\Utilisateur'),
				$em->getClassMetadata('\models\Image'),
				$em->getClassMetadata('\models\Commentaire')
		
		);
		$tool->createSchema($classes);
		
		
	}


}

?>
