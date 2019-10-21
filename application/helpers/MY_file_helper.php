<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('fileCreate')) {
  function dirCreate($path){ 
    if(!is_dir($path)) { mkdir($path,0755,TRUE); } 
  }
}

if (!function_exists('fileCreate')) {

    function fileCreate($path,$arq, $code = ""){ 
        dirCreate($path);
        $p_a =  $path.'\\'.$arq;
        if (write_file($p_a, $code)){ return $p_a; }
    }
}