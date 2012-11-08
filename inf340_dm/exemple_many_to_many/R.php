<?php



namespace models;

/**
 * Utilisateur
 *
 *@Table(name="A_has_B")
 *@Entity (repositoryClass="\models\repositories\RRepository")
 */
class R
{
    /**
     * 
     *
     *@Id
     *@ManyToOne(targetEntity="A")
     * @JoinColumns({
     *   @JoinColumn(name="A_idA", referencedColumnName="idA", onDelete="Cascade")
     * })
     */
    private $a;

    /**
     * 
     *@Id
     *@ManyToOne(targetEntity="B")
     * @JoinColumns({
     *   @JoinColumn(name="B_idB", referencedColumnName="idB", onDelete="Cascade")
     * })
     */
    private $b;
    
    /**
     * @var string $parameter
     *
     *@Column(name="parameter", type="string", length=45)
     *
     */
    private $parameter;
    
    
    
    public function __construct($a, $b, $parameter){
    	$this->a = $a;
    	$this->b = $b;	
    	$this->parameter = $parameter;
    }
    
    public function getParameter(){
    	return $this->parameter;
    }
    
    public function setParameter($parameter){
    	$this->parameter = $parameter;
    }
    
    public function getA(){
    	return $this->a;
    }
    public function getB(){
    	return $this->b;
    }
}
