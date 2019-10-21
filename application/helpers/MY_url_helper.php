<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Current URL
 *
 * Returns the full URL (including segments) of the page where this
 * function is placed
 *
 * @access  public
 * @return  string
 */
if (!function_exists('current_url')) {
    function current_url() { $CI = & get_instance(); $lnk = $CI->config->site_url($CI->uri->uri_string()); $lnk = str_replace('/' . index_page(), '', $lnk); return $lnk; }
}

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access  public
 * @param string
 * @return  string
 */
if (!function_exists('site_url')) {
    function site_url($uri = '') { $CI = & get_instance(); return str_replace('/' . index_page(), '', $CI->config->site_url($uri)); }
}

/**
 * Create URL Title
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 *
 * @access  public
 * @param string  the string
 * @param string  the separator: dash, or underscore
 * @return  string
 */
if (!function_exists('url_title')) {

  function url_title($str, $separator = 'dash', $lowercase = TRUE) {
    if ($separator == 'dash') { $search = '_'; $replace = '-'; } 
    else { $search = '-'; $replace = '_'; }
    $str = str_replace(" ","-",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim(utf8_encode($str)))));
    $str = str_replace("/","-",$str);
    $trans = array(
        '&\#\d+?;' => '',
        '&\S+?;' => '',
        '\s+' => $replace,
        '[^a-z0-9\-\._]' => '',
        $replace . '+' => $replace,
        $replace . '$' => $replace,
        '^' . $replace => $replace,
        '\.+$' => ''
    );
    $str = strip_tags($str);
    foreach ($trans as $key => $val) { $str = preg_replace("#" . $key . "#i", $val, $str); }
    if ($lowercase === TRUE) { $str = strtolower($str); }
    return trim(stripslashes($str));
  }
}

/**
 * url_amigavel 
 * cria url amigável  
 * @access  public
 * @param $nome - string
 * @param $tabela 
 * @param $campo referente a url 
 * @param $id id do registro 
 * @return  uma URL Amigável
 */
if (!function_exists('url_amigavel')) {
    function url_amigavel($n, $table, $select, $id = '') {
        $checa = db_find(array(
                'select' => $select,
                'where' => array($select => $n, 'id !=' => $id),
                'table' => $table)
        );
        //print_r(array($select => $n, 'id !=' => $id));
        //print_r($checa); exit();
        $n = ($checa) ? $n . '-' . substr(md5(uniqid(time())), 0, 2) : $n;
        return url_title(utf8_decode($n));
    }
}

/**
 * url
 * @access  public
 * @param url 
 * @param post parâmetros de envio
 * @param tempo
 * @return  retorna dados da requisição
 */
if (!function_exists('url')) {
  function url($url, $post = NULL, $txt = NULL, $headers = NULL) {
    $ch = curl_init($url);
    if ($post) {
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $https = explode('https', $url);
    if ($https > 0) { curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);}
    if ($txt) {
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_COOKIEFILE, "inpi.txt");
    }
    if ($headers) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    $agents = array(
        'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2',
        'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
        'Mozilla/4.08 (compatible; MSIE 6.0; Windows NT 5.1)',
        'Googlebot/2.1 (+http://www.google.com/bot.html)',
        'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
        'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
        'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A'
    );
    curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

}

/**
 * url_encurtador  
 * @access  public
 * @param url
 * @return  retorna a url encurtada
 */
if (!function_exists('url_encurtador')) {
  function url_encurtador($l) {
    $ch = curl_init();
    $timeout = 30;
    curl_setopt($ch, CURLOPT_URL, 'http://po.st/api/shorten/?apiKey=D1D1B55C-8A0F-43D0-818A-F46F931A11DC&format=txt&longUrl=' . urlencode(stripslashes(urldecode($l))));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
  }
}