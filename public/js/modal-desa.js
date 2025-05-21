function showModal(feature) {
    const modal = document.getElementById('desa-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalContent = document.getElementById('modal-content');

    modalTitle.textContent = `Informasi Desa ${feature.properties.desa}`;
    modalContent.innerHTML = `
        <div class="space-y-2">
            <p><strong>Nama Desa:</strong> ${feature.properties.desa || 'Tidak tersedia'}</p>
            <p><strong>Kecamatan:</strong> ${feature.properties.kecamatan || 'Tidak tersedia'}</p>
            <p><strong>Kabupaten:</strong> ${feature.properties.kabupaten || 'Tidak tersedia'}</p>
            <p><strong>Luas Area:</strong> ${feature.properties.luas ? feature.properties.luas + ' km²' : 'Tidak tersedia'}</p>
            <p><strong>Jumlah Penduduk:</strong> ${feature.properties.populasi || 'Tidak tersedia'}</p>
            ${feature.properties.keterangan ? `<p><strong>Keterangan:</strong> ${feature.properties.keterangan}</p>` : ''}
        </div>
    `;
    // modal.classList.remove('hidden');
    modal.style.zIndex = '1000';
}

function closeModal() {
    document.getElementById('desa-modal').classList.add('hidden');
}

window.onclick = function(event) {
    const modal = document.getElementById('desa-modal');
    if (event.target === modal) {
        closeModal();
    }
};
