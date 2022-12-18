<?php
$menuPotensi = ['pangkalan', 'kwarran', 'gudep'];
$menuAdmin = ['admin_gudep'];
?>
<li class="nav-header">
    <b>Master Data</b>
</li>
<li class="nav-item <?= in_array($active, $menuPotensi, true) ? 'menu-open' : '' ?>">
    <a href="#" class="nav-link <?= in_array($active, $menuPotensi, true) ? 'active' : '' ?>">
        <i class="nav-icon icofont-bulb-alt"></i>
        <p>
            Potensi
            <i class="right icofont-rounded-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= site_url('pangkalan') ?>" class="nav-link <?= $active == 'pangkalan' ? 'active' : '' ?>">
                <i class="icofont-check-circled"></i>
                <p>Pangkalan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('gudep') ?>" class="nav-link <?= $active == 'gudep' ? 'active' : '' ?>"">
                <i class=" icofont-check-circled"></i>
                <p>Gudep</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-header">
    <b>Master Admin</b>
</li>
<li class="nav-item <?= in_array($active, $menuAdmin, true) ? 'menu-open' : '' ?>">
    <a href="#" class="nav-link <?= in_array($active, $menuAdmin, true) ? 'active' : '' ?>">
        <i class="nav-icon icofont-gears"></i>
        <p>
            Kelola Admin
            <i class="right icofont-rounded-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= site_url('admin/admingudep') ?>" class="nav-link <?= $active == 'admin_gudep' ? 'active' : '' ?>">
                <i class="icofont-user-alt-2"></i>
                <p>Admin Gudep</p>
            </a>
        </li>
    </ul>
</li>