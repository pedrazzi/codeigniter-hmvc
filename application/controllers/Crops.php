<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crops extends CI_Controller {

    function index($p, $w, $h, $f) {
        $img = '<img src="' . site_url('assets/uploads/fotos/' . $p . '/' . $f) . '" />';
        echo $img; exit();
        $this->output->set_output($img);
    }

    function fotos($p, $w, $h, $f) {
        $this->load->library('image_moo');
        $img = array('img' => $this->image_moo->load('assets/uploads/fotos/' . $p . '/' . $f)
                ->set_jpeg_quality(100)
                ->resize_crop($w, $h)
                ->save_dynamic());
        $this->load->view('', $img);
        exit();
    }

}
