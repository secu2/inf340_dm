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
		$this->load->library(array('session','doctrine','form_validation'));
			
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
		//prepare les donnees a passer Ã  la vue
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
		
		$repository = $em->getRepository('models\Utilisateur');
		$repository2 = $em->getRepository('models\Station');
		$repository3 = $em->getRepository('models\Departement');
		
		$utilisateur = $repository->getUtilisateurById($id);
		$stations = $repository2->findAll();
		$departements = $repository3->findAll();
		
		$data['utilisateur']=$utilisateur;
		$data2['stations'] = $stations;
		$data3['departements'] = $departements;
		
		$this->load->view('templates/header', $data);
		$this->load->view('frontoffice/stations_view', $data2);
		if(isset($utilisateur) && $utilisateur->getLevel()==2)
			$this->load->view('modules/add_station_view', $data3);
		$this->load->view('templates/footer');
	}
	
	function station_info($nom)
	{
		//recuperation de la variable de session loggedin positionnee par backoffice/session
		$varsession = $this->session->userdata('loggedin');
		$id = $varsession['id'];
		//recupere le gestionnaire d'entite
		$em = $this->doctrine->em;
		//recupere les depots
		$repository = $em->getRepository('models\Station');
		$repository2 = $em->getRepository('models\Commentaire');
		$repository3 = $em->getRepository('models\Utilisateur');
		
		$station = $repository->getStationByNom($nom);
		$commentaires = $repository2->findByStation($station);
		$utilisateur = $repository3->findOneById($id);
		//prepare les donnees a passer ï¿½ la vue
		$data['station']=$station;
		$data2['commentaires'] = $commentaires;
		$data3['utilisateur'] = $utilisateur;
	
		$this->load->view('templates/header', $data3);
		$this->load->view('frontoffice/station_info_view', $data);
		$this->load->view('frontoffice/commentaires_view', $data2);
		$this->load->view('templates/footer');
	}
	
	public function add_station()
	{
		$this->form_validation->set_rules('nom_station', '[Nom de la station]', 'required|callback_nom_station_check');
		$this->form_validation->set_rules('description_station', '[Description]', 'required');
		$this->form_validation->set_rules('departement_station', '[Département]', 'required');
	
		if ($this->form_validation->run() == FALSE){
			redirect(welcome/stations);
		}
		else{
			$this->load->view('templates/header');
			$data['nom_station'] = $this->input->post('nom_station');
			$data['description_station'] = $this->input->post('description_station');
			
			$em = $this->doctrine->em;
			$num = $this->input->post('departement_station');
			$rep = $em->getRepository('models\Departement');
			$data['departement_station'] = $rep->getDepartementByNumero($num);
			
			$repository = $em->getRepository('models\Station');
			
			$repository->create($data['nom_station'] , $data['description_station'], $data['departement_station']);
			$this->load->view('notifications/add_station_ok_view');
			$this->load->view('templates/footer');
		}
	}
	
	function nom_station_check($nom_station)
	{
		$em = $this->doctrine->em;
		$repository = $em->getRepository('models\Station');
		$station = $repository->getStationByNom($nom_station);
		if(is_null($station)){
			return true;
		}
		else{
			$this->form_validation->set_message('nom_station_check', 'La station existe déjà');
			return false;
		}
	}
	
	public function compte_user()
	{
		redirect(user);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */