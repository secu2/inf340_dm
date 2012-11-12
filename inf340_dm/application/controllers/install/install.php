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
		//recupÃ©ration du gestionnaire d'entitÃ©es
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
		
		//peuplement de la base
		
		//Départements
		$departement1 = new \models\Departement('38','Isère');
		$departement2 = new \models\Departement('73','Savoie');
		$departement3 = new \models\Departement('74','Haute Savoie');
		$em->persist($departement1);
		$em->persist($departement2);
		$em->persist($departement3);
		$em->flush();
		
		//Stations
		/*$station1 = new \models\Station('Autrans', 'description', '38');
		$station2 = new \models\Station('Courchevel', 'description', '73');
		$station3 = new \models\Station('Chamonix', 'description', '74');
		$em->persist($station1);
		$em->persist($station2);
		$em->persist($station3);
		$em->flush();*/
		
		//Utilisateurs
		$user1 = new Utilisateur('normal', 'normal', '0');
		$user2 = new Utilisateur('modo', 'modo', '1');
		$user3 = new Utilisateur('admin', 'admin', '2');
		$em->persist($user1);
		$em->persist($user2);
		$em->persist($user3);
		$em->flush();
		
		//Commentatires
		/*$comment1 = new models\Commentaire('1','Autrans','Commentaire exemple');
		$em->persist($comment1);
		$em->flush();*/
		
	}


}

?>
