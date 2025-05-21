<!-- resources/views/components/modal-keluargamiskin.blade.php -->
<div id="kemiskinanModal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden items-center justify-center transition-opacity duration-300">
    <div id="kemiskinanContent" class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md relative transform transition-all duration-300 scale-95 opacity-0">
        <button onclick="closeKemiskinanModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl leading-none">&times;</button>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Data Keluarga Miskin Desa</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border border-gray-300 border-collapse rounded-lg">
                <tbody>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600 w-1/2">Nama Desa</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="kemiskinanDesa">-</td>
                    </tr>
                    <tr class="bg-white">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600">Total Keluarga</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="kemiskinanTotalKeluarga">0</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600">Keluarga Miskin</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="kemiskinanJumlah">0</td>
                    </tr>
                    <tr class="bg-white">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600">Persentase</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="kemiskinanPersentase">0%</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600">Tahun Data</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="kemiskinanTahun">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Fungsi global untuk menampilkan modal keluarga miskin
    window.showKemiskinanModal = function(feature) {
        const namaDesa = feature.properties.desa || '-';
        const totalKeluarga = feature.properties.total_keluarga || 0;
        const keluargaMiskin = feature.properties.keluarga_miskin || 0;
        const tahunData = feature.properties.tahun_data || '-';
        const persentase = totalKeluarga > 0 ? ((keluargaMiskin / totalKeluarga) * 100).toFixed(2) + '%' : '0%';

        document.getElementById('kemiskinanDesa').textContent = namaDesa;
        document.getElementById('kemiskinanTotalKeluarga').textContent = totalKeluarga;
        document.getElementById('kemiskinanJumlah').textContent = keluargaMiskin;
        document.getElementById('kemiskinanPersentase').textContent = persentase;
        document.getElementById('kemiskinanTahun').textContent = tahunData;

        const modal = document.getElementById('kemiskinanModal');
        const content = document.getElementById('kemiskinanContent');

        modal.style.display = 'flex';

        setTimeout(() => {
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }, 10);
    };

    function closeKemiskinanModal() {
        const modal = document.getElementById('kemiskinanModal');
        const content = document.getElementById('kemiskinanContent');

        content.classList.remove('opacity-100', 'scale-100');
        content.classList.add('opacity-0', 'scale-95');

        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('kemiskinanModal');
        if (event.target === modal) {
            closeKemiskinanModal();
        }
    });
</script>