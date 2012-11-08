<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('doctrine');
		$this->load->helper('html');
		$this->load->helper('url');
			
	}
	
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('modules/login');
		$this->load->view('templates/footer');
	}
	
	public function verify()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		echo '<u>User:</u> ' . $username . ' - <u>Password:</u> ' . $password;
		$em = $this->doctrine->em;
		$utilisateurRepository = $em->getRepository('models\Utilisateur');
		$authOk=$utilisateurRepository->authenticate($username,$password);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */