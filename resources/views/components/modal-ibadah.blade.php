<!-- Modal Tempat Ibadah -->
<div id="modalTempatIbadah" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-[9999] hidden">
    <div class="bg-white rounded-lg max-w-md w-full p-4 relative z-[10000]">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-2xl font-bold">&times;</button>

        <!-- Gambar -->
        <img id="modalImageIbadah" src="" alt="Gambar Tempat Ibadah" class="w-full h-48 object-cover rounded-lg mb-4">

        <!-- Info -->
        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-2 py-1 text-left">Nama</th>
                    <th class="border px-2 py-1 text-left">Agama</th>
                    <th class="border px-2 py-1 text-left">Alamat</th>
                    <th class="border px-2 py-1 text-left">Tahun Berdiri</th>
                </tr>
            </thead>
            <tbody id="modalBodyIbadah"></tbody>
        </table>
    </div>
</div>