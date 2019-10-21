<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thumbs extends CI_Controller {

  public function fotos($p, $w, $h, $f) {
    $img = 'assets/uploads/fotos/' . $p . '/' . $f;
    $this->load->library('image_moo');
    $this->load->view('', array('img' => $this->image_moo
                ->load($img)
                ->set_jpeg_quality(100)
                ->resize($w, $h)
                ->save_dynamic()));
    exit();
  }
}
