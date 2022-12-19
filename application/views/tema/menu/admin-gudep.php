<?php
$menuPotensi = ['pangkalan', 'kwarran', 'gudep'];
?>
<li class="nav-header">
    <b>Data Pangkalan</b>
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
            <a href="<?= site_url('gudep') ?>" class="nav-link <?= $active == 'gudep' ? 'active' : '' ?>"">
                <i class=" icofont-check-circled"></i>
                <p>Gudep</p>
            </a>
        </li>
    </ul>
</li>