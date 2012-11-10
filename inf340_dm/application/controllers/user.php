<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('session','doctrine','form_validation'));
		$this->load->helper(array('html','url','form'));
			
	}

	public function index()
	{
		$varsession = $this->session->userdata('loggedin');
		if(isset($varsession['id'])){
			echo 'gestion compte';
		}else{
			$this->load->view('templates/header');
			$this->load->view('modules/login');
			$this->load->view('templates/footer');
		}
	}
	
	public function register()
	{
		$this->form_validation->set_rules('username', '[Nom d\'utilisateur]', 'required|callback_username_check');
		$this->form_validation->set_rules('password', '[Mot de passe]', 'required');
		$this->form_validation->set_rules('password_verify', '[Confirmation du mot de passe]', 'required|matches[password]');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header');
			$this->load->view('modules/register');
			$this->load->view('templates/footer');
		}
		else{
			$this->load->view('templates/header');
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['password_verify'] = $this->input->post('password_verify');
			$em = $this->doctrine->em;
			$repository = $em->getRepository('models\Utilisateur');
			//utilisateur normal = level 0, mod�rateur = level 1, administrateur = level 2
			$repository->create($data['username'] , $data['password'] , '0');
			$this->load->view('notifications/register_ok_view');
			$this->load->view('templates/footer');
		}
	}
	
	function username_check($username)
	{
		$em = $this->doctrine->em;
		$repository = $em->getRepository('models\Utilisateur');
		$utilisateur = $repository->getUtilisateurByLogin($username);
		if(is_null($utilisateur)){
			return true;
		}
		else{
			$this->form_validation->set_message('username_check', 'Nom d\'utilisateur indisponible');
			return false;
		}
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
			// l'id utilisateur est obtenu à partir de son login
			$utilisateur = $utilisateurRepository->findOneByLogin($username);
			// la variable de session loggedin contiend un tableau qui à la clef id associe l'identifiant de l'utilisateur qui vient de s'authentifier.
			$this->session->set_userdata('loggedin', array('id'=>$utilisateur->getId()) );
			redirect('/');
		}else{
			// Que l'authentification est réussie ou non, l'on est redirigé vers le contôleur Accueil qui via le controleur hérité vérifiera si l'authentification a réussie.
			redirect('/user/');
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