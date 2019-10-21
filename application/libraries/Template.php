<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//http://jeromejaglale.com/doc/php/codeigniter_template
class Template {

    var $template_data = array();

    function set($name, $value) {
        if (!is_array($name)) {
            $this->template_data[$name] = $value;
        } else {
            foreach($name as $k => $v) {
                $this->template_data[$k] = $v;
            }
        }
    }
       
    function load($template = 'layout', $view = '' , $view_data = array(), $return = FALSE) {               
        $CI =& get_instance();
        $this->set('contents', $CI->load->view($view, $view_data, TRUE));     
        return $CI->load->view($template, $this->template_data, $return);
    }

}