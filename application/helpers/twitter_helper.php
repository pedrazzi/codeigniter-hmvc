<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('twitter_config')) {

  function twitter_config() {
    $r = site('tweet_consumer_key, tweet_consumer_secret, tweet_token, tweet_token_secret');
    return array(
      'consumer_key'=> $r->tweet_consumer_key,
      'consumer_secret'=> $r->tweet_consumer_secret,
      'token'=> $r->tweet_token,
      'token_secret'=> $r->tweet_token_secret,
    );
  }

}

/**
 * twitter_post  
 * @access  public
 * @param   $msg
 * @param   $link
 * @return  retorna status do post no twitter
 */
if (!function_exists('twitter_post')) {

  function twitter_post($msg, $lnk = '') {
    $twitter = site('tweet_consumer_key, tweet_consumer_secret, tweet_token, tweet_token_secret');
    $CI = &get_instance();
    $msg = (strlen($msg) > 240) ? substr($msg, 0, 240) : $msg;
    if ($lnk) { $msg.=' 
    ' . url_encurtador($lnk); 
    }
    require_once('application/libraries/TwitterOAuth.php');
    $conn = new TwitterOAuth($twitter->tweet_consumer_key, $twitter->tweet_consumer_secret, $twitter->tweet_token, $twitter->tweet_token_secret);
    $status = $conn->post('statuses/update', array('status' => $msg));
    return $status;
  }

}


if (!function_exists('twitter_ico')) {

  function twitter_ico($ico) {
        //https://apps.timwhitlock.info/emoji/tables/unicode
    $icos = array(
      ','=> '&#x25AA;',
      '0'=> '&#x0030;&#x20E3;',
      '1'=> '&#x0031;&#x20E3;',
      '2'=> '&#x0032;&#x20E3;',
      '3'=> '&#x0033;&#x20E3;',
      '4'=> '&#x0034;&#x20E3;',
      '5'=> '&#x0035;&#x20E3;',
      '6'=> '&#x0036;&#x20E3;',
      '7'=> '&#x0037;&#x20E3;',
      '8'=> '&#x0038;&#x20E3;', 
      '9'=> '&#x0039;&#x20E3;', 
      'cancel'=> '&#x1F6AB;',
      'fogos'=> '&#x1F386;',
      'trofeu'=> '&#x1F3C6;',
      'explose'=> '&#x1F4A5;',
      'news'=> '&#x1F4F0;',
      'indicador'=> '&#x1f447;',
      'flag-us'=> '&#x1F1FA;&#x1F1F8;',
      'flag-es'=> '&#x1F1EA;&#x1F1F8;',
      'flag-fr'=> '&#x1F1EB;&#x1F1F7;',
      'flag-it'=> '&#x1F1EE;&#x1F1F9;',
      'flag-gb'=> '&#x1F1EC;&#x1F1E7;',
            'flag-de'=> '&#x1F1E9;&#x1F1EA;',//
            'flag-eu'=> '&#x1F1EA;&#x1F1FA;', // uniao européia
            'flag-au'=> '&#x1F1E6;&#x1F1FA;', // australia
            'flag-uk'=> '&#x1F1EC;&#x1F1E7;',
            'flag-ca'=> '&#x1F1E8;&#x1F1E6;',
            'flag-br'=> '&#x1F1E7;&#x1F1F7;',//
            'ok' => '&#x1F44C;',
            'lampada' => '&#x1F4A1;',
            'faca' => '&#x1F52A;',
            'calendar' => '&#x1F4C6;',
            'trevo' => '&#x1F340;',
            'caca-niquel' => '&#x1F3B0;',
            'bola8' => '&#x1F3B1;',
            'dado' => '&#x1F3B2;',
            'dinheiro' => '&#x1F4B0;',
            'check' => '&#x2705;',
            'fish' => '&#x1F41F;',
            'sapo' => '&#x1F438;',
            'sol' => '&#x1F31E;',
            'lua' => '&#x1F31C;',
            'terra' => '&#x1F30D;',
            'nuvem' => '&#x2601;',
            'chuva' => '&#x2614;',
            'arvore' => '&#x1F332;',
            'fogo' => '&#x1F525;',
            'estrela' => '&#x2B50;',
            'arco-iris' => '&#x1F308;',
            'seta-baixo' => '&#x2B07;'
          );
    if (is_array($ico)) {
      $r = '';
      foreach ($ico as $v) { $r .= html_entity_decode($icos[$v], 0, 'UTF-8'); }
      return $r;
    }
    else { return html_entity_decode($icos[$ico], 0, 'UTF-8');  }
  }

}

if (!function_exists('twitter_ico_number')) {

  function twitter_ico_number($vr) {
    $str = str_split($vr);
    $valor = '';
    foreach ($str as $v) {
      if (is_numeric($v)) {
        $valor .= twitter_ico($v);
      } else {
        $valor .= $v;
      }
    }
    return $valor;
  }

}

if (!function_exists('dia_tag')) {

  function dia_tag($dia) {
    $dia = dataQtosDias($dia);
    if ($dia === 'hoje' || $dia === 'amanhã'){ $dia = "#$dia"; }
    return $dia;
  }

}