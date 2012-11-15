<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le d�p�t utilisateur
 * @author jub
 *
 */
class CommentaireRepository extends \Doctrine\ORM\EntityRepository {

	public function create($id, $nom, $data, $note){
		$commentaire = new \models\Commentaire($id,$nom,$data, $note);
		$this->getEntityManager()->persist($commentaire);
		$this->getEntityManager()->flush();
		return $commentaire;
	}
	
	public function getUtilisateurByStation($nom){
		
		$res = new ArrayCollection();
		foreach ($this->findByNom($nom) as $data)
			$res->add($data->getId());
		return $res;
	}
	
	public function getStationByUtilisateur($id){
	
		$res = new ArrayCollection();
		foreach ($this->findById($id) as $data)
			$res->add($data->getNom());
		return $res;
	}
	
	public function getDataByUtilisateurStation($id,$nom){
		return $this->findOneBy(array('id'=>$id,'nom'=>$nom))->getData();
	}
}
