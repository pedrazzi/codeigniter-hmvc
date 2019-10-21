<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Components {

    function card($args){
        $class_card = 'card';
        if ($args['class']['card']) { $class_card .= ' '.$args['class']['card']; }
        $class_body = 'card-body';
        if ($args['class']['body']) { $class_body .= ' '.$args['class']['body']; }
        $header = '';
        if (isset($args['header'])) {
            $header = '<div class="card-header">'.$args['header'].'</div>';
        }        
        $img = '';
        if ($args['img']) {
            $a_i = $args['img'];
            if (is_array($a_i)) {
                if (isset($a_i['a'])) {
                    $a_class = ($a_i['a']['class']) ? ' class="'.$a_i['a']['class'].'"' : '';
                    $a_title = ($a_i['a']['title']) ? ' title="'.$a_i['a']['title'].'"' : '';
                    $img = '<a href="'.$a_i['a']['href'].'"'.$a_class.''.$a_title.'>';
                }
                $i_class = 'card-img-top';
                if ($a_i['img']['class']) { $i_class .= ' '.$a_i['img']['class']; }
                $i_title = '';
                if ($a_i['img']['title']) { $i_title .= ' title="'.$a_i['img']['title'].'"'; }
                $img .= '<img src="'.$a_i['img']['src'].'" class="'.$i_class.'" '.$i_title.' />';
                if (isset($a_i['a'])) { $img .= '</a>'; }
            } else {
               $img = $args['img'];  
            }
        } 
        $title = '';
        if ($args['title']) { $title = '<div class="card-title">'.$args['title'].'</div>'; } 
        $subtitle = '';
        if ($args['subtitle']) { $subtitle = '<div class="card-subtitle">'.$args['subtitle'].'</div>'; } 
        $text = '';
        if ($args['text']) { $text = '<p class="card-text">'.$args['text'].'</p>'; } 
        $footer = '';
        if ($args['footer']) {
            $class_footer = 'card-footer';
            if ($args['class']['footer']) { $class_footer .= ' '.$args['class']['footer']; }
            $footer = '<div class="'.$class_footer.'">'.$args['footer'].'</div>';
        } 
        return '
<div class="'.$class_card.'">
    '.$header.'
    '.$img.'
    <div class="'.$class_body.'">
        '.$title.'
        '.$subtitle.'
        '.$text.'
    </div>
    '.$footer.'
</div>';
    }
 
    function button($args){
        $el = isset($args['el']) ? $args['el'] : 'button';
        $color = isset($args['color']) ? ' btn-'.$args['color'] : ' bg-color';
        if (isset($args['outline'])) { $color = ' btn-outline-'.$args['color']; }
        $size = isset($args['size']) ? ' btn-'.$args['size'] : '';
        $block = isset($args['block']) ? ' btn-block' : '';
        $active = isset($args['active']) ? ' active' : '';
        $disabled = isset($args['disabled']) ? ' disabled' : '';
        $attr = isset($args['attr']) ? $this->attr($args['attr']) : '';
        return '<'.$el.' '.$attr.' class="btn'.$color.$size.$block.$active.'"'.$disabled.'>'.$args['content'].'</'.$el.'>';
    }

    function badge($args){
        $el = isset($args['el']) ? $args['el'] : 'span';
        $pill = isset($args['pill']) ? ' badge-pill' : '';
        $color = isset($args['color']) ? 'badge-'.$args['color'] : 'badge-light';
        $class = isset($args['class']) ? ' '.$args['class'] : '';
        return '<'.$el.' class="badge '.$color.$pill.$class.'">'.$args['content'].'</'.$el.'>';
    }

    function i($fa, $content){
        $content = isset($content) ? ' '.$content : '';
        return '<i class="fa fa-'.$fa.'"></i>'. $content;
    }

    function attr($args) {
        return join(' ', array_map(function($key) use ($args) {
            if(is_bool($args[$key])) { return $args[$key]?$key:''; }
            return $key.'="'.$args[$key].'"';
        }, array_keys($args)));
    }

    function pagination($args) {
        $this->load->library('pagination');
        $config = array(
            'base_url' => $args['url'] || '',
            'cur_page' => $args['page'] || 0,
            'per_page' => $args['limit'] || 10,
            'total_rows' => $args['total'] || 0,
            'num_links' => $args['interval'] || 2
        );

        if ($this->agent->is_mobile()) {
          $config['display_pages'] = false;
          $config['full_tag_open'] = '<ul class="pagination">';
        }

        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
} 
