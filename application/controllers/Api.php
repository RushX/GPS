<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->library('session');
        if (!empty($this->session->userdata('data'))) {
            $data = $this->session->userdata('data');

            if ($data['type'] != 0) {
                echo "UNAUTHORIZED";
                die;
            }
        } else {
            echo "UNAUTHORIZED";
            die;
        }
    }
    public function index()
    {
        echo "Unauthorized";
    }

    public function get($param)
    {

        if ($param === 'users') {
            $data = $this->Api_model->get_users();
        } elseif ($param === 'bikes') {
            $data = $this->Api_model->get_bikes();
        } elseif ($param === 'intransit') {
            $data = $this->Api_model->get_specific_bikes(0);
        } elseif ($param === 'standby') {
            $data = $this->Api_model->get_specific_bikes(1);
        } elseif ($param === 'reparing') {
            $data = $this->Api_model->get_specific_bikes(2);
        } elseif ($param === 'unallocated') {
            $data = $this->Api_model->get_specific_bikes(3);
        } else {
            echo "Method Undefined";
        }
        echo json_encode(array('status' => "1", "success" => true, 'data' => $data));
    }



    public function enroute()
    {
        $data['bid'] = $this->input->post('bid');
        $data['route']['source']['latitude'] = $this->input->post('source_latitude');
        $data['route']['source']['longitude'] = $this->input->post('source_longitude');
        $data['route']['source']['address'] = $this->input->post('source_address');
        $data['route']['destination']['latitude'] = $this->input->post('destination_latitude');
        $data['route']['destination']['longitude'] = $this->input->post('destinaion_longitude');
        $data['route']['destination']['address'] = $this->input->post('destinaion_address');
        $data = $this->Api_model->enroute($data);
        if (isset($data)) {

            if ($data == 0) {
                echo json_encode(array("status" => 0, "success" => true));
            } elseif (!empty($data)) {
                if ($data == 1) {
                    echo json_encode(array("status" => 1, "success" => false, "message" => "Entry already exist in the database"));
                } else {
                    echo json_encode(array("status" => 2, "success" => false, "message" => "User Id Required"));
                }
            }
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Incomplete Info Provided"));
        }

    }
    public function edit($param)
    {
        if ($param === 'user') {
            $input['uid'] = $this->input->post('uid');
            $input['name'] = $this->input->post('name');
            $input['email'] = $this->input->post('email');
            $input['bid'] = $this->input->post('bid');
            $input['password'] = $this->input->post('password');
            $input['type'] = $this->input->post('type');
            $input['status'] = $this->input->post('status');
            $data = $this->Api_model->edit_user($input);
        } elseif ($param === 'bike') {

            $input['bid'] = $this->input->post('bike_uid'); ///PENDING UPDATE
            $input['bike_gps_number'] = $this->input->post('bike_gps_number'); ///PENDING UPDATE
            $input['bike_name'] = $this->input->post('bike_name');
            $input['status'] = $this->input->post('status');
            $input['bike_model_number'] = $this->input->post('bike_model_number');
            $input['insurance_number'] = $this->input->post('insurance_number');
            $input['registration_number'] = $this->input->post('registration_number');
            $data = $this->Api_model->edit_bike($input);
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Method Undefined"));
            die;
        }
        if (isset($data)) {

            if ($data == 0) {
                echo json_encode(array("status" => 0, "success" => true));
            } elseif (!empty($data)) {
                if ($data == 1) {
                    echo json_encode(array("status" => 1, "success" => false, "message" => "User Id Required"));
                } else {
                    echo json_encode(array("status" => 2, "success" => false, "message" => "Failed to execute the query"));
                }
            }
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Incomplete Info Provided"));
        }

        die;
    }
    public function add($param)
    {

        if ($param === 'user') {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $type = $this->input->post('type');
            $data = $this->Api_model->add_user($name, $email, $password, $type);
        } elseif ($param === 'bike') {
            $number = $this->input->post('bike_gps_number');
            $name = $this->input->post('bike_name');
            $model_no = $this->input->post('bike_model_number');
            $insurance_number = $this->input->post('insurance_number');
            $rc_arr = $this->input->post('registration_number');
            $data = $this->Api_model->add_bike($number, $name, $model_no, $insurance_number, $rc_arr);
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Method Undefined"));
            die;
        }
        if (isset($data)) {

            if ($data == 0) {
                echo json_encode(array("status" => 0, "success" => true));
            } elseif (!empty($data)) {
                if ($data == 1) {
                    echo json_encode(array("status" => 1, "success" => false, "message" => "Data Already Present in the database"));
                } else {
                    echo json_encode(array("status" => 2, "success" => false, "message" => "Failed to execute the query"));
                }
            }
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Incomplete Info Provided"));
        }

        die;
    }
    public function delete($param)
    {
        if ($param === 'user') {
            $uid = $this->input->post('uid');
            $del_bike = $this->input->post('del_bike');

            $data = $this->Api_model->delete_user($uid, $del_bike);
        } elseif ($param === 'bike') {
            $bid = $this->input->post('bid');
            $del_user = $this->input->post('del_user');
            $data = $this->Api_model->delete_bike($bid, $del_user);
        } else {
            echo "Method Undefined";
        }
        if (isset($data)) {

            if ($data == 0) {
                echo json_encode(array("status" => 0, "success" => true));
            } elseif (!empty($data)) {
                if ($data == 1) {
                    echo json_encode(array("status" => 1, "success" => false, "message" => "No records Found"));
                }
            } else {
                echo json_encode(array("status" => 2, "success" => false, "message" => "No Accociated Bike Found for the User"));
            }
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Incomplete Info Provided"));
        }

        die;
    }

    public function geo($param)
    {
        if ($param == "get") {
            $bid = $this->input->post('bid');
            $data = $this->Api_model->get_geo_data($bid);
            echo json_encode($data);
        }
    }

    public function locate(){
        $bid = $this->input->post('bid');
        $data = $this->Api_model->locate($bid);
        if (isset($data)) {
                echo json_encode(array("status" => 0, "success" => true,"data"=>($data)));
        } else {
            echo json_encode(array("status" => 3, "success" => false, "message" => "Incomplete Info Provided"));
        }
    }
}
