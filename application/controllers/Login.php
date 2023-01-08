<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

    }
    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->load->view('login'); 
    }

    public function auth()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->load->model('Login_model');
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $data = $this->Login_model->getUser($email);
            if (!empty($data)) {
                if($data['type']==0){
                    $this->session->set_userdata('data',$data);
                    
                    redirect('dashboard/index');
                }
                else{
                    redirect('biker/index');
                } 
            } else {
                $this->session->set_flashdata('msg', "Incorrect Username or Password");
                $this->load->view('login');

            }
        } else {
            $this->load->view('login');
        }
    }
    public function logout(){
        $this->session->unset_userdata('data');
        redirect('login');
    }
}
