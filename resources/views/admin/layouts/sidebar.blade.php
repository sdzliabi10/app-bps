<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading -->
                <div class="sidenav-menu-heading">Core</div>

                <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse"
                    data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboards
                </a>

                <!-- Sidenav Accordion (Pages) -->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i data-feather="grid"></i></div>
                    Profil Desa
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <a class="nav-link" href="/admin/profil-desa" title="View Profile Desa">Profil Desa</a>
                        <a class="nav-link" href="/admin/perangkat-desa" title="Manage Perangkat Desa">Perangkat
                            Desa</a>
                        <a class="nav-link" href="/admin/keuangan" title="Financial Information">Keuangan</a>
                        <a class="nav-link" href="/admin/bpd" title="View BPD Information">BPD</a>

                        <!-- Nested Accordion Menu -->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                            data-bs-target="#collapseKelembagaan" aria-expanded="false"
                            aria-controls="collapseKelembagaan">
                            Kelembagaan
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseKelembagaan" data-bs-parent="#accordionSidenavPagesMenu">
                            <nav class="sidenav-menu-nested nav accordion">
                                <a class="nav-link" href="account-billing.html">BUMDES</a>
                                <a class="nav-link" href="account-billing.html">LPMD/LPMK</a>
                                <a class="nav-link" href="account-billing.html">TP PKK DESA</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="account-billing.html" title="Infrastruktur">Infrastruktur</a>
                        <a class="nav-link" href="account-billing.html"
                            title="Transparency Information">Transparansi</a>
                        <a class="nav-link" href="account-billing.html" title="Poverty Programs">Program Kemiskinan</a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Sidenav Footer -->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">Valerie Luna</div>
            </div>
        </div>
    </nav>
</div>

<!-- Optional: Add tooltips for better UX -->
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
