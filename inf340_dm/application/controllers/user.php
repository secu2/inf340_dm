<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('session','doctrine','form_validation'));
		$this->load->helper(array('html','url','form'));
			
	}

	public function index()
	{
		//recuperation de la variable de session loggedin positionnee par backoffice/session
		$varsession = $this->session->userdata('loggedin');
		$id = $varsession['id'];
		//recupere le gestionnaire d'entite
		$em = $this->doctrine->em;
		//recupere le depot utilisateur
		$repository = $em->getRepository('models\Utilisateur');
		//trouve un utilisateur a partir de son login
		$utilisateur = $repository->getUtilisateurById($id);
		$users = $repository->findAll();
		//prepare les donnees a passer à la vue
		//dans la vue vous pourrez utiliser la variable $utilisateur
		$data['utilisateur']=$utilisateur;
		$data2['users'] = $users;
		
		if(isset($id)){
			$this->load->view('templates/header', $data);
			$this->load->view('notifications/compte_user_view');
			if($utilisateur->getLevel()==2)
				$this->load->view('notifications/gestion_user_view', $data2);
		}else{
			$this->load->view('templates/header');
			$this->load->view('modules/login');
		}
		$this->load->view('templates/footer');
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
	
	function updateOk()
	{
		//recuperer l'identifiant dans la variable de session loggedin
		$varsession = $this->session->userdata('loggedin');
		$id = $varsession['id'];
		//recuperer le login recu en post
		$log = $this->input->post('login');
		//recuperer le password recu en post
		$pass = $this->input->post('password');
		//recuperer le level recu en post
		$lvl = $this->input->post('level');
		//recuperer le gestionnaire d'entites
		$em = $this->doctrine->em;
		//recuperer le depot utilisateur
		$repository = $em->getRepository('models\Utilisateur');
		//mettre a jour l'utilisateur
		$repository->updateUtilisateur($id, $log, $pass, $lvl);
		//r�cup�re l'utilisateur pour la view
		$utilisateur = $repository->getUtilisateurById($id);
		$data['utilisateur']=$utilisateur;
		//aficher update_success_view
		$this->load->view('templates/header', $data);
		$this->load->view('notifications/maj_ok_view');
		$this->load->view('templates/footer');
	}
	
	function add_commentaire()
	{
		$em = $this->doctrine->em;
		$varsession = $this->session->userdata('loggedin');
		$id = $varsession['id'];
		$rep = $em->getRepository('models\Utilisateur');
		$utilisateur = $rep->getUtilisateurById($id);
		$data['utilisateur'] = $utilisateur;
		
		$this->form_validation->set_rules('nom', '[Nom de la station]', 'required');
		$this->form_validation->set_rules('data', '[Commentaire]', 'required');
		$this->form_validation->set_rules('note', '[Note]', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$id_error = 'ajout d\' un commentaire';
			$data_error['id_error'] = $id_error;
			$this->load->view('templates/header', $data['utilisateur']);
			$this->load->view('notifications/error_view', $data_error);
			$this->load->view('templates/footer');
		}
		else{
			$this->load->view('templates/header', $data['utilisateur']);
			$data['nom'] = $this->input->post('nom');
			$data['data'] = $this->input->post('data');
			$data['note'] = $this->input->post('note');
			
			$repository = $em->getRepository('models\Commentaire');
			$repository->create($id, $data['nom'], $data['data'] , $data['note']);
			$this->load->view('notifications/add_commentaire_ok_view');
			$this->load->view('templates/footer');
		}
	}
	
	function change_level($id)
	{
		$em = $this->doctrine->em;
		$repository = $em->getRepository('models\Utilisateur');
		$repository->changeLevel($id);
		
		$varsession = $this->session->userdata('loggedin');
		$id2 = $varsession['id'];
		$utilisateur = $repository->getUtilisateurById($id2);
		$data['utilisateur']=$utilisateur;
		
		$this->load->view('templates/header', $data);
		$this->load->view('notifications/maj_ok_view');
		$this->load->view('templates/footer');
	}
	
	function delete($id)
	{
		$em = $this->doctrine->em;
		$repository = $em->getRepository('models\Utilisateur');
		$repository->delete($id);
		
		$varsession = $this->session->userdata('loggedin');
		$id2 = $varsession['id'];
		$utilisateur = $repository->getUtilisateurById($id2);
		$data['utilisateur']=$utilisateur;
		
		$this->load->view('templates/header', $data);
		$this->load->view('notifications/maj_ok_view');
		$this->load->view('templates/footer');
	}

	function logout()
	{
		$this->session->unset_userdata('loggedin');

		redirect('/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */