<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct() {
		parent::__construct();
		$this->load->library('doctrine');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
			
	}
	
	public function index()
	{
		
		/* $em = $this->doctrine->em;
		$utilisateurRepository = $em->getRepository('models\Utilisateur');
		$session = $this->session->userdata('loggedin');
		echo $session['id'];
		$utilisateur = $utilisateurRepository->getUtilisateurById($session['id']);
		$data['login']= $utilisateur; */
		
		//recuperation de la variable de session loggedin positionnee par backoffice/session
		$varsession = $this->session->userdata('loggedin');
		$id = $varsession['id'];
		//recupere le gestionnaire d'entite
		$em = $this->doctrine->em;
		//recupere le depot utilisateur
		$repository = $em->getRepository('models\Utilisateur');
		//trouve un utilisateur a partir de son login
		$utilisateur = $repository->getUtilisateurById($id);
		//prepare les donnees a passer à la vue
		//dans la vue vous pourrez utiliser la variable $utilisateur
		$data['utilisateur']=$utilisateur;
		
		$this->load->helper('url');
		$this->load->view('templates/header', $data);
		$this->load->view('index');
		$this->load->view('templates/footer');
	}
	
	public function inscription()
	{
		$this->load->view('templates/header');
		$this->load->view('backoffice/inscription_view');
		$this->load->view('templates/footer');
	}
	
	public function stations()
	{
		//recuperation de la variable de session loggedin positionnee par backoffice/session
		$varsession = $this->session->userdata('loggedin');
		$id = $varsession['id'];
		//recupere le gestionnaire d'entite
		$em = $this->doctrine->em;
		//recupere le depot utilisateur et station
		$repository = $em->getRepository('models\Utilisateur');
		$repository2 = $em->getRepository('models\Station');
		//trouve un utilisateur a partir de son login
		//trouve toutes les stations
		$utilisateur = $repository->getUtilisateurById($id);
		$stations = $repository2-> findAll();
		//prepare les donnees a passer à la vue
		//dans la vue vous pourrez utiliser la variable $utilisateur et stations
		$data['utilisateur']=$utilisateur;
		$data2['stations'] = $stations;
		
		$this->load->view('templates/header', $data);
		$this->load->view('frontoffice/stations_view', $data2);
		$this->load->view('templates/footer');
	}
	
	function station_info($nom)
	{
		//recuperation de la variable de session loggedin positionnee par backoffice/session
		//$varsession = $this->session->userdata('loggedin');
		//$id = $varsession['id'];
		//recupere le gestionnaire d'entite
		$em = $this->doctrine->em;
		//recupere le depot station
		$repository = $em->getRepository('models\Station');
		//trouve un utilisateur a partir de son login
		$station = $repository->getStationByNom($nom);
		//prepare les donnees a passer à la vue
		//dans la vue vous pourrez utiliser la variable $utilisateur
		$data['station']=$station;
	
		$this->load->view('templates/header');
		$this->load->view('frontoffice/station_info_view', $data);
		$this->load->view('frontoffice/commentaires_view');
		$this->load->view('templates/footer');
	}
	
	public function compte_user()
	{
		redirect(user);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */