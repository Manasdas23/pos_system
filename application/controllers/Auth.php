<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
     * Landing page with role selection
     */
    public function index()
    {
        // If user is already logged in, redirect to their dashboard
        if ($this->session->userdata('user_id')) {
            $this->_redirect_to_dashboard();
            return;
        }
        
        $this->load->view('auth/landing');
    }

    /**
     * Login page for specific role
     */
    public function login($role = null)
    {
        // Check if user is trying to access a different role than their current one
        if ($this->session->userdata('user_id')) {
            $current_role = $this->session->userdata('role');
            
            // If trying to access the same role they already have, redirect to dashboard
            if ($current_role === $role) {
                $this->_redirect_to_dashboard($current_role);
                return;
            }
            
            // If trying to access a different role, logout automatically and continue to login page
            $this->session->sess_destroy();
            $this->session->set_flashdata('info', 'Switched to ' . ucfirst(str_replace('_', ' ', $role)) . ' login. Please enter your credentials.');
        }

        if (!in_array($role, ['manager', 'cashier', 'inventory_operator'])) {
            redirect('auth');
        }

        $data['role'] = ucfirst(str_replace('_', ' ', $role));
        $data['role_key'] = $role;
        $data['error'] = $this->session->flashdata('error');
        $data['info'] = $this->session->flashdata('info');
        
        $this->load->view('auth/login', $data);
    }

    /**
     * Process login
     */
    public function process_login()
    {
        $role = $this->input->post('role');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Validate input
        if (empty($username) || empty($password) || empty($role)) {
            $this->session->set_flashdata('error', 'Please fill in all required fields.');
            redirect('auth/login/' . $role);
            return;
        }

        // Authenticate user
        $user = $this->User_model->authenticate($username, $password);
        
        if ($user) {
            // Check if user has the requested role
            if ($user->role_name === $role) {
                // Set session data
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'role' => $user->role_name,
                    'role_display_name' => $user->role_display_name,
                    'logged_in' => TRUE
                );
                
                $this->session->set_userdata($session_data);
                
                // Redirect to appropriate dashboard
                $this->_redirect_to_dashboard($user->role_name);
            } else {
                $this->session->set_flashdata('error', 'You do not have permission to access this role.');
                redirect('auth/login/' . $role);
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect('auth/login/' . $role);
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    /**
     * Redirect to appropriate dashboard based on role
     */
    private function _redirect_to_dashboard($role = null)
    {
        if (!$role) {
            $role = $this->session->userdata('role');
        }

        switch ($role) {
            case 'manager':
                redirect('manager/dashboard');
                break;
            case 'cashier':
                redirect('cashier/dashboard');
                break;
            case 'inventory_operator':
                redirect('inventory/dashboard');
                break;
            default:
                redirect('auth');
        }
    }
}