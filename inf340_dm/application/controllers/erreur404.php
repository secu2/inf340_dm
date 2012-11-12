<?php
class erreur404 extends CI_Controller
{
	public function __construct()
	{
	        parent::__construct();
	}

	public function index()
	{
		$this->output->set_status_header('404');
		$data['content'] = 'error_404'; 
		$this->load->view('erreur404',$data);
	}
}
// test
?>