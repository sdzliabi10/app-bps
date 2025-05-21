<!-- Modal Pendidikan -->
<div id="modalPendidikan" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-[9999] hidden p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto relative z-[10000]">
        <!-- Tombol Close -->
        <button onclick="closeModal()" class="sticky top-2 right-2 ml-auto bg-white rounded-full w-8 h-8 flex items-center justify-center text-gray-600 hover:text-red-500 text-2xl font-bold shadow-md">
            &times;
        </button>

        <div class="p-4 md:p-6">
            <!-- Gambar -->
            <div class="flex justify-center mb-4">
                <img id="modalImagePendidikan" src="/images/placeholder.jpg" alt="Foto Sekolah"
                    class="max-w-full h-auto max-h-64 md:max-h-80 object-cover rounded-lg">
            </div>

            <!-- Tabel Info -->
            <div class="overflow-x-auto">
                <table class="w-full border text-sm md:text-base">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-2 py-1 text-left">Nama Sekolah</th>
                            <th class="border px-2 py-1 text-left">Jenjang</th>
                            <th class="border px-2 py-1 text-left">Alamat</th>
                            <th class="border px-2 py-1 text-left">Tahun Berdiri</th>
                            <th class="border px-2 py-1 text-left">Status</th>
                            <th class="border px-2 py-1 text-left">Jumlah Murid</th>
                            <th class="border px-2 py-1 text-left">Jumlah Guru</th>
                        </tr>
                    </thead>
                    <tbody id="modalBodyPendidikan">
                        <!-- Diisi lewat JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>