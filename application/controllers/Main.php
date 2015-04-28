<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()	{
		$data['logged_in'] = '';
		if ($this->session->has_userdata('logged_in')) {
			$data['logged_in'] = $this->session->logged_in;
		}
		$this->load->view('header', $data);
		$this->load->view('main');
		$this->load->view('footer');
	}
	public function view($page = 'home') {
		
	}
}