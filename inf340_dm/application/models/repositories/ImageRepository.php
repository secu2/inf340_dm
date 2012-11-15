<?php



/**
 * Description of TypeTailleRepository
 *
 * @author jub
 */

namespace models\repositories;

class ImageRepository extends \Doctrine\ORM\EntityRepository {

	/**
	 * Enter description here ...
	 * @param unknown_type $description
	 * @param unknown_type $id
	 * @return \models\Image l'image qui vient d'être crée avec son url
	 */
	public function create($description, $stationNom) {
		$em = $this->getEntityManager();
		$repository = $em->getRepository('models\Station');
		$station_nom = $repository->findOneByNom($stationNom);
		$image = new \models\Image($description, $station_nom);
		$em->persist($image);
		$em->flush();
		return $image;
	}


	public function getImageByURL($url)
	{
		$image = $this->findOneByUrl($url);
		return $image;
	}
	
	public function getImageURL($url)
	{
		$image = $this->findOneByUrl($url);
		return $image;
	}
	 
	public function delete($url)
	{
		$em = $this->getEntityManager();

		try {
			$image = $this->findOneByUrl($url);
			$em->remove($image);
			$em->flush();
		} catch (\Exception $e) {

		};
	}
	 
	public function updateDescription($url, $description) {
		$image = $this->findOneByUrl($url);
		$image->setDescription($description);
		$em = $this->getEntityManager();
		$em->persist($image);
		$em->flush();
		 
	}
}

?>
