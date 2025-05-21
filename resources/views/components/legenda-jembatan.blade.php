<!-- Toggle Button (Mobile Only) -->
<button onclick="toggleLegenda()" class="absolute bottom-4 right-4 z-[6000] bg-white border shadow p-2 rounded-full md:hidden">
    <i id="toggle-icon" class="fa fa-eye text-lg text-gray-700"></i>
</button>

<!-- Legend Box -->
<div id="legenda-box" class="absolute right-4 bottom-5 bg-white border rounded-md p-3 text-sm shadow z-[5000] max-w-[90%] w-64 md:w-72 hidden md:block">
    <strong class="block mb-3">🗺️ Legenda Jembatan (<span id="total-marker-count">{{ count($jembatanPetaList ?? []) }}</span>)</strong>
    <div class="flex items-start space-x-3">
        <img src="/icons/jembatan.png" alt="Ikon Jembatan" class="w-7 h-7 mt-0.5">
        <div>
            <p class="text-sm text-gray-700 font-medium">Jembatan Strategis</p>
            <p class="text-xs text-gray-500">Menandai lokasi jembatan penting yang menjadi penghubung vital di wilayah desa.</p>
        </div>
    </div>
</div>
