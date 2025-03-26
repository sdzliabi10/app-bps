{{-- resources/views/public/kecamatan/warga-rumah.blade.php --}}
<div class="bg-gray-50 p-6 rounded-lg shadow-md">
    <!-- Tombol Download Excel -->
    <div class="flex justify-end mb-4">
        <a href="" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
            <i class="fas fa-download mr-2"></i> Download Excel
        </a>
    </div>
    
    <h3 class="text-xl font-bold mb-4 text-center">Jumlah Warga, Rumah dan Rumah Tidak Layak Huni Berdasarkan Desa di {{ request('kecamatan') }} - {{ request('tahun') }}</h3>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left" rowspan="2">No</th>
                    <th class="py-3 px-4 border-b text-left" rowspan="2">Dusun</th>
                    <th class="py-3 px-4 border-b text-center" colspan="3">Perumahan</th>
                    <th class="py-3 px-4 border-b text-center" colspan="2">Perkampungan</th>
                    <th class="py-3 px-4 border-b text-center" colspan="2">Jumlah</th>
                    <th class="py-3 px-4 border-b text-center" rowspan="2">RTLH</th>
                </tr>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-center">Jumlah Perumahan</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Rumah</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Warga</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Rumah</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Warga</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Rumah</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Warga</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="py-2 px-4 border-b text-left">1</td>
                    <td class="py-2 px-4 border-b text-left">KARANG SARI</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">160</td>
                    <td class="py-2 px-4 border-b text-center">615</td>
                    <td class="py-2 px-4 border-b text-center">160</td>
                    <td class="py-2 px-4 border-b text-center">615</td>
                    <td class="py-2 px-4 border-b text-center">12</td>
                </tr>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="py-2 px-4 border-b text-left">2</td>
                    <td class="py-2 px-4 border-b text-left">SELOREJO 1</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">155</td>
                    <td class="py-2 px-4 border-b text-center">617</td>
                    <td class="py-2 px-4 border-b text-center">155</td>
                    <td class="py-2 px-4 border-b text-center">617</td>
                    <td class="py-2 px-4 border-b text-center">4</td>
                </tr>
                <!-- Tambahkan baris lainnya sesuai data -->
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <td class="py-3 px-4 border-b font-semibold text-left" colspan="2">Jumlah</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">881</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">3527</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">881</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">3527</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">54</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>