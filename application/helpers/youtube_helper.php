<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 *  youtube_id
 * @access	public
 * @param	link do youtube
 * @return	retorna o id do vídeo do youtube
 */
if (!function_exists('youtube_id')) {

  function youtube_id($lnk) {
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $lnk, $matches);
    return $matches[1];
  }

}


/**
 *  youtube_video - Player do Youtube - Responsive (Bootstrap)
 * @access	public
 * @param	link do youtube
 * @param	width, height, autoplay, widescreen, theme, start, retorna_link
 * @return	retorna vídeo do youtube conforme o link
 */
if (!function_exists('youtube_video')) {

  function youtube_video($lnk, $opcoes = '') {
    $id = youtube_id($lnk);

    $defaults = array(
        'width' => '800px', // largura
        'heigh' => '600px', // altura
        'autoplay' => FALSE, // play automático se TRUE
        'widescreen' => FALSE, // tela widescreen se TRUE
        'theme' => 'dark', // cor do tema (dark ou light)
        'start' => 0,
        'retorna_link' => FALSE // retorna o link com o player
    );

    $op = (!is_array($opcoes)) ? $defaults : array_merge($defaults, $opcoes);

    if ($op['retorna_link']) {

      return 'http://www.youtube.com/v/' . $id . '&fs=1&color1=0x2b405b&color2=0x6b8ab6&hd=1&version=3&feature=player_embedded&enablejsapi=1&playerapiid=player1';
    } else {

      $widescreen = ($op['widescreen']) ? '16by9' : '4by3';
      $autoplay = ($op['autoplay']) ? 1 : 0;

      return '
<div class="embed-responsive embed-responsive-' . $widescreen . '">        
        <iframe 
          class="embed-responsive-item" 
          width="' . $op['width'] . '" 
          height="' . $op['heigh'] . '" 
          src="http://www.youtube.com/embed/' . $id . '?autoplay=' . $autoplay . '&theme=' . $op['theme'] . '&start=' . $op['start'] . '">
        </iframe>
</div>';
    }
  }

}

/**
 * youtube_thumbnail - Thumbnail do Youtube
 * @access	public
 * @param	link do youtube
 * @return	retorna o link da imagem conforme o link do vídeo do youtube 
 */
if (!function_exists('youtube_thumbnail')) {

  function youtube_thumbnail($lnk, $resol = '') {
    $id = youtube_id($lnk);
    if ($resol) {
      return 'http://img.youtube.com/vi/' . $id . '/' . $resol . '.jpg';
    }  
    $resolucoes = array(
        'maxresdefault', // maximum - a resolução depende a qualidade do vídeo
        'sddefault', // standard 640x480
        'hqdefault', // high 480x360
        'mqdefault', // medium 320x180
        'default'  // default 120x90
    );
    foreach ($resolucoes as $r) {
      $url = 'http://img.youtube.com/vi/' . $id . '/' . $r . '.jpg';
      $get = get_headers($url);
      if ($get[0] === 'HTTP/1.0 200 OK') {
        break;
      }
    }
    return $url;
  }

}

/* End of file youtube_helper.php */
/* Location: ./application/helpers/youtube_helper.php */