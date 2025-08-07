<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        // Autoloaded: library('form_validation'), library('session'), helper('url'), helper('form')
    }

    public function login()
    {
        // If user is already logged in, redirect to users list
        if ($this->session->userdata('is_logged_in')) {
            redirect('users');
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load view
            $this->load->view('auth/login');
        } else {
            // Validation passed
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_username($username);

            if ($user && $this->User_model->verify_password($password, $user->password)) {
                // User found and password is correct
                $session_data = array(
                    'user_id'  => $user->id,
                    'username' => $user->username,
                    'role'     => $user->role,
                    'is_logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('users');
            } else {
                // Login failed
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'country'  => $this->input->post('country'),
                'password' => $this->input->post('password'),
                'role'     => 'user' // Default role
            );

            if ($this->User_model->insert_user($data)) {
                $this->session->set_flashdata('success', 'Registration successful! Please login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                redirect('auth/register');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
