<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le dépôt utilisateur
 * @author jub
 *
 */
class ARepository extends \Doctrine\ORM\EntityRepository {

	public function create(){
		$a = new \models\A();
		$this->getEntityManager()->persist($a);
		$this->getEntityManager()->flush();
		return $a;
	}
	
	public function add($a,$b, $parameter){
		$this->getEntityManager()->getRepository('\models\R')->create($a,$b,$parameter);
		
	}
	
	
	
	public function getBsByA($a){
		return $this->getEntityManager()->getRepository('\models\R')->getBsByA($a);
	}
	
}
