<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Autoloaded: library('session'), helper('url')
    }

	public function index()
	{
		// Check if the user is logged in and redirect accordingly
        if ($this->session->userdata('is_logged_in')) {
            redirect('users');
        } else {
            redirect('auth/login');
        }
	}
}
