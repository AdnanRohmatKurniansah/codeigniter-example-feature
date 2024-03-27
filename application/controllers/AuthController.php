<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoggedIn();
    }   

    public function _rules_register()
    {
        $rules = [
            ['field' => 'name', 'label' => 'Name', 'rules' => 'required'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[6]']
        ];

        foreach ($rules as $rule) {
            $this->form_validation->set_rules($rule['field'], $rule['label'], $rule['rules']);
            $this->form_validation->set_message($rule['field']);
        }
    }

    public function _rules_login()
    {
        $rules = [
            ['field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[6]']
        ];

        foreach ($rules as $rule) {
            $this->form_validation->set_rules($rule['field'], $rule['label'], $rule['rules']);
            $this->form_validation->set_message($rule['field']);
        }
    }

    public function login() {
        $this->_rules_login();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login() {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password');

        $user = $this->user_model->find($email);

        if ($user && password_verify($password, $user['password'])) {
            $data = [
                'user_id' => $user['id'], 
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password']
            ];

            $this->session->set_userdata($data);
            $this->session->set_flashdata('success', 'Login successfully');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Login failed');
            redirect('/');
        }
    }

    public function register() 
    {   
        $this->_rules_register();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT)
            ];

            $this->user_model->create($data);
            $this->session->set_flashdata('success', 'Registration successfully');
            redirect('/');
        }
    }
}
