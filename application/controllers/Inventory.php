<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_auth();
        $this->_check_role('inventory_operator');
    }

    public function dashboard() {
        $data['user'] = $this->session->userdata();
        $data['page_title'] = 'Inventory Dashboard';
        $this->load->view('inventory/dashboard', $data);
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