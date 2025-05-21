<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- MarkerCluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- Peta -->
<div id="map-jembatan" class="w-full h-full relative" style="z-index: 0;"></div>

@include('components.legenda-jembatan')

@include('components.modal-jembatan')

@if(isset($desaKoordinat))
<script>
    const desaKoordinat = JSON.parse('@json($desaKoordinat)');
    const jembatanList = JSON.parse('@json($jembatanPetaList)');

    const baseLayers = {
        'Peta Jalan (OSM)': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }),
        'Peta Satelit (Satelit)': L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri',
            maxZoom: 19
        })
    };

    const map = L.map('map-jembatan', {
        center: [desaKoordinat.lat, desaKoordinat.lng],
        zoom: 14,
        layers: [baseLayers['Peta Jalan (OSM)']]
    });

    L.control.layers(baseLayers).addTo(map);

    const jembatanIcon = L.icon({
        iconUrl: '/icons/jembatan.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        className: 'icon-jembatan'
    });

    const markerCluster = L.markerClusterGroup();

    jembatanList.forEach(jembatan => {
        if (!jembatan.latitude || !jembatan.longitude) return;

        const marker = L.marker([jembatan.latitude, jembatan.longitude], {
            icon: jembatanIcon
        });

        marker.on('click', () => openModal(jembatan));
        markerCluster.addLayer(marker);
    });

    map.addLayer(markerCluster);

    function openModal(jembatan) {
        document.getElementById('modalJembatan').classList.remove('hidden');
        document.getElementById('modalJembatan').classList.add('flex');

        document.getElementById('modalImageJembatan').src = jembatan.gambar || '/images/placeholder.jpg';

        document.getElementById('modalBodyJembatan').innerHTML = `
            <tr>
                <td class="border px-2 py-1">${jembatan.nama}</td>
                <td class="border px-2 py-1">${jembatan.lokasi || '-'}</td>
                <td class="border px-2 py-1">${jembatan.konstruksi || '-'}</td>
                <td class="border px-2 py-1">${jembatan.lebar || '-'} m</td>
                <td class="border px-2 py-1">${jembatan.panjang || '-'} m</td>
                <td class="border px-2 py-1">${jembatan.tahun_dibangun || '-'}</td>
            </tr>
        `;
    }

    function closeModal() {
        document.getElementById('modalJembatan').classList.remove('flex');
        document.getElementById('modalJembatan').classList.add('hidden');
    }

    function toggleLegenda() {
        const box = document.getElementById('legenda-box');
        const icon = document.getElementById('toggle-icon');

        if (box.classList.contains('hidden')) {
            box.classList.remove('hidden');
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            box.classList.add('hidden');
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<style>
    .icon-jembatan {
        filter: brightness(1.1) contrast(1.2);
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