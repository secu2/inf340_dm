<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le dépôt utilisateur
 * @author jub
 *
 */
class RRepository extends \Doctrine\ORM\EntityRepository {

	public function create($a,$b, $parameter){
		$r = new \models\R($a,$b, $parameter);
		$this->getEntityManager()->persist($r);
		$this->getEntityManager()->flush();
		return $r;
	}
	
	public function getAsByB($b){
		
		$res = new ArrayCollection();
		foreach ($this->findByB($b) as $r)
			$res->add($r->getA());
		return $res;
	}
	
	public function getBsByA($a){
	
		$res = new ArrayCollection();
		foreach ($this->findByA($a) as $r)
			$res->add($r->getB());
		return $res;
	}
	
	public function getParamterByAB($a,$b){
		return $this->findOneBy(array('a'=>$a,'b'=>$b))->getParameter();
	}
}
