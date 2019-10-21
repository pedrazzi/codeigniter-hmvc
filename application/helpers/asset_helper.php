<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('load_js')) {

  function load_js($js, $async = '') {
    if (!is_array($js)) { return false; } 
    $return = '';
    foreach ($js as $j) {
      $file = (filter_var($j, FILTER_VALIDATE_URL)) ? $j : 'assets/js/' . $j.'?' . cach;
      $async = (!$async) ? ' async defer' : '';
      $return .= '  <script type="text/javascript" id="'.$file.'" src="' . $file .  '"></script>' . "\n";
    }
    return $return;
  }

}

if (!function_exists('load_module')) {

  function load_module($js) {
    if (!is_array($js)) { return false; } 
    $return = '';
    foreach ($js as $j) {
      $file = (filter_var($j, FILTER_VALIDATE_URL)) ? $j : 'assets/js/' . $j.'?' . cach;
      $return .= '  <script type="module" id="'.$file.'" src="' . $file .  '"></script>' . "\n";
    }
    return $return;
  }

}

if (!function_exists('load_css')) {

  function load_css($css) {
    if (!is_array($css)) { return false; }
    $return = '';
    foreach ($css as $i) {
      $file = (filter_var($i, FILTER_VALIDATE_URL)) ? $i : 'assets/styles/' . $i.'?' . cach;
      $return .= '  <link type="text/css" rel="stylesheet" id="'.$file.'" href="' . $file . '?' . cach . '" />
      ';
    }
   return $return;
  }

}

if ( ! function_exists('insert_js')) {
  /**
   * Insert script Javascript
   *
   * Returns the javascript script insertion.
   *
   * @param script
   * @return   
   */
  function insert_js($script) {
      $js = <<<EOF
{$script};  
EOF;
    return "<script type='text/javascript' charset='utf-8'>".$js."</script>";
    exit();
  }
}
