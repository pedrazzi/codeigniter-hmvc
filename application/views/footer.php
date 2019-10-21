<?php
$dt_ini = '2019';
$dt = ($dt_ini != date('Y')) ? $dt_ini . '-' . date('Y') : $dt_ini;
?>
<footer class="footer bg-color text-center text-bold mt-2" id="footer">
    <div class="h-10 bg-color"></div>
    <div class="footer-top py-3">
        <div class="d-none d-sm-block d-sm-none d-md-block">
            <nav class="navbar navbar-expand navbar-<?= $site->theme_lightness; ?>">
                    <ul class="navbar-nav m-auto">
                    <li class="nav-item"><a class="nav-link" title="página inicial" href="">Home</a></li>
                    <li class="nav-item"><a class="nav-link" title="lista de imóveis" href="imoveis">Imóveis</a></li>
                    <li class="nav-item"><a class="nav-link" title="divulgue seu imóvel" href="divulgar">Divulgar Imóvel</a></li>
                    <li class="nav-item"><a class="nav-link" title="não achou o imóvel que estava procurando?" href="nao-achei">Não Achei</a></li>
                    <li class="nav-item"><a class="nav-link" title="endereço e contato de nossa imobiliária" href="localizacao">Localização</a></li>
                    <li class="nav-item"><a class="nav-link" title="fale conosco via email" href="contato">Contato</a></li>
                    <li class="nav-item" @click.stop="openSearch"><span class="nav-link cursor-pointer font-weight-bold" title="pesquisar imóveis">Pesquisar</span></li>
                </ul>
            </nav>
        </div>
        <div><?= $address ?></div>
        <div class="mb-1"><?= $fone ?></div>
        <div class="mb-1">CRECI: <?= $site->creci ?></div>
        <nav class="navbar navbar-expand navbar-<?= $site->theme_lightness; ?>">
            <ul class="navbar-nav m-auto">
                <li class="nav-item" v-for="rede in redes"><a class="nav-link" :href="rede.url" target="_blank"><i :class="rede.ico"></i></a></li>
            </ul>
        </nav>
        <div class="mb-1"><a class="badge badge-light text-dark" title="Todos os direitos reservados" href="http://www.agenciaideias.com.br/">by Agência Ideias | <?= $dt ?></a></div>
        <whatsapp></whatsapp>
        <chatbot></chatbot>
    </div>
</footer>