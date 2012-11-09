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
		$em = $this->doctrine->em;
		$utilisateurRepository = $em->getRepository('models\Utilisateur');
		$authOk=$utilisateurRepository->authenticate($username,$password);



		if ($authOk)
		{
			//l'id utilisateur est obtenu à partir de son login
			$utilisateur = $utilisateurRepository->findOneByLogin($username);
			//la variable de session loggedin contiend un tableau qui à la clef id associe l'identifiant de l'utilisateur qui vient de s'authentifier.
			$this->session->set_userdata('loggedin', array('id'=>$utilisateur->getId()) );
			redirect('/');
		}else{
		//Que l'authentification est réussie ou non, l'on est redirigé vers le contôleur Accueil qui via le controleur hérité vérifiera si l'authentification a réussie.
		redirect('/login');
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('loggedin');
	
		redirect('/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */