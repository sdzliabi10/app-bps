<div id="map-{{ strtolower($selectedKecamatanNama) }}" class="w-full h-full relative"></div>

<!-- Tombol toggle legenda -->
<button id="toggle-legend" class="legend-toggle-btn" title="Tampilkan/sembunyikan legenda">
    <i class="fas fa-eye"></i>
</button>

<!-- Modal berdasarkan kategori -->
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

<!-- Leaflet dan Font Awesome -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Style legenda & tombol -->
<style>
    .info.legend {
        background: white;
        padding: 10px;
        font-size: 12px;
        color: #555;
        line-height: 18px;
        border-radius: 5px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }
    .info.legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
    .legend-toggle-btn {
        position: absolute;
        z-index: 1100;
        bottom: 60px;
        left: 10px;
        background-color: #ffffffdd;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 50%;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .legend-toggle-btn:hover {
        background-color: #eee;
    }
    @media (min-width: 769px) {
        .legend-toggle-btn {
            display: none;
        }
    }
    @media (max-width: 768px) {
        .info.legend.hidden {
            display: none !important;
        }
    }
</style>

<script>
    const kecamatanId = '{{ strtolower($selectedKecamatanNama) }}';
    const selectedKategori = '{{ $selectedKategori }}';
    const map = L.map(`map-${kecamatanId}`).setView([-7.0138338, 108.8195012], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    function getColor(jumlah) {
        if (jumlah === null || jumlah === 0) return '#666';
        return jumlah > 100 ? '#e31a1c' :
               jumlah > 75  ? '#fc4e2a' :
               jumlah > 50  ? '#fd8d3c' :
               jumlah > 25  ? '#feb24c' :
               jumlah > 0   ? '#ffeda0' :
                              '#666';
    }

    function style(feature) {
        let jumlah = 0;
        switch (selectedKategori) {
            case '1': jumlah = feature.properties.balita; break;
            case '2': jumlah = feature.properties.lansia; break;
            case '3': jumlah = feature.properties.umkm; break;
            case '4': jumlah = feature.properties.disabilitas; break;
            case '5': jumlah = feature.properties.balita_stunting; break;
            case '7': jumlah = feature.properties.keluarga_miskin; break;
            default: jumlah = 0;
        }

        return {
            fillColor: getColor(jumlah),
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
        e.target.setStyle(style(e.target.feature));
        e.target.closePopup();
    }

    function onEachFeature(feature, layer) {
        layer.bindPopup(`<b>${feature.properties.desa}</b>`);
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: function () {
                if (selectedKategori == '1') showModal(feature);
                else if (selectedKategori == '2') showLansiaModal(feature);
                else if (selectedKategori == '3') showUmkmModal(feature);
                else if (selectedKategori == '4') showDisabilitasModal(feature);
                else if (selectedKategori == '5') showStuntingModal(feature);
                else if (selectedKategori == '7') showKemiskinanModal(feature);
            }
        });
    }

    const legend = L.control({ position: 'bottomright' });

    legend.onAdd = function () {
        const div = L.DomUtil.create('div', 'info legend');
        const grades = [0, 1, 25, 50, 75, 100];
        const labels = [];

        const kategoriLabels = {
            '1': 'Balita',
            '2': 'Lansia',
            '3': 'Pelaku UMKM',
            '4': 'Disabilitas',
            '5': 'Balita Stunting',
            '7': 'Keluarga Miskin'
        };

        const labelNama = kategoriLabels[selectedKategori] || 'Data';
        labels.push(`<i style="background:#666; border: 1px solid #999; border-radius: 50%; width: 15px; height: 15px; display: inline-block; margin-right: 5px"></i> Tidak Ada Data / 0 ${labelNama}`);

        for (let i = 1; i < grades.length; i++) {
            const from = grades[i];
            const to = grades[i + 1];
            const color = getColor(from);
            const labelText = to
                ? `${from} - ${to - 1} ${labelNama}`
                : `${from}+ ${labelNama}`;

            labels.push(`
                <i style="background:${color}; border: 1px solid #999; border-radius: 50%; width: 15px; height: 15px; display: inline-block; margin-right: 5px"></i> 
                ${labelText}
            `);
        }

        div.innerHTML = labels.join('<br>');
        return div;
    };

    legend.addTo(map);

    document.getElementById('toggle-legend').addEventListener('click', function () {
        const legendDiv = document.querySelector('.info.legend');
        legendDiv.classList.toggle('hidden');

        const icon = this.querySelector('i');
        if (legendDiv.classList.contains('hidden')) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });


    if (kecamatanId) {
        fetch(`/geojson/${kecamatanId}/${kecamatanId}.geojson`)
            .then(response => response.json())
            .then(data => {
                const geoJsonLayer = L.geoJSON(data, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);
                
                // Fit bounds ke seluruh kecamatan
                map.fitBounds(geoJsonLayer.getBounds());
            })
            .catch(error => {
                console.error('Gagal memuat GeoJSON:', error);
            });
        }
</script>
