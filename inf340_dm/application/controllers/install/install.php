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
		$station1 = new \models\Station('Autrans', 'description', $departement1);
		$station2 = new \models\Station('Courchevel', 'description', $departement2);
		$station3 = new \models\Station('Chamonix', 'description', $departement3);
		$em->persist($station1);
		$em->persist($station2);
		$em->persist($station3);
		$em->flush();
		
		//Utilisateurs
		$user1 = new Utilisateur('normal', 'normal', '0');
		$user2 = new Utilisateur('modo', 'modo', '1');
		$user3 = new Utilisateur('admin', 'admin', '2');
		$em->persist($user1);
		$em->persist($user2);
		$em->persist($user3);
		$em->flush();
		
		//Commentatires
		$comment1 = new models\Commentaire($user1,$station1,'Commentaire simple');
		$comment2 = new models\Commentaire($user1,$station2,'Commentaire simple');
		$comment3 = new models\Commentaire($user1,$station3,'Commentaire simple');
		$comment4 = new models\Commentaire($user2,$station1,'Commentaire du modo');
		$comment5 = new models\Commentaire($user2,$station2,'Commentaire du modo');
		$comment6 = new models\Commentaire($user2,$station3,'Commentaire du modo');
		$comment7 = new models\Commentaire($user3,$station1,'Commentaire de l admin');
		$comment8 = new models\Commentaire($user3,$station2,'Commentaire de l admin');
		$comment9 = new models\Commentaire($user3,$station3,'Commentaire de l admin');
		$em->persist($comment1);
		$em->persist($comment2);
		$em->persist($comment3);
		$em->persist($comment4);
		$em->persist($comment5);
		$em->persist($comment6);
		$em->persist($comment7);
		$em->persist($comment8);
		$em->persist($comment9);
		$em->flush();
		
	}


}

?>
