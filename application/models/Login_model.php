<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    public function getUser($email){
        $this->db->where('email',$email);
        $data= $this->db->get('auth')->row_array();
        return $data;
    }
}