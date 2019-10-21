<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	function index()
	{
		$this->load->model('main_model');
		$site = site();
		$local = 'em ' . $site->cities . '-' . $site->states;
		$this->template->load('layout', 'view', array(
			'description' => "Encontre advogados e escritórios de advocacia $local, ",
			'keywords' => "advogados, escritório de advocacia, $local",
			'js' => array('https://maps.googleapis.com/maps/api/js?key=AIzaSyCj9S60m0T0hQ-BrXImBza5Ksm9W7YIrKA&libraries=places'),
			'module' => array('pages/main/index.js'),
			'data' => array(
				'site' => $site,
				'areas' => $this->main_model->areas(),
				'equipe' => $this->main_model->equipe(),
				'clientes' => $this->main_model->clientes()
			)
		));
	}

}
