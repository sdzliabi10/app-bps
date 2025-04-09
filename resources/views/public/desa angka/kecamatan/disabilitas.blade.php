<div class="bg-gray-50 p-6 rounded-lg shadow-md">
    <!-- Tombol Download Excel -->
    <div class="flex justify-end mb-4">
        <a href="" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
            <i class="fas fa-download mr-2 text-center"></i> Download
        </a>
    </div>
    
    <h3 class="text-xl font-bold mb-4 text-center">Jumlah Penyandang Disabilitas Berdasarkan Desa di Kecamatan {{ $kecamatanName }} - Tahun {{ $tahun }}</h3>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left">No</th>
                    <th class="py-3 px-4 border-b text-left">Desa</th>
                    <th class="py-3 px-4 border-b text-center">Tuna Netra</th>
                    <th class="py-3 px-4 border-b text-center">Tuna Rungu</th>
                    <th class="py-3 px-4 border-b text-center">Tuna Daksa<br>(Tubuh/Fisik)</th>
                    <th class="py-3 px-4 border-b text-center">Retardasi</th>
                    <th class="py-3 px-4 border-b text-center">Rungu Wicara</th>
                    <th class="py-3 px-4 border-b text-center">Tuna Wicara</th>
                    <th class="py-3 px-4 border-b text-center">Tuna Sensorik</th>
                    <th class="py-3 px-4 border-b text-center">Tuna Ganda</th>
                    <th class="py-3 px-4 border-b text-center">Lainnya</th>
                    <th class="py-3 px-4 border-b text-center">Total<br>Disabilitas</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="py-2 px-4 border-b text-left">1</td>
                    <td class="py-2 px-4 border-b text-left">GANJURAN</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">2</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">2</td>
                </tr>
                <!-- Tambahkan baris dusun lainnya di sini -->
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <td class="py-3 px-4 border-b font-semibold text-left" colspan="2">Jumlah</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">2</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">5</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">3</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">1</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">2</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">13</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>