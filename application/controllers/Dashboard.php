
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('data'))) {

            $this->load->model('Api_model');
            $data = $this->session->userdata('data');
            if ($data['type'] != 0) {
                redirect(site_url() . 'login');
            }
        } else {
            redirect(site_url() . 'login');
        }
    }

    public function index()
    {
        $data = $this->Api_model->getStat();
        $send = ['data' => $data];
        $this->load->view('dashboard/index',$send);
    }
    public function bikes()
    {
        $data = $this->Api_model->get_bikes();
        $send = ['data' => $data];
        $this->load->view('dashboard/bikes', $send);
    }
    public function trips()
    {
        $this->load->view('dashboard/trips');
    }
    public function track()

    {
        $data = $this->Api_model->routed();
        $send = ['data' => $data];
        $this->load->view('dashboard/track', $send);
    }
    public function new_bike()
    {
        $this->load->view('dashboard/new_bike');
    }
    public function new_trip()
    {
        $data = $this->Api_model->get_specific_bikes(1);
        $send = ['data' => $data];
        $this->load->view('dashboard/new_trip',$send);
    }
    public function users()
    {
        $data = $this->Api_model->getAllUsers();
        $send = ['data' => $data];
        $this->load->view('dashboard/users', $send);
    }
    public function new_user()
    {
        $this->load->view('dashboard/new_user');
    }

}
