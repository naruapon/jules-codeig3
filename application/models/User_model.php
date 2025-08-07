<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Insert new user to the database
     * @param array $data User data (username, email, country, password)
     * @return bool
     */
    public function insert_user($data)
    {
        // Hash the password before storing
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->db->insert('users', $data);
    }

    /**
     * Get user by username for login verification
     * @param string $username
     * @return mixed User object or null
     */
    public function get_user_by_username($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row();
    }

    /**
     * Verify user's password
     * @param string $plain_password The password from the form
     * @param string $hashed_password The password from the database
     * @return bool
     */
    public function verify_password($plain_password, $hashed_password)
    {
        return password_verify($plain_password, $hashed_password);
    }

    /**
     * Get all users from the database
     * @return array
     */
    public function get_all_users()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }
}
