<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->_check_auth();
        $this->_check_role('manager');
    }

    public function dashboard() {
        $data['user'] = $this->session->userdata();
        $data['page_title'] = 'Manager Dashboard';
        $this->load->view('manager/dashboard', $data);
    }

    /**
     * User Management Page
     */
    public function users() {
        $data['user'] = $this->session->userdata();
        $data['page_title'] = 'User Management';
        $data['users'] = $this->User_model->get_all_users_with_roles();
        $data['roles'] = $this->User_model->get_all_roles();
        $data['success'] = $this->session->flashdata('success');
        $data['error'] = $this->session->flashdata('error');
        
        $this->load->view('manager/users', $data);
    }

    /**
     * Add New User
     */
    public function add_user() {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $full_name = $this->input->post('full_name');
            $role_id = $this->input->post('role_id');
            $is_active = $this->input->post('is_active') ? 1 : 0;

            // Validate input
            if (empty($username) || empty($password) || empty($role_id)) {
                $this->session->set_flashdata('error', 'Username, password, and role are required.');
                redirect('manager/users');
                return;
            }

            // Check if username already exists
            if ($this->User_model->get_user_by_username($username)) {
                $this->session->set_flashdata('error', 'Username already exists.');
                redirect('manager/users');
                return;
            }

            // Create user
            $user_data = array(
                'username' => $username,
                'email' => $email,
                'password' => $password, // Will be hashed in model
                'full_name' => $full_name,
                'is_active' => $is_active
            );

            $user_id = $this->User_model->create_user_with_role($user_data, $role_id);

            if ($user_id) {
                $this->session->set_flashdata('success', 'User created successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to create user.');
            }

            redirect('manager/users');
        }

        // Show add user form
        $data['user'] = $this->session->userdata();
        $data['page_title'] = 'Add New User';
        $data['roles'] = $this->User_model->get_all_roles();
        
        $this->load->view('manager/add_user', $data);
    }

    /**
     * Edit User
     */
    public function edit_user($user_id = null) {
        if (!$user_id) {
            redirect('manager/users');
        }

        $user_details = $this->User_model->get_user_with_role($user_id);
        if (!$user_details) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('manager/users');
        }

        if ($this->input->method() === 'post') {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $full_name = $this->input->post('full_name');
            $role_id = $this->input->post('role_id');
            $is_active = $this->input->post('is_active') ? 1 : 0;
            $new_password = $this->input->post('new_password');

            // Update user data
            $update_data = array(
                'username' => $username,
                'email' => $email,
                'full_name' => $full_name,
                'is_active' => $is_active
            );

            // Add password if provided
            if (!empty($new_password)) {
                $update_data['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            }

            $success = $this->User_model->update_user_with_role($user_id, $update_data, $role_id);

            if ($success) {
                $this->session->set_flashdata('success', 'User updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update user.');
            }

            redirect('manager/users');
        }

        // Show edit form
        $data['user'] = $this->session->userdata();
        $data['page_title'] = 'Edit User';
        $data['edit_user'] = $user_details;
        $data['roles'] = $this->User_model->get_all_roles();
        
        $this->load->view('manager/edit_user', $data);
    }

    /**
     * Delete User
     */
    public function delete_user($user_id = null) {
        if (!$user_id) {
            redirect('manager/users');
        }

        // Prevent deleting current user
        if ($user_id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Cannot delete your own account.');
            redirect('manager/users');
        }

        $success = $this->User_model->delete_user($user_id);

        if ($success) {
            $this->session->set_flashdata('success', 'User deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user.');
        }

        redirect('manager/users');
    }

    /**
     * Toggle User Status (Active/Inactive)
     */
    public function toggle_user_status($user_id = null) {
        if (!$user_id) {
            redirect('manager/users');
        }

        // Prevent deactivating current user
        if ($user_id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Cannot deactivate your own account.');
            redirect('manager/users');
        }

        $success = $this->User_model->toggle_user_status($user_id);

        if ($success) {
            $this->session->set_flashdata('success', 'User status updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update user status.');
        }

        redirect('manager/users');
    }

    private function _check_auth() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    private function _check_role($required_role) {
        if ($this->session->userdata('role') !== $required_role) {
            redirect('auth');
        }
    }
}