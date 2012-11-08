<?php



/**
 * Description of TypeTailleRepository
 *
 * @author jub
 */

namespace models\repositories;

class DepartementRepository extends \Doctrine\ORM\EntityRepository {

	/**
	 * Enter description here ...
	 * @param unknown_type $description
	 * @param unknown_type $id
	 * @return \models\Image l'image qui vient d'être crée avec son url
	 */
	public function create($numero, $nom) {
		$em = $this->getEntityManager();
		$repository = $em->getRepository('models\Station');
		$station = $repository->findOneByNom($nom);
		$departement = new \models\Departement($numero, $station);
		$em->persist($departement);
		$em->flush();
		return $image;
	}


	public function getDepartementByNumero($numero)
	{
		$departement = $this->findOneByNumero($numero);
		return $departement;
	}
	 
	public function delete($numero)
	{
		$em = $this->getEntityManager();

		try {
			$departement = $this->findOneByNumero($numero);
			$em->remove($departement);
			$em->flush();
		} catch (\Exception $e) {

		};
	}
}

?>
