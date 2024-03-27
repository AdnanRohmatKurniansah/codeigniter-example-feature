<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }

    public function isLoggedIn() {
        if (!$this->CI->session->userdata('user_id')) {
            redirect('/');
        }
    }
}
