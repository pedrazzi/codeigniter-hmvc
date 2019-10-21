<?php
$nav = '
<li class="nav-item"><a class="nav-link" title="página inicial" href="">Home</a></li>
<li class="nav-item"><a class="nav-link" title="lista de imóveis" href="imoveis">Imóveis</a></li>
<li class="nav-item"><a class="nav-link" title="divulgue seu imóvel" href="divulgar">Divulgar Imóvel</a></li>
<li class="nav-item"><a class="nav-link" title="não achou o imóvel que estava procurando?" href="nao-achei">Não Achei</a></li>
<li class="nav-item"><a class="nav-link" title="alguns de nossos principais parceiros" href="parceiros">Parceiros</a></li>
<li class="nav-item"><a class="nav-link" title="endereço e contato de nossa imobiliária" href="localizacao">Localização</a></li>
<li class="nav-item"><a class="nav-link" title="fale conosco via email" href="contato">Contato</a></li>
<li class="nav-item" @click.stop="openSearch"><span class="nav-link cursor-pointer font-weight-bold" title="pesquisar imóveis">Pesquisar</span></li>
';
?>
<header id="header" class="bg-color" v-cloak>
    <div class="mobile-header d-lg-none">
        <nav class="fixed-top navbar navbar-expand-lg navbar-<?= $site->theme_lightness; ?> bg-color shadow-sm">
            <button class="navbar-toggler btn-xs mr-2" type="button" data-toggle="collapse" data-target="#isMobile" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-text">&nbsp;</span>
            <button @click.stop="openSearch" title="pesquisar imóveis" class="cursor-pointer navbar-toggler"><i class="fa fa-search"></i></button>
            <div class="collapse navbar-collapse" id="isMobile">
                <ul class="navbar-nav">
                    <?= $nav ?>
                </ul>
            </div>
        </nav>
    </div>
    <div class="row top no-gutters align-items-center">
        <div class="col-lg-3 header-img text-lg-left text-center py-2 px-4">
            <a href="" title="página inicial">
                <img class="img-fluid" src="assets/uploads/fotos/configuracoes/<?= $site->logo; ?>" alt="Capa">
            </a>
        </div>
        <div class="col-lg-9 h6 text-lg-right text-center d-none d-lg-block">
            <div class="mt-3 mr-4"><i class="fa fa-lg fa-phone text-bold"></i> <?= $fone; ?></div>
            <div class="d-none d-lg-block d-md-block">
                <nav class="navbar navbar-expand navbar-<?= $site->theme_lightness; ?> bg-color">
                    <ul class="navbar-nav ml-sm-auto">
                        <?= $nav ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>