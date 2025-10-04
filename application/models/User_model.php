<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Authenticate user login
     */
    public function authenticate($username, $password) {
        $this->db->select('u.*, r.name as role_name, r.display_name as role_display_name');
        $this->db->from('users u');
        $this->db->join('user_roles ur', 'u.id = ur.user_id');
        $this->db->join('roles r', 'ur.role_id = r.id');
        $this->db->where('u.username', $username);
        $this->db->where('u.is_active', 1);
        
        $query = $this->db->get();
        $user = $query->row();
        
        if ($user && password_verify($password, $user->password)) {
            // Update last login
            $this->update_last_login($user->id);
            return $user;
        }
        
        return FALSE;
    }

    /**
     * Get user by username
     */
    public function get_user_by_username($username) {
        $this->db->select('u.*, r.name as role_name, r.display_name as role_display_name');
        $this->db->from('users u');
        $this->db->join('user_roles ur', 'u.id = ur.user_id');
        $this->db->join('roles r', 'ur.role_id = r.id');
        $this->db->where('u.username', $username);
        $this->db->where('u.is_active', 1);
        
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Check if user has specific role
     */
    public function has_role($user_id, $role_name) {
        $this->db->select('1');
        $this->db->from('users u');
        $this->db->join('user_roles ur', 'u.id = ur.user_id');
        $this->db->join('roles r', 'ur.role_id = r.id');
        $this->db->where('u.id', $user_id);
        $this->db->where('r.name', $role_name);
        
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    /**
     * Update last login timestamp
     */
    public function update_last_login($user_id) {
        $data = array(
            'last_login' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    /**
     * Create new user
     */
    public function create_user($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['created_at'] = date('Y-m-d H:i:s');
        
        return $this->db->insert('users', $data);
    }

    /**
     * Get all roles
     */
    public function get_all_roles() {
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->order_by('name', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get all users with their roles
     */
    public function get_all_users_with_roles() {
        $this->db->select('u.*, r.name as role_name, r.display_name as role_display_name, r.id as role_id');
        $this->db->from('users u');
        $this->db->join('user_roles ur', 'u.id = ur.user_id');
        $this->db->join('roles r', 'ur.role_id = r.id');
        $this->db->order_by('u.created_at', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get user with role by ID
     */
    public function get_user_with_role($user_id) {
        $this->db->select('u.*, r.name as role_name, r.display_name as role_display_name, r.id as role_id');
        $this->db->from('users u');
        $this->db->join('user_roles ur', 'u.id = ur.user_id');
        $this->db->join('roles r', 'ur.role_id = r.id');
        $this->db->where('u.id', $user_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Create user with role
     */
    public function create_user_with_role($user_data, $role_id) {
        $this->db->trans_start();
        
        // Hash password
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);
        $user_data['created_at'] = date('Y-m-d H:i:s');
        
        // Insert user
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();
        
        // Assign role
        $role_data = array(
            'user_id' => $user_id,
            'role_id' => $role_id
        );
        $this->db->insert('user_roles', $role_data);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status() ? $user_id : FALSE;
    }

    /**
     * Update user with role
     */
    public function update_user_with_role($user_id, $user_data, $role_id) {
        $this->db->trans_start();
        
        // Update user data
        $user_data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $user_id);
        $this->db->update('users', $user_data);
        
        // Update role
        $this->db->where('user_id', $user_id);
        $this->db->update('user_roles', array('role_id' => $role_id));
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    /**
     * Delete user and role associations
     */
    public function delete_user($user_id) {
        $this->db->trans_start();
        
        // Delete role associations
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_roles');
        
        // Delete user
        $this->db->where('id', $user_id);
        $this->db->delete('users');
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    /**
     * Toggle user active status
     */
    public function toggle_user_status($user_id) {
        $this->db->select('is_active');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        $user = $query->row();
        
        if ($user) {
            $new_status = $user->is_active ? 0 : 1;
            $data = array(
                'is_active' => $new_status,
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            $this->db->where('id', $user_id);
            return $this->db->update('users', $data);
        }
        
        return FALSE;
    }
}