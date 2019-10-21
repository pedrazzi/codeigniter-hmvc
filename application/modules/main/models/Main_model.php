<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Main_model extends CI_Model {

  function areas(){
    return $this->db->where(array("status" => 1))->order_by("order ASC")->get("areas")->result();
  }

  function equipe() {
    return $this->db->select('name, logo, funcao, lnk')->order_by('order')->where('status = "1"')->get('equipe')->result();
  }

  function clientes() {
    return $this->db->select('name, lnk,logo')->order_by('order')->get('clientes')->result();
  }

}