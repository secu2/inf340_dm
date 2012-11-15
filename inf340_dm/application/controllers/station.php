<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Station extends CI_Controller {

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
		//prepare les donnees a passer à la vue
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
		$this->form_validation->set_rules('userfile', '[Photo]', 'required');
		$this->form_validation->set_rules('description_image', '[Description Image]', 'required');
		$this->form_validation->set_rules('departement_station', '[Département]', 'required');
	
		if ($this->form_validation->run() == FALSE){
			redirect(station);
		}
		else{
			$this->load->view('templates/header');
			$data['nom_station'] = $this->input->post('nom_station');
			$data['description_station'] = $this->input->post('description_station');
				
			$em = $this->doctrine->em;
			$num = $this->input->post('departement_station');
			
			$rep_departement = $em->getRepository('models\Departement');
			$rep_station = $em->getRepository('models\Station');
			$rep_image = $em->getRepository('models\Image');
			$data['departement_station'] = $rep_departement->getDepartementByNumero($num);
			
			// UPLOAD Start
			$img_rep = $em->getRepository('models\Image');
			//$gallery_path = realpath(APPPATH . '..'.DIRECTORY_SEPARATOR.'ressources'.DIRECTORY_SEPARATOR.'images').DIRECTORY_SEPARATOR;
			$gallery_path = './ressources/images/stations/';
			$url = 'temp';
			$config['upload_path'] = $gallery_path; // Chemin du dossier de stockage
			$config['allowed_types'] = 'gif|jpg|png|jpeg'; // Types d'éxtensions acceptées
			$config['max_size']	= '10000'; // Taille maximale acceptée
			$config['max_width']  = '1024'; // Largeur maximale
			$config['max_height']  = '768'; // Hauteur maximale
			$config['file_name']= $url; // Nom du fichier
			$config['overwrite']=true; // Autorise l'écrasement
				
			$this->load->library('upload', $config); //Chargement librairie upload

			$upload_status = $this->upload->do_upload(); // Statut de l'upload
			
			if($upload_status){ //Si l'upload marche avec ces paramètres
				$image_data = $this->upload->data(); // On récupère l'upload
				// Miniature Start
				$config = array(
						'source_image' => $image_data['full_path'], //get original image
						'new_image' => $gallery_path, //save as new image //need to create thumbs first
						'create_thumb' => true, //Mode thumbnail (?)
						'maintain_ratio' => true, //mainitien le ratio
						'width' => 75, //la largueur de la miniature sera de 250px
						'height' => 50 //la hauteur de la miniature sera de 100px
				);
				$this->load->library('image_lib', $config); //Chargement lib images
				$resize_status = $this->image_lib->resize();
				if ($resize_status){
					$description_image = $this->input->post('description_image');
					$rep_station->create($data['nom_station'] , $data['description_station'], $data['departement_station']);
					$image = $rep_image->create($description_image, $this->input->post('nom_station'));
					$newUrl = $image->getURL();
					try {
						$th_ext = '_thumb';
						rename($gallery_path.$url.$image_data['file_ext'],$gallery_path.$newUrl.$image_data['file_ext']);
						rename($gallery_path.$url.$th_ext.$image_data['file_ext'], $gallery_path.$newUrl.$th_ext.$image_data['file_ext']);						
					}
					catch (Exception $e){
						//en cas d'erreur on supprime la station de la base de donnee.
						$rep_station->delete($this->input->post('nom_station'));
							
					}
					//redirection vers la page d'accueil du backoffice
					redirect('station');
				}
				// Miniature Stop
			}
				
				
			//UPLOAD Stop
				
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
	
	function delete($nom)
	{
		$em = $this->doctrine->em;
		$repository = $em->getRepository('models\Station');
		$repository->delete($nom);
	
		$varsession = $this->session->userdata('loggedin');
		$id2 = $varsession['id'];
		$repository2 = $em->getRepository('models\Utilisateur');
		$utilisateur = $repository2->findOneById($id2);
		$data['utilisateur']=$utilisateur;
	
		$this->load->view('templates/header', $data);
		$this->load->view('notifications/maj_ok_view');
		$this->load->view('templates/footer');
	}
	
}

/* End of file station.php */
/* Location: ./application/controllers/station.php */