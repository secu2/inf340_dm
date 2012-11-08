<?php



namespace models;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Utilisateur
 *
 *@Table(name="B")
 *@Entity (repositoryClass="\models\repositories\BRepository")
 */
class B
{
    /**
     * @var integer $idutilisateur
     *
     *@Column(name="idB", type="integer", nullable=false)
     *@Id
     *@GeneratedValue(strategy="IDENTITY")
     */
    private $idB;

    
    public function __construct(){
    	
    }
    
    public function getIdB()
    {
    	return $this->idB;
    }
    
    
    
    public function setIdA($idA) {
    	$this->idB = $idB;
    }
    
    
    
    
}
