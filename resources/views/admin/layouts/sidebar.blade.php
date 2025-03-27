<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <!-- Admin Profile Section -->
        <div class="sidenav-profile p-3 bg-gradient-primary-to-secondary">
            <div class="user-profile d-flex align-items-center mb-3">
                <img class="profile-image rounded-circle"
                    src="{{ auth()->user()->avatar ?? asset('sb-admin/assets/img/illustrations/profiles/profile-1.png') }}"
                    width="50" height="50" />
                <div class="profile-info ms-3 text-white">
                    <div class="profile-name fw-bold">{{ auth()->user()->name ?? 'Admin User' }}</div>
                    <div class="profile-role small">Administrator</div>
                </div>
            </div>
            <div class="profile-status d-flex align-items-center">
                <div class="status-indicator bg-success rounded-circle"></div>
                <div class="status-text text-white-50 small ms-2">Online</div>
            </div>
        </div>

        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Dashboard -->
                <div class="sidenav-menu-heading d-flex align-items-center">
                    <i class="fas fa-home me-1"></i> Menu Utama
                </div>

                <a class="nav-link" href="#">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                    <span class="badge bg-primary-soft text-primary ms-auto">New</span>
                </a>

                <!-- Profil Desa Section -->
                <div class="sidenav-menu-heading d-flex align-items-center">
                    <i class="fas fa-building me-1"></i> Profil Desa
                </div>

                <a class="nav-link {{ request()->is('admin/profil-desa*') ? 'active' : '' }} collapsed"
                    href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseProfilDesa"
                    aria-expanded="false">
                    <div class="nav-link-icon"><i data-feather="grid"></i></div>
                    Data Desa
                    <div class="sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/profil-desa*') ? 'show' : '' }}" id="collapseProfilDesa"
                    data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->is('admin/profil-desa') ? 'active' : '' }}"
                            href="{{ route('profil-desa.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-info-circle"></i></div>
                            Profil Umum
                        </a>
                        <a class="nav-link {{ request()->is('admin/perangkat-desa*') ? 'active' : '' }}"
                            href="{{ route('perangkat-desa.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Perangkat Desa
                        </a>
                        <a class="nav-link {{ request()->is('admin/keuangan*') ? 'active' : '' }}"
                            href="{{ route('keuangan.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-money-bill"></i></div>
                            Keuangan
                        </a>
                    </nav>
                </div>

                <!-- Kelembagaan Section -->
                <a class="nav-link {{ request()->is('admin/kelembagaan*') ? 'active' : '' }} collapsed"
                    href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseKelembagaan"
                    aria-expanded="false">
                    <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                    Kelembagaan
                    <div class="sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/kelembagaan*') ? 'show' : '' }}" id="collapseKelembagaan"
                    data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->is('admin/bumdes*') ? 'active' : '' }}"
                            href="{{ route('bumdes.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-store"></i></div>
                            BUMDES
                        </a>
                        <a class="nav-link {{ request()->is('admin/lpmdk*') ? 'active' : '' }}"
                            href="{{ route('lpmdk.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-people-carry"></i></div>
                            LPMD/LPMK
                        </a>
                        <a class="nav-link {{ request()->is('admin/pkk*') ? 'active' : '' }}"
                            href="{{ route('pkk_desas.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-hand-holding-heart"></i></div>
                            TP PKK
                        </a>
                    </nav>
                </div>

                <!-- Infrastruktur Section -->
                <div class="sidenav-menu-heading d-flex align-items-center">
                    <i class="fas fa-road me-1"></i> Infrastruktur
                </div>

                <a class="nav-link {{ request()->is('admin/infrastruktur*') ? 'active' : '' }} collapsed"
                    href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseInfrastruktur"
                    aria-expanded="false">
                    <div class="nav-link-icon"><i data-feather="layers"></i></div>
                    Data Infrastruktur
                    <div class="sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/infrastruktur*') ? 'show' : '' }}"
                    id="collapseInfrastruktur" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->is('admin/jembatan*') ? 'active' : '' }}"
                            href="{{ route('jembatan.index') }}">
                            <div class="nav-link-icon"><i class="fas fa-archway"></i></div>
                            Jembatan
                        </a>
                    </nav>
                </div>
{{-- 
                <!-- Settings Section -->
                <div class="sidenav-menu-heading d-flex align-items-center">
                    <i class="fas fa-cog me-1"></i> Pengaturan
                </div>

                <a class="nav-link" href="#">
                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                    Pengaturan Sistem
                </a> --}}
            </div>
        </div>

        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content shadow-sm">
                <div class="sidenav-footer-subtitle">Server Status:</div>
                <div class="sidenav-footer-title">
                    <i class="fas fa-circle text-success me-1 small"></i>
                    <span id="serverTime"></span>
                </div>
            </div>
        </div>
    </nav>
</div>

<!-- Add custom styles -->
<style>
    .sidenav {
        background: #f8f9fa;
        border-right: 1px solid rgba(0, 0, 0, .1);
    }

    .sidenav-profile {
        border-bottom: 1px solid rgba(255, 255, 255, .1);
    }

    .status-indicator {
        width: 8px;
        height: 8px;
    }

    .nav-link {
        position: relative;
        padding: 0.75rem 1rem;
        color: #212832;
        display: flex;
        align-items: center;
        transition: all 0.15s ease-in-out;
    }

    .nav-link:hover {
        color: #0061f2;
        background-color: rgba(0, 97, 242, .05);
    }

    .nav-link.active {
        color: #0061f2;
        background-color: rgba(0, 97, 242, .1);
    }

    .nav-link-icon {
        margin-right: 0.5rem;
        color: #a7aeb8;
        transition: all 0.15s ease-in-out;
    }

    .nav-link:hover .nav-link-icon {
        color: #0061f2;
    }

    .nav-link.active .nav-link-icon {
        color: #0061f2;
    }

    .sidenav-menu-heading {
        padding: 1rem;
        font-size: 0.7rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #a7aeb8;
    }

    .sidenav-footer {
        background-color: #fff;
    }

    .sidenav-footer-content {
        padding: 0.75rem;
        font-size: 0.85rem;
    }

    .sidenav-footer-title {
        font-weight: 500;
    }

    .sidenav-footer-subtitle {
        color: #a7aeb8;
        font-size: 0.75rem;
    }

    /* Animation for collapse arrow */
    .sidenav-collapse-arrow {
        transition: transform 0.15s ease;
    }

    .nav-link:not(.collapsed) .sidenav-collapse-arrow {
        transform: rotate(180deg);
    }

    /* Nested nav items styling */
    .sidenav-menu-nested .nav-link {
        padding-left: 2.25rem;
        font-size: 0.9rem;
    }

    /* Badge styling */
    .badge {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 400;
        border-radius: 10rem;
    }
</style>

<!-- Add custom script for server time -->
<script>
    function updateServerTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        document.getElementById('serverTime').textContent = timeString;
    }

    // Update time every second
    setInterval(updateServerTime, 1000);
    updateServerTime(); // Initial call

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>

<!-- Add custom script for sidebar state -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menyimpan state collapse menu ke localStorage
        function saveMenuState(menuId, isOpen) {
            localStorage.setItem('menu_' + menuId, isOpen);
        }

        // Fungsi untuk memuat state collapse menu dari localStorage
        function loadMenuState() {
            const collapseElements = document.querySelectorAll('.collapse');
            collapseElements.forEach(collapse => {
                const menuId = collapse.id;
                const isOpen = localStorage.getItem('menu_' + menuId);
                
                if (isOpen === 'true') {
                    collapse.classList.add('show');
                    const trigger = document.querySelector(`[data-bs-target="#${menuId}"]`);
                    if (trigger) {
                        trigger.classList.remove('collapsed');
                    }
                }
            });
        }

        // Tambahkan event listener untuk setiap collapse menu
        const collapseElements = document.querySelectorAll('.collapse');
        collapseElements.forEach(collapse => {
            collapse.addEventListener('show.bs.collapse', function() {
                saveMenuState(this.id, true);
            });
            
            collapse.addEventListener('hide.bs.collapse', function() {
                saveMenuState(this.id, false);
            });
        });

        // Muat state menu saat halaman dimuat
        loadMenuState();
    });
</script>


