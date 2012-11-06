<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('doctrine');
		$this->load->helper('html');
		$this->load->helper('url');
			
	}
	
	public function index()
	{
		//Si l'utilisateur n'est pas connecté, on le renvoit sur la page de connexion avec un message d'erreur
		$this->load->view('templates/header_connexion');
		$this->load->view('backoffice/login_needed_view');
		$this->load->view('modules/login');
		//Sinon on l'envoit sur la page de son compte
		
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */