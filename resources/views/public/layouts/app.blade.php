<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Amongrasa - Aplikasi Monografi Desa')</title>
   @vite('resources/css/app.css')
   <style>
@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-1rem);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.slide-in-left {
  opacity: 0;
  animation: slideInLeft 0.6s ease-out forwards;
}

.slide-in-left.delay-200 {
  animation-delay: 0.2s;
}
</style>
</head>

<body class="bg-gray-100">

   <!-- Sticky White Navbar with Scroll Blur Effect -->
   <header id="navbar" class="bg-white transition-all duration-300 sticky top-0 z-50 border-b border-gray-300">
      <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between backdrop-blur-sm">
         <!-- Logo -->
         <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
   <img src="{{ asset('logo/Logo-brebes.png') }}"
      alt="Logo Kabupaten Brebes"
      class="w-12 h-12 object-contain"
      width="48"
      height="48">
   <span class="text-gray-300 h-8 border-r border-gray-300 mx-1"></span>
   <div class="flex flex-col overflow-hidden">
      <span class="text-2xl font-bold text-gray-800 tracking-tight leading-tight slide-in-left">
         Desa Cantik
      </span>
      <span class="text-xs text-gray-500 mt-0.5 slide-in-left delay-200">
         Pemerintah Kabupaten Brebes
      </span>
   </div>
</a>


         <!-- Mobile Menu Button -->
         <button id="nav-toggle" class="md:hidden text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
         </button>

         <!-- Desktop Nav - Sekarang di pojok kanan -->
         <nav id="nav-menu" class="hidden md:flex items-center justify-end flex-1 gap-2">
            <a href="{{ route('profil-desa') }}"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('profil-desa') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="{{asset ('icons/ppdesa.png')}}" alt="Profil Icon" class="w-7 h-7 mb-1">
               Profil Desa
            </a>
            <a href="{{ route('desa-dalam-angka') }}"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('desa-dalam-angka') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="{{asset ('icons/angka.png')}}" alt="Angka Icon" class="w-6 h-6 mb-1">
               Desa Dalam Angka
            </a>
            <a href="{{ route('desa-dalam-peta') }}"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('desa-dalam-peta') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="{{asset ('icons/peta.png')}}" alt="Peta Icon" class="w-6 h-6 mb-1">
               Desa Dalam Peta
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->is('buku-monografi') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/2991/2991108.png" alt="Buku Icon" class="w-6 h-6 mb-1">
               Buku Monografi
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->is('metadata') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/833/833539.png" alt="Metadata Icon" class="w-6 h-6 mb-1">
               Metadata
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->is('instrumen') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/911/911406.png" alt="Instrumen Icon" class="w-6 h-6 mb-1">
               Instrumen
            </a>
         </nav>
      </div>
      <!-- Mobile Nav -->
      <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 z-[9999]">
         <div class="grid grid-cols-2 gap-4 text-sm font-medium">
            <a href="{{ route('profil-desa') }}"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->routeIs('profil-desa') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/1949/1949389.png" alt="Profil Icon" class="w-6 h-6 mb-1">
               Profil Desa
            </a>
            <a href="{{ route('desa-dalam-angka') }}"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->routeIs('desa-dalam-angka') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/1313/1313246.png" alt="Angka Icon" class="w-6 h-6 mb-1">
               Desa Dalam Angka
            </a>
            <a href="{{ route('desa-dalam-peta') }}"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->routeIs('desa-dalam-peta') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/535/535137.png" alt="Peta Icon" class="w-6 h-6 mb-1">
               Desa Dalam Peta
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->is('desa-dalam-grafik') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" alt="Grafik Icon" class="w-6 h-6 mb-1">
               Desa Dalam Grafik
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->is('buku-monografi') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/2991/2991108.png" alt="Buku Icon" class="w-6 h-6 mb-1">
               Buku Monografi
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->is('metadata') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/833/833539.png" alt="Metadata Icon" class="w-6 h-6 mb-1">
               Metadata
            </a>
            <a href="#"
               class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 {{ request()->is('instrumen') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
               <img src="https://cdn-icons-png.flaticon.com/512/911/911406.png" alt="Instrumen Icon" class="w-6 h-6 mb-1">
               Instrumen
            </a>
         </div>
      </div>
   </header>
   <div class="container mx-auto mt-6 p-4">
      @yield('content')
   </div>
</body>
<script>
   function filterData() {
      const kategori = document.getElementById('kategori').value;
      const dataSelect = document.getElementById('data');
      const options = dataSelect.getElementsByTagName('option');

      // Aktifkan/Nonaktifkan select data berdasarkan kategori yang dipilih
      dataSelect.disabled = !kategori;

      for (let i = 1; i < options.length; i++) {
         const option = options[i];
         if (option.getAttribute('data-kategori') === kategori) {
            option.style.display = '';
         } else {
            option.style.display = 'none';
         }
      }

      // Reset nilai select data
      dataSelect.value = '';
   }

   function filterDesa() {
      const kecamatan = document.getElementById('kecamatan').value;
      const desaSelect = document.getElementById('desa');
      const options = desaSelect.getElementsByTagName('option');

      // Aktifkan/Nonaktifkan select desa berdasarkan kecamatan yang dipilih
      desaSelect.disabled = !kecamatan;

      for (let i = 1; i < options.length; i++) {
         const option = options[i];
         if (option.getAttribute('data-kecamatan') === kecamatan) {
            option.style.display = '';
         } else {
            option.style.display = 'none';
         }
      }

      // Reset nilai select desa
      desaSelect.value = '';
   }

   const navbar = document.getElementById('navbar');

   window.addEventListener('scroll', () => {
      if (window.scrollY > 10) {
         navbar.classList.add('bg-white/70', 'backdrop-blur-md', 'shadow-md');
      } else {
         navbar.classList.remove('bg-white/70', 'backdrop-blur-md', 'shadow-md');
      }
   });

   // Mobile toggle (opsional)
   const toggleBtn = document.getElementById('nav-toggle');
   const mobileMenu = document.getElementById('mobile-menu');

   toggleBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
   });
</script>

</html>