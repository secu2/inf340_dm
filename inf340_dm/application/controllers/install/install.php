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
		
		//D�partements
		$departement1 = new \models\Departement('38','Is�re');
		$departement2 = new \models\Departement('73','Savoie');
		$departement3 = new \models\Departement('74','Haute Savoie');
		$departement4 = new \models\Departement('01','Ain');
		$departement5 = new \models\Departement('02','Aisne');
		$departement6 = new \models\Departement('03','Allier');
		$departement7 = new \models\Departement('04','Alpes de Hautes-provence');
		$departement8 = new \models\Departement('05','Hautes-Alpes');
		$departement9 = new \models\Departement('06','Alpes maritimes');
		$departement10 = new \models\Departement('07','Ard�che');
		$departement11 = new \models\Departement('08','Ardennes');
		$departement12 = new \models\Departement('09','Ari�ge');
		$departement13 = new \models\Departement('10','Aube');
		$departement14 = new \models\Departement('11','Aude');
		$departement15 = new \models\Departement('12','Aveyron');
		$departement16 = new \models\Departement('13','Bouches du Rh�ne');
		$departement17 = new \models\Departement('14','Calvados');
		$departement18 = new \models\Departement('15','Cantal');
		$departement19 = new \models\Departement('16','Charente');
		$departement20 = new \models\Departement('17','Charente-Maritime');
		$departement21 = new \models\Departement('18','Cher');
		$departement22 = new \models\Departement('19','Corr�ze');
		$departement23 = new \models\Departement('2A','Corse-du-Sud');
		$departement23 = new \models\Departement('2B','Haute-Corse');
		$departement24 = new \models\Departement('21','Cote d or');
		$departement25 = new \models\Departement('22','C�te d armor');
		$departement26 = new \models\Departement('23','Creuse');
		$departement27 = new \models\Departement('24','Dordogne');
		$departement28 = new \models\Departement('25','Doubs');
		$departement29 = new \models\Departement('26','Dr�me');
		$departement30 = new \models\Departement('27','Eure');
		$departement31 = new \models\Departement('28','Eure et Loir');
		$departement32 = new \models\Departement('29','Finist�re');
		$departement33 = new \models\Departement('30','Gard');
		$departement34 = new \models\Departement('31','Haute-Garonne');
		$departement35 = new \models\Departement('32','Gers');
		$departement36 = new \models\Departement('33','Gironde');
		$departement37 = new \models\Departement('34','H�rault');
		$departement38 = new \models\Departement('35','Ille-et-Vilaine');
		$departement39 = new \models\Departement('36','Indre');
		$departement40 = new \models\Departement('37','Indre et Loire');
		$departement41 = new \models\Departement('39','Jura');
		$departement42 = new \models\Departement('40','Landes');
		$departement43 = new \models\Departement('41','Loir-et-Cher');
		$departement44 = new \models\Departement('42','Loire');
		$departement45 = new \models\Departement('43','Haute-Loire');
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
		$em->persist($departement17);
		$em->persist($departement18);
		$em->persist($departement19);
		$em->persist($departement20);
		$em->persist($departement21);
		$em->persist($departement22);
		$em->persist($departement23);
		$em->persist($departement24);
		$em->persist($departement25);
		$em->persist($departement26);
		$em->persist($departement27);
		$em->persist($departement28);
		$em->persist($departement29);
		$em->persist($departement30);
		$em->persist($departement31);
		$em->persist($departement32);
		$em->persist($departement33);
		$em->persist($departement34);
		$em->persist($departement35);
		$em->persist($departement36);
		$em->persist($departement37);
		$em->persist($departement38);
		$em->persist($departement39);
		$em->persist($departement40);
		$em->persist($departement41);
		$em->persist($departement42);
		$em->persist($departement43);
		$em->persist($departement44);
		$em->persist($departement45);
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
