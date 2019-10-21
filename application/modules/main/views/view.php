<?php
// areas
$local = $data['site'];
$end = $local->end.' - '.$local->cities.'-'.$local->states;
$boas = $local->boasvindas;
$c_areas = '';
foreach ($data['areas'] as $r) {
  $c_areas .= '
  <div class="col-lg-4 col-sm-6 text-center mb-lg-5 mb-3">
  <div class="rounded-circle bg-color shadow-sm icon">
  <i class="fa fa-2x fa-balance-scale"></i>
  </div>
  <a class="h4 text-dark" href="areas/'.$r->lnk.'"><span class="h4">'.$r->name.'</span></a>
  </div>
  ';
}
// equipe
$c_equipe = '';
foreach ($data['equipe'] as $r) {
  $n = $r->name;
  $a_0 = '<a data-toggle="tooltip" data-placement="top" title="'.$n.'" href="equipe/'.$r->lnk.'">';
  $a_1 = '</a>';
  $c_equipe.='
  <div class="col-lg-3 col-md-6 text-center mb-lg-5 mb-3">
  '.$a_0.'
  <avatar class="shadow-sm" size="large" src="assets/uploads/fotos/equipe/'.$r->logo.'"></avatar>
  '.$a_1.'
  <h5 class="card-title font-italic">'.$a_0.$n.$a_1.'</h5>
  <p class="card-text">'.$r->funcao.'</p>
  </div>';
}
// clientes
$c_clientes = '';
foreach ($data['clientes'] as $r) {
  $l = $r->lnk;
  $n = $r->name;
  $a_0 = '';
  $a_1 = '';
  if ($l != '') {
    $a_0 = '<a href="'.$l.'" title="'.$n.'" target="_blank">';
    $a_1 = '</a>';
  }
  $c_clientes.='<div class="col-xs-6 col-md-3">
  '.$a_0.'
  <img alt="'.$n.'" title="'.$n.'" class="img-fluid grayscale" src="assets/uploads/fotos/clientes/'.$r->logo.'" />
  '.$a_1.'
  </div>';
}
// localização
$c_local = '
<gmap class="mb-3" 
  :marker="true" 
  :center="{ lat: '.$local->lat.', lng: '. $local->lng.' }" 
  :info-window="`'.$end.'`" 
  :street="true" 
  :street-options="{
    lat: '. $local->street_lat.', 
    lng: '. $local->street_lng.',
    pov: {
      heading: '. $local->street_heading.',
      pitch: '. $local->street_pitch.',
      zoom: '. $local->street_zoom.'
    }
  }"
>
  <div class="pt-2 px-2">
    <div class="map"></div>
  </div>    
  <div class="pt-2 px-2">
    <div class="street"></div>
  </div>
</gmap> 
';
?>
<div id="app">
  <section class="text-center py-lg-5 py-3 bg-color2 shadow-sm">
    <div class="container py-lg-4 pt-2">
      <div class="boas-vindas">
        <?= $boas?>
      </div>
    </div>
  </section>
  <div class="container mt-lg-5 mt-3">
    <div class="m-lg-4 my-3 mx-1">
      <h1 v-animate="'shake'" class="text-center my-lg-5 my-3 font-italic">Áreas de Atuação</h1>
      <div class="lead text-justify">
        <div class="row d-flex justify-content-center">
          <?=$c_areas?>
        </div>
      </div>
    </div>
  </div>
  <section class="py-lg-5 py-3 bg-color2 text-center shadow-sm">
    <h1 v-animate="'shake'" class="font-italic">Equipe de Profissionais</h1>
    <p class="lead font-italic">Conheça nossa equipe de profissionais</p>
    <article class="mt-lg-5 mt-4 mx-4">
      <div class="row d-flex justify-content-center">
        <?=$c_equipe?>
      </div>
    </article>
  </section>
  <section class="text-center py-lg-5 py-3">
    <h1 v-animate="'shake'" class="text-center font-italic mb-0">Nossos Clientes</h1>
    <p class="lead font-italic">Alguns de nossos clientes</p>
    <article class="m-4 mt-lg-5">
      <div class="row d-flex justify-content-center">
        <?=$c_clientes?>
      </div>
    </article>
  </section>
  <section class="py-lg-5 py-3 bg-color2 shadow-sm">
    <h1 v-animate="'shake'" class="text-center font-italic">Nossa Localização</h1>
    <p class="lead text-center font-italic"><?= $end;?></p>
    <div class="mx-lg-5 my-lg-4 m-2">
      <?=$c_local?>
    </div>
  </section>  
  <section class="my-lg-5 my-3">
    <div class="text-center font-italic">
      <h1 v-animate="'shake'">Contato</h1>
      <div class="lead">Entre em contato conosco através do formulário abaixo.<br>Seu atendimento será registrado e o retornaremos o mais breve possível.</div>
    </div>
    <div class="container mt-lg-5 mt-3">
      <div id="ctrl_contato" v-cloak>
      </div>
    </div>
  </section>
</div>
