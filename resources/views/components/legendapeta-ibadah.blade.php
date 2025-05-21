<!-- Toggle Button (Mobile Only) -->
<button onclick="toggleLegenda()" class="fixed bottom-4 right-4 z-[6000] bg-white border shadow p-2 rounded-full md:hidden">
    <i id="toggle-icon" class="fa fa-eye text-lg text-gray-700"></i>
</button>

<!-- Legend Box -->
<div id="legenda-box" class="absolute right-4 bottom-4 bg-white border rounded-md p-3 text-sm shadow z-[5000] max-w-[90%] w-64 md:w-72 hidden md:block">
    <strong class="block mb-2">Legenda Tempat Ibadah (<span id="total-marker-count">0</span>)</strong>
    <ul class="space-y-1">
        <li><img src="/icons/masjid.png" class="inline w-5 h-5 mr-1" /> Masjid (Islam)</li>
        <li><img src="/icons/gereja.png" class="inline w-5 h-5 mr-1" /> Gereja (Kristen/Katolik)</li>
        <li><img src="/icons/pura.png" class="inline w-5 h-5 mr-1" /> Pura (Hindu)</li>
        <li><img src="/icons/vihara.png" class="inline w-5 h-5 mr-1" /> Vihara (Buddha)</li>
        <li><img src="/icons/kelenteng.png" class="inline w-5 h-5 mr-1" /> Kelenteng (Konghucu)</li>
    </ul>
</div>
