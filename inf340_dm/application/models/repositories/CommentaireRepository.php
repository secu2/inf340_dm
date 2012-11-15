<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le dépôt commentaire
 * @author jub
 *
 */
class CommentaireRepository extends \Doctrine\ORM\EntityRepository {

	public function create($utilisateur, $station, $data, $note){
		$commentaire = new \models\Commentaire($utilisateur,$station,$data, $note);
		$this->getEntityManager()->persist($commentaire);
		$this->getEntityManager()->flush();
		return $commentaire;
	}
	
	public function getUtilisateurByStation($station){
		
		$res = new ArrayCollection();
		foreach ($this->findByStation($station) as $data)
			$res->add($data->getId());
		return $res;
	}
	
	public function getStationByUtilisateur($utilisateur){
	
		$res = new ArrayCollection();
		foreach ($this->findByUtilisateur($utilisateur) as $data)
			$res->add($data->getNom());
		return $res;
	}
	
	public function getDataByUtilisateurStation($utilisateur,$station){
		return $this->findOneBy(array('utilisateur'=>$utilisateur,'station'=>$station));
	}
	
	public function delete($utilisateur, $station)
	{
		$em = $this->getEntityManager();
	
		try {
			//suppression d'un commentaire
			$repository = $em->getRepository('models\Commentaire');
			$commentaire = $repository->getDataByUtilisateurStation($utilisateur,$station);
			$em->remove($commentaire);
			$em->flush();
		} catch (\Exception $e) {
	
		};
	}
}
