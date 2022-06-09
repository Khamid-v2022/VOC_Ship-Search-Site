<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutme extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data['primary_menu'] = 'About Me';
		$this->load->view('header', $data);
		$this->load->view('About_me');
		$this->load->view('footer');
	}
}
