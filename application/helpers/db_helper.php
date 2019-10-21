<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * res_json  
 * @param $arr 
 * @return response de uma array no formato JSON 
 */
if (!function_exists('res_json')) {
    function res_json($arr, $status = '200')
    {
        header('Content-type: application/json');
        $ci = get_instance();
        $ci->output->set_output(json_encode($arr));
        $ci->output->set_status_header($status);
    }
}

if (!function_exists('jsonp_decode')) {
    function jsonp_decode($jsonp, $assoc = false)
    {
        if ($jsonp[0] !== '[' && $jsonp[0] !== '{') {
            $jsonp = substr($jsonp, strpos($jsonp, '('));
        }
        return json_decode(trim($jsonp, '();'), $assoc);
    }
}

/**
 * db_find  
 * @param array com elementos da sql: table, select, where, order
 * @return retorna valor do(s) campo(s)
 */
if (!function_exists('db_find')) {
    function db_find($sql)
    {
        $CI = &get_instance();
        $db = $CI->db;
        $select = isset($sql['select']) ? $sql['select'] : '';
        if ($select) {
            $select = (is_array($select)) ? implode(', ', $select) : $select;
            $db->select($select);
        }
        if (isset($sql['where'])) {
            $db->where($sql['where']);
        }
        if (isset($sql['order'])) {
            $db->order_by($sql['order']);
        }
        $q = $db->get($sql['table']);
        $t = $q->num_rows();
        if ($t > 0) {
            return ($t == 1) ? $q->row() : $q->result();
            //return $q->result();
            //      $r = $q->result();
            //      if (is_array($select)) { return $r[0]; } 
            //      else { return $r[0]->$select; }
        } else {
            return '';
        }
    }
}
if (!function_exists('db_foto_capa')) {
    function db_foto_capa($table, $id, $sem_capa = 'semfoto.gif')
    {
        $CI = &get_instance();
        $q = $CI->db->select('img')->where(array($table . '_id' => $id, 'status' => 1))->get($table . '_img')->row();
        $r = ($q) ? $q->img : $sem_capa;
        return $r;
    }
}

if (!function_exists('db_moeda')) {
    function db_moeda($value, $tipo = 'get')
    {
        if ($tipo === 'get') {
            $value = number_format($value, 2, ',', '.');
        } else {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }
        return $value;
    }
}

if (!function_exists('db_count')) {
    function db_count($table, $where = '')
    {
        $CI = &get_instance();
        if ($where) {
            $q = $CI->db->where($where)->get($table);
        } else {
            $q = $CI->db->get($table);
        }
        return $q->num_rows();
    }
}

if (!function_exists('site')) {
    function site($select = '*')
    {
        $CI = &get_instance();
        return $CI->db->select($select)->get('site')->row();
    }
}

if (!function_exists('db_sum')) {
    function db_sum($table, $field, $where, $value = 1)
    {
        $total = db_find(array('table' => $table, 'select' => $field, 'where' => $where))->views;
        $CI = &get_instance();
        $CI->db->update($table, array($field => ($total + $value)), $where);
        return ($total);
    }
}
/**
 * db_pesquisa_campos  
 * @access	public
 * @param	$selects da tabela - array("campo1", "campo2")
 * @param	$query - palavra chave
 * @param	$tipo_de_busca - "QUALQUER PALAVRA", "TODAS PALAVRAS", "FRASE"
 * @depend      retira_acentos() MY_text_helper.php
 * @return	retorna os $selects de pesquisa formatados conforme o $tipo_de_busca
 */
/*
if (!function_exists('db_pesquisa_campos')) {
  function db_pesquisa_campos($selects, $query, $tipo_busca = 'QUALQUER PALAVRA') {
    $CI = &get_instance();
    $CI->load->helper('text');
    // Define o total de campos da tabela 
    $total_campos = sizeof($selects);
    $query = retira_acentos(utf8_decode($query));
    $selects_busca = "";
    if ($tipo_busca === "FRASE") {
      for ($i = 0; $i < $total_campos; $i++) {
        $selects_busca = $selects_busca . $selects[$i] . " LIKE '%" . $query . "%'";
        if ($i < $total_campos - 1) { $selects_busca = $selects_busca . " OR "; }
      }
    } else {
      if ($tipo_busca === "TODAS PALAVRAS") { $expr = " AND "; } 
      else if ($tipo_busca === "QUALQUER PALAVRA") { $expr = " OR "; }
      $aa = 0;
      $ponteiro = 1;
      $palavras = array();
      while ($ponteiro > 0) {
        $tamanho_frase = strlen($query);
        $ponteiro = strpos($query, " ");
        if ($ponteiro > 0) { $palavras[$aa] = substr($query, 0, $ponteiro); } 
        else { $palavras[$aa] = substr($query, 0, $tamanho_frase); }
        $query = substr($query, $ponteiro + 1, $tamanho_frase - $ponteiro);
        $aa++;
      }
      for ($i = 0; $i < $total_campos; $i++) {
        for ($j = 0; $j < $aa; $j++) {
          $selects_busca = $selects_busca . $selects[$i] . " LIKE '%" . $palavras[$j] . "%'";
          if ($j < $aa - 1) { $selects_busca = $selects_busca . $expr; }
        }
        if ($i < $total_campos - 1) { $selects_busca = $selects_busca . " OR "; }
      }
    }
    return $selects_busca;
  }
}
*/

if (!function_exists('db_data')) {
    function db_data($data, $tipo = 'get')
    {
        if ($tipo === 'get') {
            $explode = '-';
            $return = '/';
        } else {
            $explode = '/';
            $return = '-';
        }
        $data = explode($explode, $data);
        return $data[2] . $return . $data[1] . $return . $data[0];
    }
}

if (!function_exists('db_foto_total')) {
    function db_foto_total($tab, $id)
    {
        $CI = &get_instance();
        return $CI->db->query("SELECT * FROM " . $tab . "_img WHERE " . $tab . "_id = '$id'")->num_rows();
    }
}

/*

if (!function_exists('db_gera_id')) {
  function db_gera_id($tamanho = 11, $maiusculas = true, $numeros = true, $simbolos = false) {
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;
    if ($maiusculas) { $caracteres .= $lmai; }
    if ($numeros) { $caracteres .= $num; }
    if ($simbolos) { $caracteres .= $simb; }
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) { $rand = mt_rand(1, $len); $retorno .= $caracteres[$rand - 1]; }
    return $retorno;
  }
}

if (!function_exists('data_extenso')) {
  function data_extenso($data = false, $semana = true) {
    if ($data) { $mes = date('m', strtotime($data)); } 
    else { $mes = date('m'); $data = date('Y-m-d'); }
    $meses = array(
        '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Mar�o', '04' => 'Abril',
        '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto',
        '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'
    );
    $dias = array(
        0 => 'Domingo', 1 => 'Segunda-feira', 2 => 'Ter�a-feira',
        3 => 'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'S�bado'
    );
    if ($semana) { return utf8_encode($dias[date('w', strtotime($data))] . ', ' . date('d', strtotime($data)) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime($data))); } 
    else { return utf8_encode(date('d', strtotime($data)) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime($data))); }
  }
}

*/

/*
if (!function_exists('db_reconnect')) {
  function db_reconnect() { $CI = & get_instance(); if ($CI->db->conn_id->ping() === FALSE) { $CI->db->reconnect(); } }
}

if (!function_exists('db_active')) {
  function db_active($s, $db = 'default' ) { $CI = & get_instance(); if ($s === 'on') { $CI->load->database($db, true); } else if ($s === 'off') { $CI->load->database($db, false); } }
}

*/
if (!function_exists('db_create_table')) {
    function db_create_table($table, $fields, $key = array('id'))
    {
        $CI = &get_instance();
        $CI->load->dbforge();
        $CI->dbforge->add_field($fields);
        foreach ($key as $i => $v) {
            $CI->dbforge->add_key($v, TRUE);
        }
        $CI->dbforge->create_table($table, TRUE, array('ENGINE' => 'InnoDB'));
    }
}
if (!function_exists('db_foreign_key')) {
    function db_foreign_key($table, $parent, $key = 'id')
    {
        $CI = &get_instance();
        //$CI->load->dbforge();
        $query = "ALTER TABLE `" . $table . "` 
ADD INDEX `fk_" . $table . "_" . $parent . "_" . $key . "_" . $key . "x_" . $key . "x` (`" . $parent . "_" . $key . "` ASC);
ALTER TABLE `" . $table . "` 
ADD CONSTRAINT `fk_" . $table . "_" . $parent . "_" . $key . "_" . $key . "x`
  FOREIGN KEY (`" . $parent . "_" . $key . "`)
  REFERENCES `" . $parent . "` (`" . $key . "`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;";
        //    $CI->db->query("ALTER TABLE `".$table."` ADD FOREIGN KEY(`".$key."`) REFERENCES `".$parent."` (`".$table."_".$key."`) ON DELETE CASCADE;");
        //      $CI->db->query($query);
        //$CI->db->query("ALTER TABLE `".$table."` ADD FOREIGN KEY(`".$table."_".$key."`) REFERENCES '".$parent."'(`".$key."`) ON DELETE CASCADE;");

        /*
$query = "ALTER TABLE `".$table."` 
ADD INDEX `fk_".$table."_".$parent."_".$key."_".$key."x_".$key."x` (`".$parent."_".$key."` ASC);
ALTER TABLE `".$table."` 
ADD CONSTRAINT `fk_".$table."_".$parent."_".$key."_".$key."x`
  FOREIGN KEY (`".$parent."_".$key."`)
  REFERENCES `".$parent."` (`".$key."`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;";
*/
    }
}
