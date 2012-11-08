<?php



namespace models;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Utilisateur
 *
 *@Table(name="A")
 *@Entity (repositoryClass="\models\repositories\ARepository")
 */
class A
{
	/**
	 * @var integer $idutilisateur
	 *
	 *@Column(name="idA", type="integer", nullable=false)
	 *@Id
	 *@GeneratedValue(strategy="IDENTITY")
	 */
	private $idA;

	public function __construct(){
		
	}

	public function getIdA()
	{
		return $this->idA;
	}

	
	
	public function setIdA($idA) {
		$this->idA = $idA;
	}
	
	
	
	
}


