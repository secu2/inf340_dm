<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le dépôt utilisateur
 * @author jub
 *
 */
class CommentaireRepository extends \Doctrine\ORM\EntityRepository {

	public function create($id,$nom, $texte){
		$commentaire = new \models\Commentaire($id,$nom, $texte);
		$this->getEntityManager()->persist($commentaire);
		$this->getEntityManager()->flush();
		return $commentaire;
	}
	
	public function getUtilisateurByStation($nom){
		
		$res = new ArrayCollection();
		foreach ($this->findByNom($nom) as $texte)
			$res->add($texte->getId());
		return $res;
	}
	
	public function getStationByUtilisateur($id){
	
		$res = new ArrayCollection();
		foreach ($this->findById($id) as $texte)
			$res->add($texte->getNom());
		return $res;
	}
	
	public function getTexteByUtilisateurStation($id,$nom){
		return $this->findOneBy(array('id'=>$id,'nom'=>$nom))->getTexte();
	}
}
