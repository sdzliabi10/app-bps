{{-- resources/views/public/kecamatan/tempat-tinggal.blade.php --}}
<div class="bg-gray-50 p-6 rounded-lg shadow-md">
    <!-- Tombol Download Excel -->
    <div class="flex justify-end mb-4">
        <a href="" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
            <i class="fas fa-download mr-2"></i> Download Excel
        </a>
    </div>
    <h3 class="text-xl font-bold mb-4 text-center">Jumlah Sarana Ibadah dan Lembaga Keagamaan Berdasarkan Desa di {{ request('kecamatan') }} - {{ request('tahun') }}</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left">No</th>
                    <th class="py-3 px-4 border-b text-left">Desa</th>
                    <th class="py-3 px-4 border-b text-center" colspan="6">Sarana Ibadah</th>
                    <th class="py-3 px-4 border-b text-left">Kantor Lembaga Keagamaan</th>
                </tr>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b"></th>
                    <th class="py-3 px-4 border-b"></th>
                    <th class="py-3 px-4 border-b text-center">Masjid</th>
                    <th class="py-3 px-4 border-b text-center">Mushola</th>
                    <th class="py-3 px-4 border-b text-center">Gereja</th>
                    <th class="py-3 px-4 border-b text-center">Pura</th>
                    <th class="py-3 px-4 border-b text-center">Vihara</th>
                    <th class="py-3 px-4 border-b text-center">Kelenteng</th>
                    <th class="py-3 px-4 border-b"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="py-2 px-4 border-b text-left">1</td>
                    <td class="py-2 px-4 border-b text-left">NGARGORETNO</td>
                    <td class="py-2 px-4 border-b text-center">11</td>
                    <td class="py-2 px-4 border-b text-center">20</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">-</td>
                </tr>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="py-2 px-4 border-b text-left">2</td>
                    <td class="py-2 px-4 border-b text-left">PARIPURNO</td>
                    <td class="py-2 px-4 border-b text-center">8</td>
                    <td class="py-2 px-4 border-b text-center">33</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">6</td>
                    <td class="py-2 px-4 border-b text-center">-</td>
                </tr>
                <!-- Tambahkan baris lainnya sesuai data -->
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <td class="py-3 px-4 border-b font-semibold text-right" colspan="2">Jumlah Total</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">19</td> 
                    <td class="py-3 px-4 border-b font-semibold text-center">53</td> 
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td> 
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td> 
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td> 
                    <td class="py-3 px-4 border-b font-semibold text-center">6</td> 
                    <td class="py-3 px-4 border-b font-semibold text-center">-</td> 
                </tr>
            </tfoot>
        </table>
    </div>
</div>