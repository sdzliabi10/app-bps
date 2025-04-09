<div class="bg-gray-50 p-6 rounded-lg shadow-md">
    <div class="flex justify-end mb-4">
        <a href="" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
            <i class="fas fa-download mr-2"></i> Download
        </a>
    </div>
    
    <h3 class="text-xl font-bold mb-4 text-center">Jumlah Energi Terbarukan dan Stasiun Energi Berdasarkan  di Desa {{ $desaName }} kecamatan {{ $kecamatanName }}, Tahun {{ $tahun }}</h3>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left" rowspan="2">No</th>
                    <th class="py-3 px-4 border-b text-left" rowspan="2">Desa</th>
                    <th class="py-3 px-4 border-b text-center" rowspan="2">Energi Terbarukan<br>(Biogas, Solar Cell, dll)</th>
                    <th class="py-3 px-4 border-b text-center" colspan="2">Stasiun Energi</th>
                </tr>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-center">Pertashop</th>
                    <th class="py-3 px-4 border-b text-center">Agen LPG</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="py-2 px-4 border-b text-left">1</td>
                    <td class="py-2 px-4 border-b text-left">KARANG SARI</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">0</td>
                    <td class="py-2 px-4 border-b text-center">1</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <td class="py-3 px-4 border-b font-semibold text-left" colspan="2">Jumlah</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">0</td>
                    <td class="py-3 px-4 border-b font-semibold text-center">1</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>