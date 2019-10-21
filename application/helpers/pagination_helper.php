<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * pagination  
 * @access	public
 * @param	$base_url link base da pagina
 * @param	$cur_page numero pagina atual
 * @param	$total_rows numero total de paginas
 * @param	$num_links numeros de links que serao mostrando antes/depois da pagina atual
 * @return	retorna a paginacao 
 */
if (!function_exists('pagination')) {

  function pagination($base_url, $cur_page, $per_page, $total_rows, $num_links = 2) {
    $CI = & get_instance();
    $CI->load->library('pagination');
    $config = array(
        'base_url' => $base_url,
        'cur_page' => $cur_page,
        'per_page' => $per_page,
        'total_rows' => $total_rows,
        'num_links' => $num_links
    );
    if ($CI->agent->is_mobile()) {
      $config['display_pages'] = false;
      $config['full_tag_open'] = '<ul class="pagination">';
    }

    $config['attributes'] = array('class' => 'page-link');
    $CI->pagination->initialize($config);

    return $CI->pagination->create_links();
  }

}

/**
 * ajax_paginacao  
 * @access  public
 * @param páginas atual
 * @param número total de páginas da pesquisa
 * @param intervalo de números 
 * @param nome da função
 * @return  retorna a paginacao da lista
 */
if (!function_exists('ajax_paginacao')) {

  function ajax_paginacao($pagina_atual, $total_paginas, $intervalo, $funcao = 'pesquisa') {
    if ($total_paginas == 1) {
      return '';
    }
    $out = '';
    $pag_ant = $pagina_atual - 1;
    $pag_pro = $pagina_atual + 1;
    if ($pagina_atual > 1) {
      if ($pagina_atual == 2) {
        $pagLink = '';
      } else {
        $pagLink = $pag_ant;
      }
      $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="' . $funcao . '(' . $pag_ant . ');return false;" title="Página ' . $pag_ant . '">&laquo;</a></li>';
    }
    if ($pagina_atual > ($intervalo + 1)) {
      $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="' . $funcao . '(1);return false;" title="Página 1">1</a></li>';
    }
    if ($pagina_atual > ($intervalo + 2)) {
      $out.= '<li class="page-item active"><div class="page-link">...</div></li>';
    }
    $pmin = ($pagina_atual > $intervalo) ? ($pagina_atual - $intervalo) : 1;
    $pmax = ($pagina_atual < ($total_paginas - $intervalo)) ? ($pagina_atual + $intervalo) : $total_paginas;
    for ($i = $pmin; $i <= $pmax; $i++) {
      if ($i == $pagina_atual) {
        $out.= '<li class="page-item active"><div class="page-link">' . $i . '</div></li>';
      } elseif ($i == 1) {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="' . $funcao . '(' . $i . ');return false;" title="Página ' . $i . '">' . $i . '</a></li>';
      } else {
        $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="' . $funcao . '(' . $i . ');return false;" title="Página ' . $i . '">' . $i . '</a></li>';
      }
    }
    if ($pagina_atual < ($total_paginas - $intervalo - 1)) {
      $out.= '<li class="page-item active"><div class="page-link">...</div></li>';
    }
    if ($pagina_atual < ($total_paginas - $intervalo)) {
      $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="' . $funcao . '(' . $total_paginas . ');return false;" title="Página ' . $total_paginas . '">' . $total_paginas . '</a></li>';
    }
    if ($pagina_atual < $total_paginas) {
      $out.= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="' . $funcao . '(' . $pag_pro . ');return false;" title="Página ' . $pag_pro . '">&raquo;</a></li>';
    }
    return '<ul class="pagination text-white mb-0">' . $out . '</ul>';
  }

}
