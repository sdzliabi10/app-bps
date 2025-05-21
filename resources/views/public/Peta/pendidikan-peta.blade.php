<!-- Leaflet & MarkerCluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- Peta -->
<div id="map-pendidikan" class="w-full h-full relative" style="z-index: 0;"></div>
@include('components.legenda-pendidikan')
@include('components.modal-pendidikan')


@if(isset($desaKoordinat))
<script>
    const desaKoordinat = JSON.parse('@json($desaKoordinat)');
    const sekolahList = JSON.parse('@json($sekolahPetaList)');

    const baseLayers = {
        'Peta Jalan': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }),
        'Peta Satelit': L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri',
            maxZoom: 19
        })
    };

    const map = L.map('map-pendidikan', {
        center: [desaKoordinat.lat, desaKoordinat.lng],
        zoom: 13,
        layers: [baseLayers['Peta Jalan']]
    });

    L.control.layers(baseLayers).addTo(map);

    const sekolahIcon = L.icon({
        iconUrl: '/icons/sekolah.ico',
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        className: 'icon-sekolah'
    });

    const markerCluster = L.markerClusterGroup();

    sekolahList.forEach(sekolah => {
        if (!sekolah.latitude || !sekolah.longitude) return;

        const marker = L.marker([sekolah.latitude, sekolah.longitude], {
            icon: sekolahIcon
        });

        marker.on('click', () => openModal(sekolah));
        markerCluster.addLayer(marker);
    });

    map.addLayer(markerCluster);

    function openModal(sekolah) {
        document.getElementById('modalPendidikan').classList.remove('hidden');
        document.getElementById('modalPendidikan').classList.add('flex');

        document.getElementById('modalImagePendidikan').src = sekolah.gambar || '/images/placeholder.jpg';

        document.getElementById('modalBodyPendidikan').innerHTML = `
  <tr>
            <td class="border px-2 py-1">${sekolah.nama_sekolah}</td>
            <td class="border px-2 py-1">${sekolah.jenjang || '-'}</td>
            <td class="border px-2 py-1">${sekolah.alamat || '-'}</td>
            <td class="border px-2 py-1">${sekolah.tahun_berdiri || '-'}</td>
            <td class="border px-2 py-1">${sekolah.status || '-'}</td>
            <td class="border px-2 py-1">${sekolah.jumlah_murid || '-'}</td>
            <td class="border px-2 py-1">${sekolah.jumlah_guru || '-'}</td>
        </tr>
        `;
    }

    function closeModal() {
        document.getElementById('modalPendidikan').classList.remove('flex');
        document.getElementById('modalPendidikan').classList.add('hidden');
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
    .icon-sekolah {
        filter: brightness(1.1) contrast(1.1);
    }

    .leaflet-marker-icon:hover {
        transform: scale(1.2);
        z-index: 1000 !important;
    }
</style>
@endif