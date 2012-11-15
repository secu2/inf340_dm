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
		
		//peuplement de la base
		
		//Départements
		$departement1 = new \models\Departement('03', 'Allier');
		$departement2 = new \models\Departement('04', 'Alpes de Haute Provence');
		$departement3 = new \models\Departement('05', 'Hautes Alpes');
		$departement4 = new \models\Departement('06', 'Alpes Maritimes');
		$departement5 = new \models\Departement('15', 'Cantal');
		$departement6 = new \models\Departement('26', 'Drôme');
		$departement7 = new \models\Departement('38','Isère');
		$departement8 = new \models\Departement('39', 'Jura');
		$departement9 = new \models\Departement('43', 'Haute-Loire');
		$departement10 = new \models\Departement('63', 'Puy-De-Dôme');
		$departement11 = new \models\Departement('64', 'Pyrénées Atlantiques');
		$departement12 = new \models\Departement('65', 'Hautes Pyrénées');
		$departement13 = new \models\Departement('66', 'Pyrénées Orientales');
		$departement14 = new \models\Departement('73', 'Savoie');
		$departement15 = new \models\Departement('74', 'Haute Savoie');
		$departement16 = new \models\Departement('88', 'Vosges');
		
		$em->persist($departement1);
		$em->persist($departement2);
		$em->persist($departement3);
		$em->persist($departement4);
		$em->persist($departement5);
		$em->persist($departement6);
		$em->persist($departement7);
		$em->persist($departement8);
		$em->persist($departement9);
		$em->persist($departement10);
		$em->persist($departement11);
		$em->persist($departement12);
		$em->persist($departement13);
		$em->persist($departement14);
		$em->persist($departement15);
		$em->persist($departement16);
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
		$comment1 = new models\Commentaire($user1,$station1,'Commentaire simple', 2);
		$comment2 = new models\Commentaire($user1,$station2,'Commentaire simple', 3);
		$comment3 = new models\Commentaire($user1,$station3,'Commentaire simple', 4);
		$comment4 = new models\Commentaire($user2,$station1,'Commentaire du modo', 2);
		$comment5 = new models\Commentaire($user2,$station2,'Commentaire du modo', 3);
		$comment6 = new models\Commentaire($user2,$station3,'Commentaire du modo', 4);
		$comment7 = new models\Commentaire($user3,$station1,'Commentaire de l admin', 2);
		$comment8 = new models\Commentaire($user3,$station2,'Commentaire de l admin', 3);
		$comment9 = new models\Commentaire($user3,$station3,'Commentaire de l admin', 4);
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
