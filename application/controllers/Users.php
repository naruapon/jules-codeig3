<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        // Protect page from unauthorized access
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth/login');
        }

        // Restrict access to admins only
        if ($this->session->userdata('role') !== 'admin') {
            // Or show a custom access denied page
            show_error('You do not have permission to access this page.', 403, 'Access Denied');
        }
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users/index', $data);
    }
}
