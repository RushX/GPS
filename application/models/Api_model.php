<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{

    public function getAllUsers()
    {
        $data = $this->db->get('auth')->result();
        return $data;
    }

    public function get_users()
    {
        $data = $this->db->get('auth')->result();
        return $data;
    }
    public function get_bikes()
    {
        $data = $this->db->get('bikes')->result();
        return $data;
    }
    public function get_specific_bikes($status)
    {
        $data =  $this->db->where('status', $status);
        $data = $this->db->get('bikes')->result();
        return $data;
    }


    public function edit_bike($data)
    {
        $this->db->like('bid', $data['bid']);
        $prevdata  =   $this->db->get('bikes')->row_array();
        $fin_bid = $data['bid'];
        $fin_name = isset($data['bike_name']) ? $data['bike_name'] : $prevdata['bike_name'];
        $fin_bike_gps_number = isset($data['bike_gps_number']) ? $data['bike_gps_number'] : $prevdata['bike_gps_number'];
        $fin_bike_model_number = isset($data['bike_model_number']) ? $data['bike_model_number'] : $prevdata['bike_model_number'];
        $fin_insurance_number = isset($data['insurance_number']) ? $data['insurance_number'] : $prevdata['insurance_number'];
        $fin_registration_number = isset($data['registration_number']) ? $data['registration_number'] : $prevdata['registration_number'];
        $fin_status = isset($data['status']) ? $data['status'] : $prevdata['status'];
        if ($fin_bid != NULL) {
            $this->db->set('bike_name', $fin_name);
            $this->db->set('bike_gps_number', $fin_bike_gps_number);
            $this->db->set('bike_model_number', $fin_bike_model_number);
            $this->db->set('insurance_number', $fin_insurance_number);
            $this->db->set('registration_number', $fin_registration_number);
            $this->db->set('status', $fin_status);
            $this->db->where('bid', $fin_bid);
            $this->db->update('bikes');
            return 0;
        } else {
            return 1;
        }
    }
    public function edit_user($data)
    {
        $this->db->like('uid', $data['uid']);
        $prevdata  =   $this->db->get('auth')->row_array();
        $fin_name = isset($data['name']) ? $data['name'] : $prevdata['uname'];
        $fin_email = isset($data['email']) ? $data['email'] : $prevdata['email'];
        $fin_uid = $data['uid'];
        $fin_bid = isset($data['bid']) ? $data['bid'] : $prevdata['bid'];
        $fin_type = isset($data['type']) ? $data['type'] : $prevdata['type'];
        $fin_password = isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : $prevdata['password'];
        if ($fin_uid != NULL) {
            $this->db->set('uname', $fin_name);
            $this->db->set('email', $fin_email);
            $this->db->set('bid', $fin_bid);
            $this->db->set('type', $fin_type);
            $this->db->set('password', $fin_password);
            $this->db->where('uid', $fin_uid);
            $this->db->update('auth');
            $this->load->model('Api_model');

            if ($fin_bid == '0') {
                $input['bid'] = $prevdata['bid'];
                $input['status'] = '3';
                $this->Api_model->edit_bike($input);
            } else {
                $input['bid'] = $fin_bid;
                $input['status'] = '1';
                $this->Api_model->edit_bike($input);
            }


            return 0;
        } else {
            return 1;
        }
    }

    public function add_user($name, $email, $password, $type)
    {

        $this->db->like('email', $email);
        $query  =   $this->db->get('auth')->result();
        if (empty($query)) {
            $data = array(
                'uid' => time() . mt_srand(10),
                'uname' => $name,
                'email' => $email,
                'bid' => '0',

                'password' => password_hash($password, PASSWORD_DEFAULT),
                'type' => $type
            );
            if ($this->db->insert('auth', $data)) {
                return 0;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }
    public function add_bike($bike_number, $bike_name, $bike_model_number, $insurance_number, $registration_number)
    {
        //status 0->Intransit 1->StandBy 2->Reparing 3->Unallocated 100->Admin
        $this->db->like('bike_gps_number', $bike_number);
        $query  =   $this->db->get('bikes')->result();
        if (empty($query)) {
            $data = array(
                'bid' => time() . mt_srand(10),
                'bike_name' => $bike_name,
                'bike_gps_number' => $bike_number,
                'bike_model_number' => $bike_model_number,
                'insurance_number' => $insurance_number,
                'status' => '3',
                'registration_number' => $registration_number
            );
            if ($this->db->insert('bikes', $data)) {
                return 0;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }


    public function delete_user($uid, $del_bike)
    {

        $this->db->where('uid', $uid);
        $data = $this->db->get('auth')->row_array();
        if ($data != NULL) {

            $this->db->delete('auth', array('uid' => $uid));
            if ($del_bike === 'true') {
                $this->db->where('bid', $data['bid']);
                $bikes = $this->db->get('bikes')->row_array();
                if ($bikes != NULL) {
                    $this->db->delete('bikes', array('bid' => $data['bid']));
                }
                return 2;
            }
            return 0;
        } else {
            return 1;
        }
    }
    public function delete_bike($bid, $del_user)
    {
        $this->db->where('bid', $bid);
        $data = $this->db->get('bikes')->row_array();
        if ($data != NULL) {

            $this->db->delete('bikes', array('bid' => $bid));
            if ($del_user === 'true') {
                $this->db->where('bid', $bid);
                $user = $this->db->get('auth')->row_array();
                if ($user != NULL) {
                    $this->db->delete('auth', array('bid' => $bid));
                    return 0;
                }
                return 2;
            } else {
                $data = array(
                    'bid' => ''
                );

                $this->db->where('bid', $bid);
                $this->db->update('auth', $data);
            }
            return 0;
        } else {
            return 1;
        }
    }

    public function enroute($input)
    {
        $this->db->set('bid', $input['bid']);
        $this->db->set('route', json_encode($input['route']));
        $this->db->insert('geo_data');
        $this->load->model('Api_model');
        return 0;
    }
    public function routed()
    {
        $data = $this->db->get('geo_data')->result();
        return $data;
    }
    public function locate($bid)
    {
        $data =  $this->db->where('bid', $bid);
        $data = $this->db->get('geo_data', 1)->result();
        return $data;
    }
    function getStat()
    {
        $query = $this->db->get('bikes');
        $bikes['all']=$query->num_rows();
        $this->db->where('status', 0);
        $query = $this->db->get('bikes');
        $bikes['intransit']=$query->num_rows();
        $data = $this->db->get('geo_data')->result();
        $bikes['info']=($data);
        $this->db->where('status', 1);
        $query = $this->db->get('bikes');
        $bikes['standby']=$query->num_rows();
        return $bikes;
    }

}
