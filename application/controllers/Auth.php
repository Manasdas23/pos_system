<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Landing page with role selection
     */
    public function index()
    {
        $this->load->view('auth/landing');
    }

    /**
     * Login page for specific role
     */
    public function login($role = null)
    {
        if (!in_array($role, ['manager', 'cashier', 'inventory_operator'])) {
            redirect('auth');
        }

        $data['role'] = ucfirst(str_replace('_', ' ', $role));
        $data['role_key'] = $role;
        
        $this->load->view('auth/login', $data);
    }

    /**
     * Process login
     */
    public function process_login()
    {
        // Handle login processing here
        $role = $_POST['role'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // For now, just redirect back to landing page
        // You can implement actual authentication logic here
        redirect('auth');
    }
}