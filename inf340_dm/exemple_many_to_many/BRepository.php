<?php
namespace models\repositories;

/**
 * Le dépôt utilisateur
 * @author jub
 *
 */
class BRepository extends \Doctrine\ORM\EntityRepository {

	public function create(){
		$b = new \models\B();
		$this->getEntityManager()->persist($b);
		$this->getEntityManager()->flush();
		return $b;
	}
	
	public function add($a,$b, $parameter){
		$this->getEntityManager()->getRepository('\models\R')->create($a,$b,$parameter);
	}
	
	public function getAsByB($b){
		return $this->getEntityManager()->getRepository('\models\R')->getAsByB($b);
	}
}
