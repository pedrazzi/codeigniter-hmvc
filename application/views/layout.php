<?php
defined('BASEPATH') or exit('No direct script access allowed');

$site = site();
$site->bot = $this->db->get('chatbot')->row();
unset($site->email);
if (($_SERVER['SERVER_NAME'] !== 'localhost')) {
	if ($site->google_analytics) {
		$analytics = '<script>(function (i, s, o, g, r, a, m) { i["GoogleAnalyticsObject"] = r; i[r] = i[r] || function () { (i[r].q = i[r].q || []).push(arguments) }, i[r].l = 1 * new Date(); a = s.createElement(o), m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m) })(window, document, "script", "//www.google-analytics.com/analytics.js", "ga"); ga("create", "' . $site->google_analytics . ' ", "auto"); ga("require", "displayfeatures"); ga("require", "linkid", "linkid.js"); ga("send", "pageview");</script>';
	}
	$lib = 'lib';
} else {
	$analytics = '';
	$lib = 'lib.dev';
}
unset($site->google_analytics);
unset($site->tweet_consumer_key);
unset($site->tweet_consumer_secret);
unset($site->tweet_token);
unset($site->tweet_token_secret);
unset($site->chatbot);
$local = $site->city . '-' . $site->state;
$site_name = $site->name . ' - ' . $local;
$title = isset($title) ? "$title - $site_name" : $site_name;
$description = isset($description) ? $description : '';
$keywords = isset($keywords) ? $keywords : '';
$image = isset($image) ? $image . '?' . cach : '';
$js = isset($js) ? load_js($js) : '';
$module = isset($module) ? load_module($module) : '';
$css = isset($css) ? load_css($css) : '';
// header
$address = $site->end . ', ' . $local;
$fone = $site->fone;
$what = $site->whatsapp;
$fone_header = $fone;
$fone_footer = '<i class="fa fa-phone"></i> ' . $fone;
if ($what) {
	$fone_footer .= ' / <i class="fa fa-whatsapp"></i> ' . $what;
}

$header = $this->load->view('header', array('site' => $site, 'fone' => $fone_header, 'address' => $address), TRUE);

// footer
$footer = $this->load->view('footer', array(
	'site' => $site,
	'fone' => $fone_footer,
	'address' => $address
), TRUE);
// redes
$q = $this->db->select('rede,url')->order_by('order ASC')->get('redes');
$redes = array();
while ($r = $q->unbuffered_row()) {
	$redes[] = array(
		'url' => $r->url,
		'ico' => 'fa fa-lg fa-' . $r->rede,
		'cl' => $r->rede
	);
}
$redes[] = array('name' => 'Contato', 'url' => 'contato', 'ico' => 'fa fa-lg fa-envelope-o', 'cl' => 'envelope');
$search = $this->load->view('search', array('site' => $site), TRUE);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="www.agenciaideias.com.br" />
	<meta name="description" content="<?= $description ?>" />
	<meta name="keywords" content="<?= $keywords ?>" />
	<meta name="copyright" content="Copyright Agência Ideias. Todos os direitos reservados." />
	<meta name="robots" content="index,follow" />
	<meta name="theme-color" content="#4285f4" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:title" content="<?= $title ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:description" content="<?= $description ?>" />
	<meta property="og:image" content="<?= $image ?>" />
	<meta property="og:url" content="<?= current_url() ?>" />
	<meta property="og:site_name" content="<?= $site_name ?>" />
	<base href="<?= base_url() ?>">
	<link type="text/css" rel="stylesheet" href="assets/dependencies/css/lib.css?<?= cach ?>" />
	<link type="text/css" rel="stylesheet" href="assets/styles/front.css?<?= cach ?>" />
	<?= $css ?>
	<style id="css">
		body {
			background: url(assets/uploads/fotos/bg/<?= $site->bg; ?>) repeat scroll center center transparent;
		}

		.bg-color,
		.badge-color,
		.btn-color {
			background-color: #<?= $site->theme_bg;
								?> !important;
			color: #<?= $site->theme_text;
					?>;
		}

		.border-color {
			border: 1px solid #<?= $site->theme_bg;
								?>;
		}

		.text-color {
			color: #<?= $site->theme_bg;
					?> !important;
		}

		.bg-color2,
		.badge-color2,
		.btn-color2 {
			background-color: #<?= $site->theme_bg2;
								?> !important;
			color: #<?= $site->theme_text2;
					?>;
		}

		.border-color2 {
			border: 1px solid #<?= $site->theme_bg2;
								?>;
		}

		.text-color2 {
			color: #<?= $site->theme_bg2;
					?> !important;
		}

		.bg-color2 a,
		a.badge-color2 {
			color: #<?= $site->theme_text2;
					?>
		}

		.bg-color a,
		a.badge-color {
			color: #<?= $site->theme_text;
					?>
		}

		.bg-color a,
		a.badge-color,
		.bg-color2 a,
		a.badge-color2 {
			opacity: 0.75;
		}

		a.bg-color:hover,
		.badge-color,
		.bg-color2 a:hover,
		a.badge-color2:hover {
			opacity: 1;
		}
	</style>
	<script src="assets/dependencies/js/<?= $lib ?>.js?<?= cach ?>"></script>
	<script src="assets/dependencies/js/_.js?<?= cach ?>"></script>
	<script>
		const redes = <?= json_encode($redes) ?>,
			site = <?= json_encode($site) ?>
	</script>
	<script type="module" src="assets/js/controllers/layout.js?<?= cach ?>"></script>
	<?= $analytics ?>
	<link rel="canonical" href="<?= current_url() ?>">
	<link sizes="16x16" href="assets/images/favicon.ico?<?= cach ?>" rel="shortcut icon" type="image/x-icon" />
</head>

<body>
	<div class="body-wrapper">
		<?= $header ?>
		<?= $contents ?>
		<?= $footer ?>
		<?= $search ?>
		<?= $js ?>
		<?= $module ?>
	</div>
</body>

</html>