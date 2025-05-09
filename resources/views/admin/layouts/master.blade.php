<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Dashboard') - SB Admin Pro</title>

    <!-- Link to Styles -->
    <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
    <!-- datatables -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"
        type="text/css" />
    <link rel="icon" type="image/x-icon" href="{{ asset('sb/admin/assets/img/favicon.png') }}" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="nav-fixed">
    <!-- Navbar -->
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a> &middot; <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        function filterDesa() {
            var selectedKecamatan = document.getElementById("kecamatan").value;
            var desaDropdown = document.getElementById("desa");
            var options = desaDropdown.getElementsByTagName("option");

            if (selectedKecamatan === "") {
                desaDropdown.disabled = true;
                for (var i = 0; i < options.length; i++) {
                    options[i].style.display = "none";
                }
            } else {
                desaDropdown.disabled = false;
                var selectedDesa = "{{ request('desa') }}"; // Ambil desa yang sudah difilter
                for (var i = 0; i < options.length; i++) {
                    var kecamatanAttr = options[i].getAttribute("data-kecamatan");

                    if (kecamatanAttr === selectedKecamatan) {
                        options[i].style.display = "";
                        if (options[i].value === selectedDesa) {
                            options[i].selected = true; // Tetap memilih desa yang sudah dipilih sebelumnya
                        }
                    } else {
                        options[i].style.display = "none";
                    }
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            filterDesa();
        });
    </script>

    @yield('scripts')

    <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('sb-admin/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('sb-admin/js/datatables/datatables-simple-demo.js') }}"></script>
</body>

</html>
