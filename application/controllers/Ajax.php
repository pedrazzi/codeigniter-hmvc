<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function index() {
        $req = $_SERVER['REQUEST_METHOD'];
        switch($req){
            case "GET": $input=$this->input->get(); break;
            case "POST": $input=$this->input->post(); break;
            case "PUT": 
            case "DELETE":
                $input = json_decode(file_get_contents('php://input'), true);
                break;
        }
        $model = $input['model'];
        $ex = explode('/',$model);
        if (count($ex)>1) {
            $model = $ex[1].'_model';
            $path = $ex[0].'/'.$model;
        } else {
            $path = $model;
            $model = $model.'_model';
            $path = $path.'/'.$model;
        }
        $action = $input['action'];
        if (isset($input['data'])) {
            $data = $input['data'];
            if ($req === 'POST') { $data = (array) json_decode($data); }
        } 
        else { $data =  ''; }
        $this->load->model($path);
        $this->$model->$action($data);
    }
    
}