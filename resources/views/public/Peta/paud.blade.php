<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet MarkerCluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- PAUD Kategori 6 -->
<div id="map-paud" class="w-full h-full relative"></div>

<!-- Modal Box -->
<div id="modalPaud" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-[9999] hidden">
    <div class="bg-white rounded-lg max-w-md w-full p-4 relative z-[10000]">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-2xl font-bold">&times;</button>

        <!-- Gambar -->
        <img id="modalImage" src="/images/placeholder.jpg" alt="Gambar PAUD" class="mx-auto h-48 object-contain rounded mb-4">

        <!-- Tabel -->
        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-2 py-1 text-left">Nama Sekolah PAUD</th>
                    <th class="border px-2 py-1 text-left">Status</th>
                    <th class="border px-2 py-1 text-left">Jumlah Murid</th>
                </tr>
            </thead>
            <tbody id="modalBody">
                <!-- Data PAUD akan dimasukkan di sini -->
            </tbody>
        </table>
    </div>
</div>

@if(isset($desaKoordinat))
<script>
    const selectedKecamatan = '{{ $selectedKecamatan }}';
    const selectedDesa = '{{ $selectedDesa }}';
    const selectedKategori = '{{ $selectedKategori }}';

    const desaKoordinat = JSON.parse('@json($desaKoordinat)');
    const paudList = JSON.parse('@json($paudList)');

    const map = L.map('map-paud').setView([desaKoordinat.lat, desaKoordinat.lng], 12);

    // Base map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);


    const markerCluster = L.markerClusterGroup();

    paudList.forEach(paud => {
        const marker = L.marker([paud.latitude, paud.longitude], {
            icon: L.icon({
                iconUrl: '/icons/paud.ico',
                iconSize: [25, 25]
            })
        });

        marker.on('click', function () {
            openModal(paud);
        });

        markerCluster.addLayer(marker);
    });

    map.addLayer(markerCluster);

    // Modal function (nama_desa dihapus dari tampilan)
    function openModal(paud) {
        document.getElementById('modalPaud').classList.remove('hidden');
        document.getElementById('modalPaud').classList.add('flex');

        document.getElementById('modalImage').src = paud.gambar_url || '/images/placeholder.jpg';

        document.getElementById('modalBody').innerHTML = `
            <tr>
                <td class="border px-2 py-1">${paud.nama_sekolah}</td>
                <td class="border px-2 py-1">${paud.status}</td>
                <td class="border px-2 py-1">${paud.jumlah_murid}</td>
            </tr>
        `;
    }

    function closeModal() {
        document.getElementById('modalPaud').classList.remove('flex');
        document.getElementById('modalPaud').classList.add('hidden');
    }
</script>
@endif
