<div id="stuntingModal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden items-center justify-center transition-opacity duration-300">
    <div id="stuntingContent" class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md relative transform transition-all duration-300 scale-95 opacity-0">
        <button onclick="closeStuntingModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl leading-none">&times;</button>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Data Stunting Desa</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border border-gray-300 border-collapse rounded-lg">
                <tbody>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600 w-1/2">Nama Desa</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="stuntingDesa">-</td>
                    </tr>
                    <tr class="bg-white">
                        <th class="px-4 py-2 border border-gray-300 font-medium text-gray-600">Jumlah Balita Stunting</th>
                        <td class="px-4 py-2 border border-gray-300 text-gray-800" id="stuntingBalita">0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.showStuntingModal = function(feature) {
        const namaDesa = feature.properties.desa || '-';
        const balitaStunting = feature.properties.balita_stunting || 0;

        document.getElementById('stuntingDesa').textContent = namaDesa;
        document.getElementById('stuntingBalita').textContent = balitaStunting;

        const modal = document.getElementById('stuntingModal');
        const content = document.getElementById('stuntingContent');

        modal.style.display = 'flex';

        setTimeout(() => {
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }, 10);
    };

    function closeStuntingModal() {
        const modal = document.getElementById('stuntingModal');
        const content = document.getElementById('stuntingContent');

        content.classList.remove('opacity-100', 'scale-100');
        content.classList.add('opacity-0', 'scale-95');

        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('stuntingModal');
        if (event.target === modal) {
            closeStuntingModal();
        }
    });
</script>
