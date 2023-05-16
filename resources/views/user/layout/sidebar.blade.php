<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo" style="width: 100%; height: 100%">
                <img src="{{ asset('assets/img/logo12.png') }}" alt="?">
            </span>
            <!--<span class="app-brand-text demo menu-text fw-bolder ms-2">IF-Admin</span>-->
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Pasien</span>
        </li>

        <li class="menu-item @if ($menu == 'home') active @endif">
            <a href="/user-area" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-user-account'></i>
                Appointment
            </a>
        </li>
        <li class="menu-item">
            <a href="/user-area/transaksi" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-user-account'></i>
                Transaksi
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->