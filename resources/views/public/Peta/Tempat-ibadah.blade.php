<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet MarkerCluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- Container Peta -->
<div id="map-tempat-ibadah" class="w-full h-full relative" style="z-index: 0;"></div>

@include('components.legendapeta-ibadah')


@include('components.modal-ibadah')
@if(isset($desaKoordinat))
<script>
    const desaKoordinat = JSON.parse('@json($desaKoordinat)');
    const tempatIbadahList = JSON.parse('@json($tempatIbadahList ?? [])');

    // 2. Base Maps (Normal + Satelit)
    const baseLayers = {
        'Peta Jalan (OSM)': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }),

        'Peta Satelit (Satelit)': L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye',
            maxZoom: 19
        })
    };

    // Inisialisasi peta dengan base layer default
    const map = L.map('map-tempat-ibadah', {
        center: [desaKoordinat.lat, desaKoordinat.lng],
        zoom: 14,
        layers: [baseLayers['Peta Jalan (OSM)']]
    });

    // Tambahkan kontrol untuk memilih layer
    L.control.layers(baseLayers).addTo(map);


    // 3. Kustom Icon Berdasarkan Agama (Sudah Implementasi)
    const iconConfig = {
        islam: {
            iconUrl: '/icons/masjid.png',
            className: 'icon-masjid'
        },
        kristen: {
            iconUrl: '/icons/gereja.png',
            className: 'icon-gereja'
        },
        katolik: {
            iconUrl: '/icons/gereja.png',
            className: 'icon-gereja'
        },
        hindu: {
            iconUrl: '/icons/pura.png',
            className: 'icon-pura'
        },
        buddha: {
            iconUrl: '/icons/vihara.png',
            className: 'icon-vihara'
        },
        konghucu: {
            iconUrl: '/icons/kelenteng.png',
            className: 'icon-kelenteng'
        },
    };

    function getCustomIcon(agama) {
        const agamaKey = agama?.toLowerCase() || 'default';
        const config = iconConfig[agamaKey] || iconConfig.default;

        return L.icon({
            iconUrl: config.iconUrl,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            className: config.className
        });
    }

    // 4. Marker Cluster
    const markerCluster = L.markerClusterGroup();

    // 5. Tambahkan Marker dengan Icon Spesifik
    tempatIbadahList.forEach(ibadah => {
        if (!ibadah.latitude || !ibadah.longitude) return;

        const marker = L.marker(
            [ibadah.latitude, ibadah.longitude], {
                icon: getCustomIcon(ibadah.agama) // <- Icon berbeda per agama
            }
        )

        marker.on('click', () => openModal(ibadah));
        markerCluster.addLayer(marker);
    });

    map.addLayer(markerCluster);

    // 6. Fungsi Modal (Sudah ganti kapasitas -> alamat)
    function openModal(ibadah) {
        document.getElementById('modalTempatIbadah').classList.remove('hidden');
        document.getElementById('modalTempatIbadah').classList.add('flex');

        document.getElementById('modalImageIbadah').src = ibadah.gambar || '/images/placeholder.jpg';

        document.getElementById('modalBodyIbadah').innerHTML = `
            <tr>
                <td class="border px-2 py-1">${ibadah.nama}</td>
                <td class="border px-2 py-1">${ibadah.agama}</td>
                <td class="border px-2 py-1">${ibadah.alamat || '-'}</td>
                <td class="border px-2 py-1">${ibadah.tahun_berdiri || '-'}</td>
            </tr>
        `;
    }

    function closeModal() {
        document.getElementById('modalTempatIbadah').classList.remove('flex');
        document.getElementById('modalTempatIbadah').classList.add('hidden');
    }

        // 7. Fungsi Toggle Legenda (khusus mobile)
        function toggleLegenda() {
        const box = document.getElementById('legenda-box');
        const icon = document.getElementById('toggle-icon');

        if (box.classList.contains('hidden')) {
            box.classList.remove('hidden');
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            box.classList.add('hidden');
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // 8. Inisialisasi Jumlah Marker
    document.addEventListener("DOMContentLoaded", function () {
        const totalCount = tempatIbadahList.length;
        const totalElement = document.getElementById('total-marker-count');
        if (totalElement) totalElement.textContent = totalCount;
    });
</script>

<style>
    /* Style khusus untuk icon */
    .icon-masjid {
        filter: hue-rotate(0deg) saturate(1.5);
    }

    .icon-gereja {
        filter: hue-rotate(200deg);
    }

    .icon-pura {
        filter: hue-rotate(40deg);
    }

    .leaflet-marker-icon {
        transition: transform 0.2s;
    }

    .leaflet-marker-icon:hover {
        transform: scale(1.2);
        z-index: 1000 !important;
    }
</style>
@endif