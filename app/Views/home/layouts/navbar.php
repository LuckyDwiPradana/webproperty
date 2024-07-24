<?php
$active = $active ?? ''; // Menggunakan nilai default kosong jika $active belum didefinisikan
?>
<nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar" id="probootstrap-navbar">
    <div class="container">
        <a href="<?= base_url() ?>" class="logo-link <?= (isset($active) && $active === 'home/index') ? 'active' : ''; ?>">
            <div>
                <img class="foto" src="<?= base_url('temp/assets/images/logdark.png') ?>" width="130px" style="margin: 0px; padding: 0px; color: white;">
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-menu"
            aria-controls="probootstrap-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-menu">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= (isset($active) && $active === 'home/index') ? 'active' : ''; ?>">
                <a class="nav-link " href="<?= base_url() ?>">Beranda</a>
            </li>               
             <li class="nav-item <?= (isset($active) && $active === 'home/properties') ? 'active' : ''; ?>"><a class="nav-link " href="<?= base_url() ?>home/properties">Properti</a>
                </li>
                <li class="nav-item <?= (isset($active) && $active === 'home/agents') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url() ?>home/agents">Agen</a>
                </li>
                <li class="nav-item <?= (isset($active) && $active === 'home/kpr') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url() ?>home/kpr">KPR</a>
                </li>
                <li class="nav-item <?= (isset($active) && $active === 'home/info') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url() ?>home/info">Informasi</a>
                </li>
                <li class="nav-item <?= ($active === 'login') ? 'active' : ''; ?>"> <a class="nav-link" href="<?= base_url('login') ?>">Masuk</a>
                </li>
            </ul>
    </div>
    </div>
</nav>