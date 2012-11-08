<?php
namespace models\repositories;

/**
 * Le dépôt utilisateur
 * @author jub
 *
 */
class StationRepository extends \Doctrine\ORM\EntityRepository {

	public function create(){
		$station = new \models\Station();
		$this->getEntityManager()->persist($station);
		$this->getEntityManager()->flush();
		return $station;
	}
	
	public function add($id,$nom, $texte){
		$this->getEntityManager()->getRepository('\models\Commentaire')->create($id,$nom,$texte);
	}
	
	public function getUtilisateurByStation($nom){
		return $this->getEntityManager()->getRepository('\models\Commentaire')->getUtilisateurByStation($station);
	}
}
