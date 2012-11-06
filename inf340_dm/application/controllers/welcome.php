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
			
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}
	
	public function inscription()
	{
		$this->load->helper('url');
		$this->load->view('backoffice/templates/header_inscription');
		$this->load->view('backoffice/inscription_view');
		$this->load->view('templates/footer');
	}
	
	public function connexion()
	{
		$this->load->helper('url');
		$this->load->view('backoffice/templates/header_connexion');
		$this->load->view('modules/login');
		$this->load->view('templates/footer');
	}
	
	public function stations()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('frontoffice/stations_view');
		$this->load->view('templates/footer');
	}
	
	public function compte()
	{
		$this->load->helper('url');
		//Si l'utilisateur n'est pas connecté, on le renvoit sur la page de connexion avec un message d'erreur
		$this->load->view('backoffice/templates/header_connexion');
		$this->load->view('backoffice/login_needed_view');
		$this->load->view('modules/login');
		//Sinon on l'envoit sur la page de son compte
		
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */