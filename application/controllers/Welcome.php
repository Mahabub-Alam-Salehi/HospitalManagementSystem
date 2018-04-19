<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
	}
	public function index()
	{
		
		$this->load->view('header');
		$this->load->view('blank');
		$this->load->view('footer');
	}
}
