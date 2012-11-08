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
		$em->getClassMetadata('\models\A'),
		$em->getClassMetadata('\models\B'),
		$em->getClassMetadata('\models\R')
		);
		$tool->createSchema($classes);

		//---------------------------------------------------------------------------------
		//peuplement de la base 
	/*
		$a1 = new models\A();
		$a2 = new models\A();
		$b1 = new models\B();
		$b2 = new models\B();
		
		$em->persist($a1);
		$em->persist($a2);
		$em->persist($b1);
		$em->persist($b2);
		$em->flush(); //imperatif avant d'utiliser A_has_B;
		
		$a1->add($b1, "parameter1");
		$a1->add($b2, "parameter2");
		
		$em->persist($a1);
		$em->flush();
		
		foreach ($a1->getRs() as $v)
			var_dump($v->getB());
		//rem : $b1->getRs() est null mais la table A_has_B a bien l'info
		
		$b3 = new models\B();
		$em->persist($b3);
		$em->flush();
		
		$b3->add($a1, "parameter1");
		$b3->add($a2, "parameter2");
		
		$em->persist($b3);
		$em->flush();
		
		foreach ($b3->getRs() as $v)
			var_dump($v->getA());
		
		$em->remove($b3);
		$em->flush();
		
		foreach ($b3->getRs() as $v)
			var_dump($v->getA());
		//rem $b3->getRs n'est pas null mais 
		*/
		$em = $this->doctrine->em;
		$repositoryA = $em->getRepository('models\A');
		$a1 = $repositoryA->create();
		$a2 = $repositoryA->create();
		
		$repositoryB = $em->getRepository('models\B');
		$b1 = $repositoryB->create();
		$b2 = $repositoryB->create();
		
		$repositoryA->add($a1,$b1,"parameter1");
		$repositoryA->add($a1,$b2,"parameter2");
		
		
		var_dump($repositoryA->getBsByA($a1));
		
		$b3=$repositoryB->create();
		$repositoryB->add($a1,$b3,"parameter1");
		$repositoryB->add($a2,$b3,"parameter2");
		
		var_dump($repositoryB->getAsByB($b3));

		$repositoryR = $em->getRepository('models\R');
		var_dump($repositoryR->getParamterByAB($a1,$b3));
	}


}

?>
