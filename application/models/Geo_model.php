<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Geo_model extends CI_Model
{
    public function get_latest_data($bid)
    {
        $this->db->like('bid', $bid);
        $getroute  =   $this->db->get('geo_data')->row_array();
        $route=json_decode($getroute['route']);
        return $route['destination']['latitude'];

     }

    public function  start(){

    }
    public function set_latest_data($bid)
    {
        $this->db->set('lat', $lat);
        $this->db->set('long', $long);
        $this->db->where('bid',$bid);
        $this->db->update('bikes');
    }
} 
