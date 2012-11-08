<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le d�p�t utilisateur
 * @author jub
 *
 */
class UtilisateurRepository extends \Doctrine\ORM\EntityRepository {

	public function create(){
		$utilisateur = new \models\Utilisateur();
		$this->getEntityManager()->persist($utilisateur);
		$this->getEntityManager()->flush();
		return $a;
	}
	
	public function add($id,$nom, $texte){
		$this->getEntityManager()->getRepository('\models\Commentaire')->create($id,$nom,$texte);
		
	}
	
	
	
	public function getStationByUtilisateur($id){
		return $this->getEntityManager()->getRepository('\models\Commentaire')->getStationByUtilisateur($id);
	}
	
}