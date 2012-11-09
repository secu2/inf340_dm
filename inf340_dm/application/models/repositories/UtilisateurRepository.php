<?php
namespace models\repositories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Le d�p�t utilisateur
 * @author jub
 *
 */
class UtilisateurRepository extends \Doctrine\ORM\EntityRepository {

	public function create($username, $password, $level){
	$em = $this->getEntityManager();
		//creation d'un utilisateur
		//TODO
		//--------------------------------------------------------------------------------------------------------------
		$repository = $em->getRepository('models\Utilisateur');
		$utilisateur = new \models\Utilisateur($username, $password, $level);
		$em->persist($utilisateur);
		//--------------------------------------------------------------------------------------------------------------
		try {
			$em->flush();
		} catch (\Exception $e) {
			//echo $e->getMessage();
		}
	}
	
	public function add($id,$nom, $texte){
		$this->getEntityManager()->getRepository('\models\Commentaire')->create($id,$nom,$texte);
		
	}
	
	
	
	public function getStationByUtilisateur($id){
		return $this->getEntityManager()->getRepository('\models\Commentaire')->getStationByUtilisateur($id);
	}
	
	public function authenticate($login, $password)
	{
		$CI = & get_instance();
		$CI->load->library('encrypt');
		$utilisateur = $this->findOneByLogin($login);
			
		$res = FALSE;
		if ($utilisateur != NULL)
		{
				
			$res = $utilisateur->authenticate($password);
				
		}
		return $res;
	}
	
	/**
	 * Permet à partir du 'lidentifiant de récuperer un utilisateur.
	 * L'opération est posible car le l'identifiant est unique
	 * @param unknown_type $id l'identifiant de l'utilisateur recherché
	 * @return l'utilisateur correspondant à l'identifiant
	 */
	public function getUtilisateurById($id)
	{
		$em = $this->getEntityManager();
		$utilisateur = $this->findOneById($id);
		return $utilisateur;
	}
	
}
