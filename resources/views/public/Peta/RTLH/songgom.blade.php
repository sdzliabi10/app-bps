<div id="map-{{ strtolower($selectedKecamatanNama) }}" class="w-full h-full"></div>

<!-- Panggil modal berdasarkan kategori -->
@if($selectedKategori == '1')
    <x-modal-balita/>
@elseif($selectedKategori == '2')
    <x-modal-lansia/>
@elseif($selectedKategori == '3')
    <x-modal-pelakuumkm/>
@elseif($selectedKategori == '4')
    <x-modal-disabilitas/>
@elseif($selectedKategori == '5')
    <x-modal-stunting/>
@elseif($selectedKategori == '7')
    <x-modal-keluargamiskin/>
@endif

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
        const kecamatanId = '{{ strtolower($selectedKecamatanNama) }}';
        const selectedKategori = '{{ $selectedKategori }}';
        const map = L.map(`map-${kecamatanId}`).setView([-7.041108, 108.984497], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    function style(feature) {
        return {
            fillColor: '#3182bd',
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    function highlightFeature(e) {
        const layer = e.target;
        layer.setStyle({
            weight: 3,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.9
        });
        layer.openPopup();
        layer.bringToFront();
    }

    function resetHighlight(e) {
        // Reset ke gaya awal
        e.target.setStyle(style(e.target.feature));
        e.target.closePopup();
    }

    function onEachFeature(feature, layer) {
        layer.bindPopup(`<b>${feature.properties.desa}</b>`);
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: function (e) {
                // Panggil modal yang sesuai berdasarkan kategori
                if (selectedKategori == '1') {
                    showModal(feature); // Untuk RTLH
                } else if (selectedKategori == '2') {
                    showLansiaModal(feature);
                } else if (selectedKategori == '3') {
                    showUmkmModal(feature);
                } else if (selectedKategori == '4') {
                    showDisabilitasModal(feature);
                } else if (selectedKategori == '5') {
                    showStuntingModal(feature);
                } else if (selectedKategori == '7') {
                    showKemiskinanModal(feature);
                }
            }
        });
    }

    // Load beberapa file GeoJSON
    const desaFiles = [
        'songgom.geojson'
        // tambahkan lainnya di sini
    ];

    desaFiles.forEach(filename => {
        fetch(`/geojson/songgom/${filename}`)
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);
            })
            .catch(error => {
                console.error(`Gagal memuat ${filename}:`, error);
            });
    });
</script>
