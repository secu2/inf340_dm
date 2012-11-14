<?php
namespace models\repositories;

/**
 * Le d�p�t utilisateur
 * @author jub
 *
 */
class StationRepository extends \Doctrine\ORM\EntityRepository {

	public function create($nom, $description, $departement){
		$station = new \models\Station($nom, $description, $departement);
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
	
	public function getStationByNom($nom)
	{
		$em = $this->getEntityManager();
		$station = $this->findOneByNom($nom);
		return $station;
	}
	
	public function delete($nom)
	{
		$em = $this->getEntityManager();
	
		try {
			//suppression d'un utilisateur
			$repository = $em->getRepository('models\Station');
			$station = $repository->getStationByNom($nom);
			$em->remove($station);
			$em->flush();
		} catch (\Exception $e) {
	
		};
	}
}
