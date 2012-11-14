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
		//prepare les donnees a passer � la vue
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
		$this->form_validation->set_rules('description_photo', '[Description Photo]', 'required');
		$this->form_validation->set_rules('departement_station', '[D�partement]', 'required');
	
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
				
				
			// UPLOAD Start
			$img_rep = $em->getRepository('models\Image');
			$gallery_path = realpath(APPPATH . '..'.DIRECTORY_SEPARATOR.'ressources'.DIRECTORY_SEPARATOR.'images').DIRECTORY_SEPARATOR;
			$url = temp;
			$config['upload_path'] = '$gallery_path'; // Chemin du dossier de stockage
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
					$image = $img_rep->create($description_image, $url);
					$newUrl = $image->getURL();
					try {
						rename($gallery_path.$url.$image_data['file_ext'],$gallery_path.$newUrl.$image_data['file_ext']);
						rename($miniature_path.$url.$image_data['file_ext'], $miniature_path.$newUrl.'min'.$image_data['file_ext']);
	
						$repository->create($data['nom_station'] , $data['description_station'], $data['departement_station']);
					}
					catch (Exception $e){
						//en cas d'erreur on supprime l'image de la base de donnee.
						$repository->delete($url);
							
					}
					//redirection vers la page d'accueil du backoffice
					redirect('welcome/stations');
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
			$this->form_validation->set_message('nom_station_check', 'La station existe d�j�');
			return false;
		}
	}
	
}

/* End of file station.php */
/* Location: ./application/controllers/station.php */