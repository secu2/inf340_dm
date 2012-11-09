<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('doctrine');
		$this->load->helper('html');
		$this->load->helper('url');
			
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
		$this->load->view('templates/header');
		if($this->input->post('username') == FALSE || $this->input->post('password') == FALSE){
			//Si je ne recoit pas les infos en POST, j'affiche le formulaire
			$this->load->view('modules/register');
		}
		else{
			//Si je recois les données en POST je les stocke dans un tableau
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['password_verify'] = $this->input->post('password_verify');
			$em = $this->doctrine->em;
			$repository = $em->getRepository('models\Utilisateur');
			// Je verifie que les deux mots de passe correspondent
			if($data['password'] == $data['password_verify']){
				$repository->create($data['username'] , $data['password'] , '1');
				$this->load->view('notifications/register_ok_view');
			}else{
				//Si les deux mots de passe ne correspondent pas, je renvoie le formulaire en envoyant l'erreur
				$post['error_id'] = 'Les deux mots de passe ne correspondent pas, veuillez réessayer';
				//J'envoie aussi le username histoire de pas avoir à le taper à nouveau
				$post['username'] = $this->input->post('username');
				$this->load->view('modules/register', $post);
			
			}
		}
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