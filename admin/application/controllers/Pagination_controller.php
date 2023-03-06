<?php class Pagination_controller extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('Pagination_model');
	}


} ?>