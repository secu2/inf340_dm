<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_form extends CI_Controller {

	function __construct() {
		parent::__construct();
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */